<?php

namespace App\Http\Controllers;

use App\Patron;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\DB;

class PatronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try{
            $patrones = DB::table('instrumentos')
                ->join('patrons', 'instrumentos.id', '=', 'patrons.instrumento_id')
                ->join('tipo_patrons', 'tipo_patrons.id', '=', 'patrons.tipo_patron_id')
                ->select('patrons.valor_nominal',
                        'instrumentos.id',
                        'instrumentos.marca',
                        'patrons.unidad_medida',
                        'instrumentos.serie',
                        'tipo_patrons.nombre as tipo')
                ->get();   
            return view('calidad.patrones.patrones',['patrones'=>$patrones]);
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
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $patron = DB::table('instrumentos')
                ->join('patrons', 'instrumentos.id', '=', 'patrons.instrumento_id')
                ->join('tipo_patrons', 'tipo_patrons.id', '=', 'patrons.tipo_patron_id')
                ->select('patrons.valor_nominal',
                        'instrumentos.id',
                        'instrumentos.marca',
                        'patrons.unidad_medida',
                        'instrumentos.serie',
                        'tipo_patrons.nombre as tipo') 
                ->where('instrumentos.id', '=' ,$id)      
                ->first();
                $check = Patron::where('instrumento_id', '=', $id)->firstOrFail();
            return view('calidad.patrones.detallePatron',['patron'=>$patron]);
        }catch(Throwable $e){
            $mensaje='No se puede mostrar el equipo solicitado';
            return redirect('/patrones')->with('error',$mensaje);
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function edit(Patron $patron)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patron $patron)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patron $patron)
    {
        //
    }
}
