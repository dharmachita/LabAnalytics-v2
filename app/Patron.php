<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    protected $fillable = [
        'id_patron',
        'valor_nominal',
        'unidad_medida',
        'tipo_patron_id',
        'instrumento_id',
    ];
    
    public $timestamps = false;  

  

    
}
