<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{

    /**
     * @param $file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download($file)
    {
        if (!Storage::get($file)) {
            abort(404);
        }

        $fileExtension = explode('/', Storage::mimeType($file));

        return Storage::download($file, now() . '.' . $fileExtension[1]);

    }

    /**
     * @param $file
     * @return float
     */
    public function getFileSizeMB($file): float
    {
        return (Storage::get($file) ? Storage::size($file) : 0) / 1024 / 1024;
    }
}
