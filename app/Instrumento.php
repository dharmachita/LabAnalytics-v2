<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrumento extends Model
{
    protected $fillable = [
        'fecha_alta',
        'marca',
        'serie',
        ];
        
    public $timestamps = false;    
}
