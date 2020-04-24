<?php

namespace App\Http\Controllers;

use App\Instrumento;
use Illuminate\Http\Request;
use App\Equipo;
use App\Patron;
use Throwable;
use Illuminate\Support\Facades\DB;



class InstrumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try{
            $equipos = DB::table('instrumentos')
                ->join('equipos', 'instrumentos.id', '=', 'equipos.instrumento_id')
                ->join('tipo_equipos', 'tipo_equipos.id', '=', 'equipos.tipo_equipo_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'equipos.ubicacion_id')
                ->select('equipos.nro_equipo',
                        'instrumentos.id',
                        'instrumentos.marca',
                        'equipos.modelo',
                        'instrumentos.serie',
                        'tipo_equipos.nombre as tipo',
                        'ubicacions.nombre as ubicacion')
                ->get();
            $patrones = Patron::all();
            return view('instrumentos.instrumentos',['equipos'=>$equipos,'patrones'=>$patrones]);
        }catch(Throwable $e){
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/home')->with('error',$mensaje);
        }    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instrumento  $instrumento
     * @return \Illuminate\Http\Response
     */
    public function show(Instrumento $instrumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instrumento  $instrumento
     * @return \Illuminate\Http\Response
     */
    public function edit(Instrumento $instrumento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instrumento  $instrumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instrumento $instrumento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instrumento  $instrumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instrumento $instrumento)
    {
        //
    }
}
