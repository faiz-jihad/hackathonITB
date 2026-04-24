<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageService
{
    public function store(UploadedFile $file)
    {
        // Menyimpan di storage/app/public/diagnosa
        $path = $file->store('diagnosa', 'public');
        return $path;
    }
}
