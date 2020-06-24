<?php

declare(strict_types=1);

namespace App\Helper;

use Symfony\Component\HttpFoundation\File\UploadedFile;

final class UploadedFileHandler
{
    private string $storageLocation;

    private array $allowedMimeTypes;

    public function __construct()
    {
        $this->storageLocation = 'uploads/';
        $this->allowedMimeTypes
                               = [
            'image/gif',
            'image/jpeg',
            'image/png',
        ];
    }

    public function handle(UploadedFile $file): string
    {
        if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
            throw new \LogicException('Het bestand moet een foto zijn');
        }

        $fileName = uniqid() . '.' . $file->guessExtension();
        $file->move($this->storageLocation, $fileName);

        return $this->storageLocation . $fileName;
    }
}
