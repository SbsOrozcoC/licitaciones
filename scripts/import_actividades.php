<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Actividad;

if (Actividad::count() > 0) {
    echo "Actividades ya cargadas.\n";
    exit;
}

$archivo = __DIR__ . '/../storage/unspcs.xlsx';

$spreadsheet = IOFactory::load($archivo);
$sheet = $spreadsheet->getActiveSheet();
$rows = $sheet->toArray();

unset($rows[0]);

foreach ($rows as $row) {

    if (
        !isset($row[0], $row[2], $row[4], $row[6]) ||
        !is_numeric($row[0]) ||
        !is_numeric($row[2]) ||
        !is_numeric($row[4]) ||
        !is_numeric($row[6])
    ) {
        continue;
    }

    Actividad::create([
        'codigo_segmento'  => (int) $row[0],
        'segmento'         => trim($row[1]),
        'codigo_familia'   => (int) $row[2],
        'familia'          => trim($row[3]),
        'codigo_clase'     => (int) $row[4],
        'clase'            => trim($row[5]),
        'codigo_producto'  => (int) $row[6],
        'producto'         => trim($row[7]),
    ]);
}


echo "Actividades importadas correctamente.\n";
