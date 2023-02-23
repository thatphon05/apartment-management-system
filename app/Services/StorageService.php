<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageService
{

    public function download(string $file): StreamedResponse
    {
        $this->isFileExists($file);

        $fileExtension = explode('/', Storage::mimeType($file))[1];

        return Storage::download($file, now() . '.' . $fileExtension);
    }

    public function viewFile(string $file): Response
    {
        $this->isFileExists($file);

        return response(Storage::get($file))->header('Content-Type', Storage::mimeType($file));
    }

    public function isFileExists(string $file): void
    {
        if (!Storage::get($file)) {
            abort(404);
        }
    }

    public function getFileSizeMB(string $file): float
    {
        return (float)(Storage::get($file) ? Storage::size($file) : 0) / 1024 / 1024;
    }

    public function removeFile(string $file): void
    {
        if (Storage::get($file)) {
            Storage::delete($file);
        }
    }
}
