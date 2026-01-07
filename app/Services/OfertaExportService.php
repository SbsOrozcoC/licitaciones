<?php

namespace App\Services;

use App\Models\Oferta;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OfertaExportService
{
    public static function export(?string $search = null): void
    {
        $query = Oferta::with('actividad');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('consecutivo', 'LIKE', "%{$search}%")
                    ->orWhere('objeto', 'LIKE', "%{$search}%")
                    ->orWhere('descripcion', 'LIKE', "%{$search}%")
                    ->orWhere('estado', 'LIKE', "%{$search}%")
                    ->orWhereHas('actividad', function ($a) use ($search) {
                        $a->where('producto', 'LIKE', "%{$search}%");
                    });
            });
        }

        $ofertas = $query->orderBy('id', 'desc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Encabezados
        $headers = [
            'A1' => 'Consecutivo',
            'B1' => 'Objeto',
            'C1' => 'Descripción',
            'D1' => 'Actividad',
            'E1' => 'Presupuesto',
            'F1' => 'Moneda',
            'G1' => 'Fecha Inicio',
            'H1' => 'Fecha Cierre',
            'I1' => 'Estado',
        ];

        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        // Datos
        $row = 2;

        foreach ($ofertas as $oferta) {
            $sheet->setCellValue("A{$row}", $oferta->consecutivo);
            $sheet->setCellValue("B{$row}", $oferta->objeto);
            $sheet->setCellValue("C{$row}", $oferta->descripcion);
            $sheet->setCellValue("D{$row}", $oferta->actividad->producto ?? '');
            $sheet->setCellValue("E{$row}", $oferta->presupuesto);
            $sheet->setCellValue("F{$row}", $oferta->moneda);
            $sheet->setCellValue("G{$row}", $oferta->fecha_inicio . ' ' . $oferta->hora_inicio);
            $sheet->setCellValue("H{$row}", $oferta->fecha_cierre . ' ' . $oferta->hora_cierre);
            $sheet->setCellValue("I{$row}", $oferta->estado);

            $row++;
        }

        // Descargar
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ofertas.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
