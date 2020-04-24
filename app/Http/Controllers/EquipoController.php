<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Http\Request;
use App\Instrumento;
use Throwable;
use Illuminate\Support\Facades\DB;


class EquipoController extends Controller
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
            return view('calidad.equipos.equipos',['equipos'=>$equipos]);
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
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $equipo = DB::table('instrumentos')
                ->join('equipos', 'instrumentos.id', '=', 'equipos.instrumento_id')
                ->join('tipo_equipos', 'tipo_equipos.id', '=', 'equipos.tipo_equipo_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'equipos.ubicacion_id')
                ->select('equipos.nro_equipo',
                        'instrumentos.id as id',
                        'equipos.id as equipo_id',
                        'instrumentos.marca',
                        'equipos.modelo',
                        'instrumentos.serie',
                        'tipo_equipos.nombre as tipo',
                        'ubicacions.nombre as ubicacion')
                ->where('instrumentos.id', '=' ,$id)      
                ->first();
                $check = Equipo::where('instrumento_id', '=', $id)->firstOrFail();
                return view('calidad.equipos.detalleEquipo',['equipo'=>$equipo]);
        }catch(Throwable $e){
            $mensaje='No se puede mostrar el equipo solicitado';
            return redirect('/equipos')->with('error',$mensaje);
        }      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        //
    }
}
