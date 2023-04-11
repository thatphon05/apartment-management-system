<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageService
{
    public function download(string $name, string $path = ''): StreamedResponse
    {
        $location = $path . '/' . $name;

        $this->isFileExists($location);

        $fileExtension = explode('/', Storage::mimeType($location))[1];

        return Storage::download($location, now() . '.' . $fileExtension);
    }

    public function viewFile(string $name, string $path = ''): Response
    {
        $location = $path . '/' . $name;

        $this->isFileExists($location);

        return response(Storage::get($location))->header('Content-Type', Storage::mimeType($location));
    }

    private function isFileExists(string $location): void
    {
        if (!Storage::get($location)) {
            abort(404);
        }
    }

    public function getFileSizeMB(string $name, string $path = ''): float
    {
        $location = $path . '/' . $name;

        return (float)(Storage::get($location) ? Storage::size($location) : 0) / 1024 / 1024;
    }

    public function removeFile(string $name, string $path = ''): bool
    {
        $location = $path . '/' . $name;

        if (!Storage::get($location)) {
            return false;
        }

        return Storage::delete($location);
    }
}
