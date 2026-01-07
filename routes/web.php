<?php

use App\Controllers\OfertaController;
use App\Controllers\ActividadController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$controller = new OfertaController();
$actividadController = new ActividadController();

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

if ($method === 'GET' && $uri === '/api/ofertas') {
    $controller->index();
    return;
}

if ($method === 'POST' && $uri === '/api/ofertas') {
    $controller->store();
    return;
}

if ($method === 'GET' && preg_match('#^/api/ofertas/(\d+)$#', $uri, $matches)) {
    $controller->show((int) $matches[1]);
    return;
}

if ($method === 'PUT' && preg_match('#^/api/ofertas/(\d+)$#', $uri, $matches)) {
    $controller->update((int) $matches[1]);
    return;
}

if ($method === 'POST' && preg_match('#^/api/ofertas/(\d+)/documentos$#', $uri, $matches)) {
    $controller->uploadDocumento((int) $matches[1]);
    return;
}

if ($method === 'GET' && $uri === '/api/ofertas/export') {
    $controller->export();
    return;
}

if ($method === 'GET' && $uri === '/api/actividades') {
    $actividadController->index();
    return;
}

/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/

http_response_code(404);
echo '404 | Ruta no encontrada';
