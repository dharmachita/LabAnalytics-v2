<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'nro_equipo',
        'modelo',
        'imagen',
        'es_calibrable',
        'emp',
        'apreciacion',
        'rango',
        'tipo_equipo_id',
        'ubicacion_id',
        'instrumento_id',
    ];
    
    public $timestamps = false;    
}
