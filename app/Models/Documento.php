<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'ofertas_documentos';

    protected $fillable = [
        'licitacion_id',
        'titulo',
        'descripcion',
        'archivo',
        'creado_en',
    ];

    public $timestamps = false;
}
