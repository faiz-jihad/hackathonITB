<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiagnosaRequest;
use App\Services\AIService;
use App\Services\ImageService;
use App\Models\Diagnosa;

class DiagnosaController extends Controller
{
    protected $aiService;
    protected $imageService;
    protected $weatherService;

    public function __construct(AIService $aiService, ImageService $imageService, \App\Services\WeatherService $weatherService)
    {
        $this->aiService = $aiService;
        $this->imageService = $imageService;
        $this->weatherService = $weatherService;
    }

    public function predict(DiagnosaRequest $request)
    {
        try {
            $imagePath = $this->imageService->store($request->file('image'));
            
            // Get Weather Info
            $weatherData = $this->weatherService->getWeather($request->latitude, $request->longitude);
            $weatherString = $weatherData ? "Suhu: {$weatherData['temp']}, Kelambapan: {$weatherData['humidity']}, Kondisi: {$weatherData['condition']}" : null;

            // Call AI Engine
            $prediction = $this->aiService->predict($request->file('image'), $weatherString);
            
            // Save to DB
            $diagnosa = Diagnosa::create([
                'image_path' => $imagePath,
                'disease_name' => $prediction['penyakit'] ?? 'Unknown',
                'accuracy' => $prediction['akurasi'] ?? 0,
                'recommendation' => $prediction['rekomendasi'] ?? 'Tidak ada rekomendasi.',
                'location_name' => $request->location_name,
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
