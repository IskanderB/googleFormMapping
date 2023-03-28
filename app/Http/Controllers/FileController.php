<?php

namespace App\Http\Controllers;

use App\Entity\File\File;
use App\File\FilesystemFactory;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class FileController extends Controller
{
    public function __construct(
        private FilesystemFactory $filesystemFactory,
    ) {
    }

    public function show(File $file): RedirectResponse
    {
        $filesystem = $this->filesystemFactory->get($file->getStorage());

        $fileShowUrl = $filesystem->getShowUrl($file->getPath());

        return new RedirectResponse($fileShowUrl ?: route('file.download', ['file' => $file->getUuid()]));
    }

    public function download(File $file): StreamedResponse
    {
        try {
            $filesystem = $this->filesystemFactory->get($file->getStorage());

            $stream = $filesystem->readStream($file->getPath());

            $response = new StreamedResponse(function () use ($stream) {
                fpassthru($stream);
            });

            $response->headers->set('Content-Type', $file->getMimeType() ?: 'application/octet-stream');
            $response->setLastModified($file->getCreatedAt());

            return $response;
        } catch (Throwable) {
            throw new NotFoundHttpException;
        }
    }
}
