<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoEquipo;

class TipoEquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    public function index()
    {
        $tipos = TipoEquipo::all();
        return view('calidad\tipo_equipo',['tipos'=>$tipos]);
    }
}

