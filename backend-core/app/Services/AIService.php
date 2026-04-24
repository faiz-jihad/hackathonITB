<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;

class AIService
{
    public function predict(UploadedFile $file)
    {
        $apiUrl = config('ai.url') . '/predict';

        $response = Http::timeout(30)->attach(
            'file', file_get_contents($file->getRealPath()), $file->getClientOriginalName()
        )->post($apiUrl);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Gagal menghubungi AI Engine: ' . $response->body());
    }
}
