<?php

namespace App\Services;

class FileUploadService
{
    public static function upload(array $file): string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception('Error al subir archivo');
        }

        $allowedMime = [
            'application/pdf',
            'application/zip',
            'application/x-zip-compressed'
        ];

        if (!in_array($file['type'], $allowedMime)) {
            throw new \Exception('Tipo de archivo no permitido');
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('doc_') . '.' . $extension;

        $destination = __DIR__ . '/../../storage/uploads/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \Exception('No se pudo guardar el archivo');
        }

        return $filename;
    }
}
