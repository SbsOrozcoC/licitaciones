<?php

namespace App\Services;

class FileUploadService
{
    public static function upload(array $file): string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception('Error al subir archivo');
        }

        $allowedExtensions = ['pdf', 'zip'];

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExtensions)) {
            throw new \Exception('Tipo de archivo no permitido');
        }

        $uploadDir = __DIR__ . '/../../storage/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $filename = uniqid('doc_') . '.' . $extension;
        $destination = $uploadDir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \Exception('No se pudo guardar el archivo');
        }

        return $filename;
    }
}
