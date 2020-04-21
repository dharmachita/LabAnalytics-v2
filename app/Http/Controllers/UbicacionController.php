<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ubicacion;

class UbicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    public function index()
    {
        $ubicaciones = Ubicacion::all();
        return view('calidad\ubicaciones',['ubicaciones'=>$ubicaciones]);
    }

}
