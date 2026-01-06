<?php

namespace App\Services;

use App\Models\Oferta;

class ConsecutivoService
{
    public static function generar(): string
    {
        $year = date('y');
        $count = Oferta::count() + 1;

        return sprintf('O-%04d-%s', $count, $year);
    }
}
