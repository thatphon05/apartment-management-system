<?php

namespace App\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageService
{

    /**
     * @param $file
     * @return StreamedResponse
     */
    public function download($file): StreamedResponse
    {
        $this->isFileExist($file);

        $fileExtension = explode('/', Storage::mimeType($file));

        return Storage::download($file, now() . '.' . $fileExtension[1]);
    }

    /**
     * @param $file
     * @return Application|ResponseFactory|Response
     */
    public function viewFile($file): Response|Application|ResponseFactory
    {
        $this->isFileExist($file);

        return response(Storage::get($file))->header('Content-Type', Storage::mimeType($file));
    }

    /**
     * @param $file
     * @return void
     */
    public function isFileExist($file): void
    {
        if (!Storage::get($file)) {
            abort(404);
        }
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
