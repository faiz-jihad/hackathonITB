<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    /**
     * Get weather data based on coordinates.
     * Using Open-Meteo for reliable coordinate-based results (High Accuracy).
     */
    public function getWeather($lat, $lng)
    {
        if (!$lat || !$lng) return null;

        try {
            $response = Http::get("https://api.open-meteo.com/v1/forecast", [
                'latitude' => $lat,
                'longitude' => $lng,
                'current' => 'temperature_2m,relative_humidity_2m,weather_code',
                'timezone' => 'auto'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $current = $data['current'];
                
                return [
                    'temp' => $current['temperature_2m'] . '°C',
                    'humidity' => $current['relative_humidity_2m'] . '%',
                    'condition' => $this->mapWeatherCode($current['weather_code'])
                ];
            }
        } catch (\Exception $e) {
            Log::error("Weather API Error: " . $e->getMessage());
        }

        return null;
    }

    private function mapWeatherCode($code)
    {
        // Simple mapping based on WMO Weather interpretation codes
        $map = [
            0 => 'Cerah (Sesuai BMKG)',
            1 => 'Cerah Berawan',
            2 => 'Berawan',
            3 => 'Mendung',
            45 => 'Berkabut',
            51 => 'Gerimis Ringan',
            61 => 'Hujan Ringan',
            63 => 'Hujan Sedang',
            65 => 'Hujan Lebat',
            80 => 'Hujan Showers',
            95 => 'Badai Guntur (Waspada)',
        ];

        return $map[$code] ?? 'Kondisi Normal';
    }
}
