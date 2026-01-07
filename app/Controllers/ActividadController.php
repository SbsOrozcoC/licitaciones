<?php

namespace App\Controllers;

use App\Models\Actividad;

class ActividadController
{
    public function index(): void
    {
        $search = $_GET['search'] ?? null;

        $query = Actividad::query();

        if ($search) {
            $query->where('producto', 'LIKE', "%{$search}%");
        }

        $actividades = $query
            ->orderBy('producto')
            ->limit(10)
            ->get([
                'id',
                'producto'
            ]);

        header('Content-Type: application/json');
        echo json_encode($actividades);
    }
}
