<?php

namespace App\Controllers;

use App\Models\Oferta;
use App\Models\Documento;
use App\Validators\OfertaValidator;
use App\Services\FileUploadService;
use App\Services\ConsecutivoService;
use App\Services\OfertaExportService;
use Illuminate\Database\Capsule\Manager as DB;

class OfertaController
{
    public function index(): void
    {
        $search   = $_GET['search'] ?? null;
        $page     = max((int)($_GET['page'] ?? 1), 1);
        $perPage  = max((int)($_GET['per_page'] ?? 10), 1);
        $offset   = ($page - 1) * $perPage;

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

        $total = $query->count();

        $ofertas = $query
            ->orderBy('id', 'desc')
            ->skip($offset)
            ->take($perPage)
            ->get();

        header('Content-Type: application/json');
        echo json_encode([
            'data' => $ofertas,
            'meta' => [
                'total' => $total,
                'page' => $page,
                'per_page' => $perPage,
                'last_page' => (int) ceil($total / $perPage),
            ],
        ]);
    }


    public function show(int $id): void
    {
        $oferta = Oferta::with(['actividad', 'documentos'])->find($id);

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

    public function export(): void
    {
        $search = $_GET['search'] ?? null;
        OfertaExportService::export($search);
    }

    public function update(int $id): void
    {
        $oferta = Oferta::find($id);

        if (!$oferta) {
            http_response_code(404);
            echo json_encode(['error' => 'Oferta no encontrada']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'JSON inválido']);
            return;
        }

        $errors = \App\Validators\OfertaValidator::validate($data);

        if (!empty($errors)) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $data['actualizado_en'] = date('Y-m-d H:i:s');

        $oferta->update($data);

        echo json_encode($oferta);
    }



    public function uploadDocumento(int $id): void
    {
        $oferta = Oferta::find($id);

        if (!$oferta) {
            http_response_code(404);
            echo json_encode(['error' => 'Oferta no encontrada']);
            return;
        }

        if (!isset($_FILES['archivo'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Archivo requerido']);
            return;
        }

        try {
            $filename = FileUploadService::upload($_FILES['archivo']);

            $documento = Documento::create([
                'licitacion_id' => $oferta->id,
                'titulo'        => $_POST['titulo'] ?? '',
                'descripcion'   => $_POST['descripcion'] ?? '',
                'archivo'       => $filename,
                'creado_en'     => date('Y-m-d H:i:s'),
            ]);

            echo json_encode($documento);
        } catch (\Exception $e) {
            http_response_code(422);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }


    private function hasDocuments(int $offerId): bool
    {
        return Documento::where('licitacion_id', $offerId)->count() > 0;
    }
}
