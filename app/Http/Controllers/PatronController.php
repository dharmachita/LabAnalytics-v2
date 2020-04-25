<?php

namespace App\Http\Controllers;

use App\Patron;
use App\Instrumento;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\DB;
use App\TipoPatron;

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

    public function indexNuevo()
    {
        $tipoPatrones=TipoPatron::all();
        return view('calidad.patrones.nuevo',['tipoPatrones'=>$tipoPatrones]);
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
        try{
            $validatedData = $request->validate([
                'fecha_alta' => ['required'],
                'marca' => ['required'],
                'serie' => ['required'],
                'valor_nominal' => ['required','numeric'],
                'unidad_medida' => ['required'],
                'tipo_patron_id' => ['required'],
            ]);
            $dataInstrumento = [
                'fecha_alta' => $request->fecha_alta,
                'marca' => $request->marca,
                'serie' => $request->serie,
            ];
            $instrumento = Instrumento::create($dataInstrumento);
            $id_patron = $request->serie . "-" . $request->valor_nominal;           

            $dataPatron = [
                'id_patron' => $id_patron,
                'valor_nominal' => $request->valor_nominal,
                'unidad_medida' => $request->unidad_medida,
                'tipo_patron_id' => $request->tipo_patron_id,
                'instrumento_id' => $instrumento->id,
            ];
            $equipo = Patron::create($dataPatron);
            $mensaje=$id_patron;
            return redirect('/patrones')->with('success',$mensaje);
        }catch (Throwable $e){
            if($e->getMessage()=="The given data was invalid."){
                return back()->withErrors($e->validator);
            }else{
                $mensaje='Se ha producido un error al crear el patrón.';
                return redirect('/patrones')->with('error',$mensaje);
            }
        }
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
                        'patrons.id as patron_id',
                        'patrons.id_patron as identificador',
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
            $mensaje='No se puede mostrar el patrón solicitado';
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
