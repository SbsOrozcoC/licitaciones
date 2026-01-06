<?php

namespace App\Validators;

use App\Models\Actividad;

class OfertaValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty(trim($data['objeto'] ?? '')) || strlen($data['objeto']) > 150) {
            $errors['objeto'] = 'Objeto obligatorio (máx 150 caracteres)';
        }

        if (empty(trim($data['descripcion'] ?? '')) || strlen($data['descripcion']) > 400) {
            $errors['descripcion'] = 'Descripción obligatoria (máx 400 caracteres)';
        }

        if (!in_array($data['moneda'] ?? '', ['COP', 'USD', 'EUR'])) {
            $errors['moneda'] = 'Moneda inválida';
        }

        if (!isset($data['presupuesto']) || $data['presupuesto'] <= 0) {
            $errors['presupuesto'] = 'Presupuesto debe ser mayor a 0';
        }

        if (empty($data['actividad_id']) || !Actividad::find($data['actividad_id'])) {
            $errors['actividad_id'] = 'Actividad inválida';
        }

        $inicio = strtotime(($data['fecha_inicio'] ?? '') . ' ' . ($data['hora_inicio'] ?? ''));
        $cierre = strtotime(($data['fecha_cierre'] ?? '') . ' ' . ($data['hora_cierre'] ?? ''));

        if (!$inicio || !$cierre || $inicio >= $cierre) {
            $errors['cronograma'] = 'Fecha/hora inicio debe ser menor a cierre';
        }

        return $errors;
    }
}
