<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'fecha_movimiento',
        'descripcion',
        'instrumento_id',
    ];
    
    public $timestamps = false;   
}
