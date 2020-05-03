<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            $reparaciones = DB::table('reparacions')->count();
            $equipos = DB::table('equipos')->count();
            $patrones = DB::table('patrons')->count();
            $calibrables = DB::table('equipos')->where('es_calibrable','=','1')->count();
            return view('home',[
                'reparaciones'=>$reparaciones,
                'equipos'=>$equipos,
                'patrones'=>$patrones,
                'calibrables'=>$calibrables,
                ]);
        }catch(Throwable $e){
            $equipos = null;
            $$reparaciones = null;
            $patrones = null;
            $calibrables = null;
            return view('home',[
                'reparaciones'=>$reparaciones,
                'equipos'=>$equipos,
                'patrones'=>$patrones,
                'calibrables'=>$calibrables,
                ]);   
        }
     
    }
}
