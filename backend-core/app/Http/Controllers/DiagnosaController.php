<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiagnosaRequest;
use App\Services\AIService;
use App\Services\ImageService;
use App\Services\BmkgWeatherService;
use App\Models\Diagnosa;

class DiagnosaController extends Controller
{
    protected $aiService;
    protected $imageService;
    protected $bmkgWeatherService;

    public function __construct(AIService $aiService, ImageService $imageService, BmkgWeatherService $bmkgWeatherService)
    {
        $this->aiService = $aiService;
        $this->imageService = $imageService;
        $this->bmkgWeatherService = $bmkgWeatherService;
    }

    /**
     * Prediksi Penyakit Padi (Endpoint Utama Web Form)
     * 
     * Endpoint ini menerima gambar daun padi dari user, serta menangkap data
     * cuaca (Suhu, Kelembapan, Kondisi) berdasarkan lokasi GPS user. Data tersebut 
     * dikirimkan ke service AI Engine (Python) untuk diinferensi dan diproses
     * oleh Gemini LLM untuk menghasilkan RAG (Retrieval-Augmented Generation).
     * 
     * @param DiagnosaRequest $request Instance request berisi file gambar (max 5MB) dan string cuaca.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse Merender view hasil (result.blade.php) atau redirect error.
     * 
     * @throws \Exception Jika gagal menghubungi microservice AI Engine atau terjadi masalah filesystem.
     */
    public function predict(DiagnosaRequest $request)
    {
        try {
            // Validate additional fields
            $request->validate([
                'weather_info' => 'nullable|string|max:200',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'location_name' => 'nullable|string|max:200',
            ]);

            $imagePath = $this->imageService->store($request->file('image'));
            
            // Get Weather Info - Priority: Client-side Open-Meteo > Server-side BMKG > Fallback
            // Sanitize: only allow expected pattern to prevent prompt injection
            $rawWeather = $request->input('weather_info');
            $weatherString = null;
            if ($rawWeather && preg_match('/^Suhu:\s*[\d.]+.*Kelambapan:\s*[\d.]+.*Kondisi:\s*.+$/u', $rawWeather)) {
                $weatherString = strip_tags(substr($rawWeather, 0, 200));
            }
            
            if ($weatherString) {
                // Parse weather string from client-side (format: "Suhu: 30°C, Kelambapan: 75%, Kondisi: Cerah")
                preg_match('/Suhu:\s*([\d.]+)/', $weatherString, $tempMatch);
                preg_match('/Kelambapan:\s*([\d.]+)/', $weatherString, $humMatch);
                preg_match('/Kondisi:\s*(.+)$/', $weatherString, $condMatch);
                
                $weatherData = [
                    'temp' => ($tempMatch[1] ?? '28') . '°C',
                    'humidity' => ($humMatch[1] ?? '80') . '%',
                    'condition' => $condMatch[1] ?? 'Normal',
                ];
            } else {
                // Fallback ke BMKG jika client tidak mengirim data cuaca
                $bmkgData = $this->bmkgWeatherService->getCurrentWeather('Indramayu');
                
                if (isset($bmkgData['error'])) {
                    $weatherString = "Suhu: 28°C, Kelambapan: 80%, Kondisi: Normal";
                    $weatherData = ['temp' => '28°C', 'humidity' => '80%', 'condition' => 'Normal'];
                } else {
                    $weatherString = "Suhu: {$bmkgData['Suhu']}, Kelambapan: {$bmkgData['Kelembaban']}, Kondisi: {$bmkgData['Deskripsi Cuaca']}";
                    $weatherData = [
                        'temp' => $bmkgData['Suhu'],
                        'humidity' => $bmkgData['Kelembaban'],
                        'condition' => $bmkgData['Deskripsi Cuaca'],
                    ];
                }
            }

            // Call AI Engine
            $prediction = $this->aiService->predict($request->file('image'), $weatherString);
            
            // Save to DB
            $diagnosa = Diagnosa::create([
                'image_path' => $imagePath,
                'disease_name' => $prediction['penyakit'] ?? 'Unknown',
                'accuracy' => $prediction['akurasi'] ?? 0,
                'recommendation' => $prediction['rekomendasi'] ?? 'Tidak ada rekomendasi.',
                'location_name' => strip_tags($request->location_name ?? ''),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return view('pages.result', [
                'diagnosa' => $diagnosa,
                'weatherData' => $weatherData,
                'locationName' => $request->location_name ?? 'Lokasi Terdeteksi'
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses gambar: ' . $e->getMessage());
        }
    }
}
