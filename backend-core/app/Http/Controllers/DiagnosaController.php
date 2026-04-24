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

    public function __construct(AIService $aiService, ImageService $imageService)
    {
        $this->aiService = $aiService;
        $this->imageService = $imageService;
    }

    public function predict(DiagnosaRequest $request)
    {
        try {
            $imagePath = $this->imageService->store($request->file('image'));
            
            // Call AI Engine
            $prediction = $this->aiService->predict($request->file('image'));
            
            // Save to DB
            $diagnosa = Diagnosa::create([
                'image_path' => $imagePath,
                'disease_name' => $prediction['penyakit'] ?? 'Unknown',
                'accuracy' => $prediction['akurasi'] ?? 0,
                'recommendation' => $prediction['rekomendasi'] ?? 'Tidak ada rekomendasi.',
            ]);

            return view('pages.result', compact('diagnosa'));

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses gambar: ' . $e->getMessage());
        }
    }
}
