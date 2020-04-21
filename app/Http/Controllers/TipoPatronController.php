<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPatron;

class TipoPatronController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    public function index()
    {
        $tipos = TipoPatron::all();
        return view('calidad\tipo_patron',['tipos'=>$tipos]);
    }
}
