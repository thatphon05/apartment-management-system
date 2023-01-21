<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{

    /**
     * @param $file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download($file): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        if (!Storage::get($file)) {
            abort(404);
        }

        return Storage::download($file, now());
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
