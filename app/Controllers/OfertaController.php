<?php

namespace App\Controllers;

use App\Models\Oferta;

class OfertaController
{
    public function index(): void
    {
        $ofertas = Oferta::all();

        header('Content-Type: application/json');
        echo json_encode($ofertas);
    }

    public function show(int $id): void
    {
        $oferta = Oferta::find($id);

        if (!$oferta) {
            http_response_code(404);
            echo json_encode(['error' => 'Oferta no encontrada']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($oferta);
    }
}
