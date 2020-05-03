<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\TipoEquipo;
use App\Ubicacion;
use App\Movimiento;
use Illuminate\Http\Request;
use App\Instrumento;
use Throwable;
use Illuminate\Support\Facades\DB;
use Random;
use Carbon\Carbon;


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
                ->orderBy('equipos.id')
                ->get();
            return view('calidad.equipos.equipos',['equipos'=>$equipos]);
        }catch(Throwable $e){
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/home')->with('error',$mensaje);
        }    
    }

    public function indexNuevo()
    {
        $ubicaciones=Ubicacion::all();
        $tipoEquipos=TipoEquipo::all();
        return view('calidad.equipos.nuevo',['tipoEquipos'=>$tipoEquipos,'ubicaciones'=>$ubicaciones]);
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
                'modelo' => ['required'],
                'ubicacion_id' => ['required'],
                'tipo_equipo_id' => ['required'],
                'rango' => ['nullable'],
                'emp' => ['nullable','numeric'],
                'apreciacion' => ['nullable','numeric'],
                'imagen' => ['nullable','max:5000'],
            ]);
            $dataInstrumento = [
                'fecha_alta' => $request->fecha_alta,
                'marca' => $request->marca,
                'serie' => $request->serie,
            ];
            $instrumento = Instrumento::create($dataInstrumento);
            
            if($request->es_calibrable){
                $request->es_calibrable=1;    
            }else{
                $request->es_calibrable=0;
            }
            
            
            //Buscar en BBDD último id de instrumento y agregar 1 para formar Nro de Equipo
            $lastNro = DB::table('equipos')->max('id');
            if($lastNro!=null){
                $lastPlusOne = $lastNro + 1;
            }else{
                $lastPlusOne = 1;
            }
            
            if(($lastPlusOne/10)<1){
                $nroEquipo = '211-00'.$lastPlusOne;    
            }else if(($lastPlusOne)/10<10){
                $nroEquipo = '211-0'.$lastPlusOne;
            }else{
                $nroEquipo = '211-'.$lastPlusOne;
            }

            //Tratamiento de imagen
            if($request->file()!=null){
                $archivo = $request->file('imagen');
                $nombreImagen = $nroEquipo . 'imagen' . "." . $archivo->getClientOriginalExtension();
                $archivo->move('img\equipos',$nombreImagen);
            }else{
                $nombreImagen=null;
            }
            
            $dataEquipo = [
                'nro_equipo' => $nroEquipo,
                'modelo' => $request->modelo,
                'imagen' => $nombreImagen,
                'es_calibrable' => $request->es_calibrable,
                'emp' => $request->emp,
                'apreciacion' => $request->apreciacion,
                'rango'=> $request->rango,
                'tipo_equipo_id' => $request->tipo_equipo_id,
                'ubicacion_id' => $request->ubicacion_id,
                'instrumento_id' => $instrumento->id,
            ];
            $equipo = Equipo::create($dataEquipo);
            $dataMovimiento=[
                'fecha_movimiento'=>$dataInstrumento['fecha_alta'],
                'descripcion'=>'Se realiza el alta del equipo',
                'instrumento_id'=>$instrumento->id,
            ];
            $movimiento = Movimiento::create($dataMovimiento);
            $mensaje=$nroEquipo;
            return redirect('/equipos')->with('success',$mensaje);
        }catch (Throwable $e){
            if($e->getMessage()=="The given data was invalid."){
                return back()->withErrors($e->validator);
            }else{
               $mensaje='Se ha producido un error al crear el equipo.';
                return redirect('/equipos')->with('error',$mensaje);
            }
        }
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
            //DATOS GENERALES
            $equipo = DB::table('instrumentos')
                ->join('equipos', 'instrumentos.id', '=', 'equipos.instrumento_id')
                ->join('tipo_equipos', 'tipo_equipos.id', '=', 'equipos.tipo_equipo_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'equipos.ubicacion_id')
                ->select('equipos.nro_equipo',
                        'instrumentos.fecha_alta',
                        'instrumentos.id as id',
                        'equipos.id as equipo_id',
                        'instrumentos.marca',
                        'equipos.modelo',
                        'instrumentos.serie',
                        'tipo_equipos.nombre as tipo',
                        'equipos.imagen',
                        'equipos.rango',
                        'equipos.emp',
                        'equipos.apreciacion',
                        'ubicacions.nombre as ubicacion')
                ->where('instrumentos.id', '=' ,$id)      
                ->first();
                if(!isset($equipo->imagen)){
                    $equipo->imagen='blank.png';
                }
                if(!isset($equipo->emp)){
                    $equipo->emp='-';
                }
                if(!isset($equipo->rango)){
                    $equipo->rango='-';
                }
                if(!isset($equipo->apreciacion)){
                    $equipo->apreciacion='-';
                }
                $check = Equipo::where('instrumento_id', '=', $id)->firstOrFail();
                $equipo->fecha_alta = Carbon::parse($equipo->fecha_alta);
                
                //MOVIMIENTOS
                $movimientos=DB::table('movimientos')
                    ->where('instrumento_id','=',$id)
                    ->orderBy('fecha_movimiento','desc')
                    ->limit('5')
                    ->get();
                
                $cantidadMov=DB::table('movimientos')
                    ->where('instrumento_id','=',$id)
                    ->count();   
                
                foreach($movimientos as $movimiento){
                    $movimiento->fecha_movimiento = Carbon::parse($movimiento->fecha_movimiento);
                }
                
                //REPARACIONES
                $reparaciones=DB::table('reparacions')
                    ->join('equipos','reparacions.equipo_id','equipos.id')
                    ->where('equipos.instrumento_id','=',$id)
                    ->orderBy('fecha_reparacion','desc')
                    ->limit('5')
                    ->get();
                
                $cantidadRep=DB::table('reparacions')
                    ->join('equipos','reparacions.equipo_id','equipos.id')
                    ->where('instrumento_id','=',$id)
                    ->count();   
                
                foreach($reparaciones as $reparacion){
                    $reparacion->fecha_reparacion = Carbon::parse($reparacion->fecha_reparacion);
                }    
                
                return view('calidad.equipos.detalleEquipo',
                    [
                    'equipo'=>$equipo,
                    'movimientos'=>$movimientos,
                    'cantidadMov'=>$cantidadMov,
                    'reparaciones'=>$reparaciones,
                    'cantidadRep'=>$cantidadRep,
                    ]);
                    /*return
                    dd([
                    'equipo'=>$equipo,
                    'movimientos'=>$movimientos,
                    'cantidadMov'=>$cantidadMov,
                    'reparaciones'=>$reparaciones,
                    'cantidadRep'=>$cantidadRep,
                    ]); */   
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
