<?php

namespace App\Services;

use App\Models\Oferta;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OfertaExportService
{
    public static function export(?string $search = null): void
    {
        $query = Oferta::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('consecutivo', 'LIKE', "%{$search}%")
                  ->orWhere('objeto', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%");
            });
        }

        $ofertas = $query->orderBy('id', 'desc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'Consecutivo',
            'Objeto',
            'Descripción',
            'Moneda',
            'Presupuesto',
            'Fecha Inicio',
            'Fecha Cierre',
            'Estado',
        ];

        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        foreach ($ofertas as $oferta) {
            $sheet->fromArray([
                $oferta->consecutivo,
                $oferta->objeto,
                $oferta->descripcion,
                $oferta->moneda,
                $oferta->presupuesto,
                "{$oferta->fecha_inicio} {$oferta->hora_inicio}",
                "{$oferta->fecha_cierre} {$oferta->hora_cierre}",
                $oferta->estado,
            ], null, "A{$row}");
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="ofertas.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
