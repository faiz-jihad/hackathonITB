<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BmkgWeatherService
{
    // URL XML BMKG untuk Jawa Barat
    private const BMKG_URL = 'https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-JawaBarat.xml';

    /**
     * Mengambil cuaca saat ini untuk wilayah spesifik (Default: Indramayu)
     * Menggunakan Cache::remember untuk menyimpan hasil selama 1 jam.
     */
    public function getCurrentWeather(string $targetArea = 'Indramayu')
    {
        // Cache key yang unik per area
        $cacheKey = 'bmkg_weather_' . strtolower(str_replace(' ', '_', $targetArea));

        // Cache selama 1 jam (3600 detik)
        return Cache::remember($cacheKey, 3600, function () use ($targetArea) {
            try {
                // 1. HTTP GET ke XML BMKG
                $response = Http::timeout(10)->get(self::BMKG_URL);

                if (!$response->successful()) {
                    throw new \Exception("Gagal mengambil data dari BMKG. HTTP Status: " . $response->status());
                }

                // 2. Parsing XML
                // Mengubah string XML menjadi Object SimpleXMLElement
                $xml = simplexml_load_string($response->body());
                if ($xml === false) {
                    throw new \Exception("Gagal mem-parsing XML dari BMKG.");
                }

                // 3. Filter data berdasarkan deskripsi area (contoh: Indramayu)
                $selectedArea = null;
                foreach ($xml->forecast->area as $area) {
                    if ((string) $area['description'] === $targetArea) {
                        $selectedArea = $area;
                        break;
                    }
                }

                if (!$selectedArea) {
                    throw new \Exception("Area '{$targetArea}' tidak ditemukan dalam data BMKG Jawa Barat.");
                }

                // 4. Proses pencarian waktu terdekat dan parameter
                $weatherData = [
                    'Nama Wilayah' => $targetArea,
                    'Suhu' => null,
                    'Kelembaban' => null,
                    'Deskripsi Cuaca' => null,
                ];

                foreach ($selectedArea->parameter as $param) {
                    $paramId = (string) $param['id'];

                    if (in_array($paramId, ['t', 'hu', 'weather'])) {
                        // Cari timerange yang paling dekat dengan waktu saat ini
                        $closestValue = $this->getClosestValueByTime($param->timerange);

                        if ($paramId === 't') {
                            $weatherData['Suhu'] = $closestValue . ' °C';
                        } elseif ($paramId === 'hu') {
                            $weatherData['Kelembaban'] = $closestValue . '%';
                        } elseif ($paramId === 'weather') {
                            $weatherData['Deskripsi Cuaca'] = $this->getWeatherDescription($closestValue);
                        }
                    }
                }

                return $weatherData;

            } catch (\Exception $e) {
                Log::error("[BMKG Weather Service] " . $e->getMessage());
                return [
                    'error' => true,
                    'message' => 'Layanan cuaca sedang tidak tersedia.',
                    'details' => $e->getMessage()
                ];
            }
        });
    }

    /**
     * Helper: Mencari value dari timerange yang waktunya paling dekat dengan saat ini
     * Menggunakan \Carbon\Carbon
     */
    private function getClosestValueByTime($timeRanges)
    {
        $now = Carbon::now();
        $closestValue = null;
        $minDiff = PHP_INT_MAX;

        foreach ($timeRanges as $range) {
            $datetimeStr = (string) $range['datetime']; // Format: YYYYMMDDHHmm (contoh: 202405020600)
            
            // Parsing string ke object Carbon
            try {
                $rangeDate = Carbon::createFromFormat('YmdHi', $datetimeStr);
                
                // Hitung selisih waktu dalam menit absolut
                $diffInMinutes = abs($now->diffInMinutes($rangeDate));

                if ($diffInMinutes < $minDiff) {
                    $minDiff = $diffInMinutes;
                    // Ambil value pertama (index 0) dari elemen value
                    $closestValue = (string) $range->value[0];
                }
            } catch (\Exception $e) {
                continue; // Abaikan jika format waktu invalid
            }
        }

        return $closestValue;
    }

    /**
     * Helper: Konversi kode cuaca BMKG menjadi teks
     */
    private function getWeatherDescription($code)
    {
        $codes = [
            '0' => 'Cerah',
            '1' => 'Cerah Berawan',
            '2' => 'Cerah Berawan',
            '3' => 'Berawan',
            '4' => 'Tebal Berawan',
            '5' => 'Udara Kabur',
            '10' => 'Asap',
            '45' => 'Kabut',
            '60' => 'Hujan Ringan',
            '61' => 'Hujan Sedang',
            '63' => 'Hujan Lebat',
            '80' => 'Hujan Lokal',
            '95' => 'Hujan Petir',
            '97' => 'Hujan Petir Hebat'
        ];

        return $codes[(string) $code] ?? 'Tidak diketahui';
    }
}
