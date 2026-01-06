<?php

use App\Controllers\OfertaController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$controller = new OfertaController();

if ($method === 'GET' && $uri === '/ofertas') {
    $controller->index();
    return;
}

if ($method === 'GET' && preg_match('#^/ofertas/(\d+)$#', $uri, $matches)) {
    $controller->show((int)$matches[1]);
    return;
}

if ($method === 'POST' && $uri === '/ofertas') {
    $controller->store();
    return;
}


http_response_code(404);
echo '404 | Ruta no encontrada';
