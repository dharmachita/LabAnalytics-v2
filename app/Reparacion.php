<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    protected $fillable = [
        'fecha_reparacion',
        'descripcion',
        'equipo_id',
        'proveedor',
        'costo',
        'verificacion',
    ];

    public $timestamps = false;    
}
