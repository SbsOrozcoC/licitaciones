<?php

namespace App\Controllers;

use App\Models\Oferta;
use App\Validators\OfertaValidator;
use App\Services\ConsecutivoService;
use Illuminate\Database\Capsule\Manager as DB;

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

    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'JSON inválido']);
            return;
        }

        $errors = OfertaValidator::validate($data);

        if (!empty($errors)) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $data['consecutivo'] = ConsecutivoService::generar();
        $data['estado'] = 'CREADA';
        $data['creado_en'] = date('Y-m-d H:i:s');

        $oferta = Oferta::create($data);

        http_response_code(201);
        echo json_encode($oferta);
    }
}
