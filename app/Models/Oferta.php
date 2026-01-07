<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $table = 'ofertas';

    protected $fillable = [
        'consecutivo',
        'objeto',
        'descripcion',
        'moneda',
        'presupuesto',
        'actividad_id',
        'fecha_inicio',
        'hora_inicio',
        'fecha_cierre',
        'hora_cierre',
        'estado',
    ];

    public $timestamps = false;

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'licitacion_id');
    }
}
