<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reparacion;
use App\Instrumento;
use App\Equipo;
use App\Patron;
use Throwable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Evento;
use App\Movimiento;

class ReparacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $reparaciones = DB::table('reparacions')
                ->join('equipos', 'reparacions.equipo_id', '=', 'equipos.id')
                ->select('reparacions.fecha_reparacion as fecha',
                'reparacions.descripcion',
                'reparacions.id',
                'equipos.nro_equipo as equipo'
                )
                ->orderBy('fecha','desc')        
                ->get();
            foreach($reparaciones as $reparacion){
                $reparacion->fecha = Carbon::parse($reparacion->fecha);
            }
            return view('calidad.reparaciones.reparaciones',['reparaciones'=>$reparaciones]);
        }catch(Throwable $e){
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/home')->with('error',$mensaje);
        }        
    }

    //mostrar formulario nuevo
    public function indexNuevo()
    {   
        
        try{
            $equipos = DB::table('equipos')
            ->select('equipos.nro_equipo as equipo',
                    'equipos.id as id'
            )
            ->orderBy('equipo')
            ->get();     
            return view('calidad.reparaciones.nuevo',['equipos'=>$equipos]);
        }catch (Throwable $e) { 
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/reparaciones')->with('error',$mensaje);
        }    
    }  

    //Delete
    public function destroy($id)
    {
        try {
            $movimiento = Reparacion::findOrFail($id);
            $movimiento->delete();
            $mensaje='La reparación se eliminó satisfactoriamente';
            return redirect('/reparaciones')->with('delete',$mensaje);
        } catch (Throwable $e) {
            $mensaje='Se ha producido un error en la eliminación reparación seleccionada';
            return redirect('/reparaciones')->with('error',$mensaje);   
        }        
    }

    //Mostrar formulario de edicion
    /*public function edit($id){
        try{
            $movimiento = Movimiento::findOrFail($id);
            $patrones = DB::table('patrons')
            ->select('patrons.id_patron as instrumento',
                    'patrons.instrumento_id as id'
            );
            $equipos = DB::table('equipos')
            ->select('equipos.nro_equipo as instrumento',
                    'equipos.instrumento_id as id'
            );
            $instrumentos = $patrones->union($equipos)
            ->orderBy('instrumento')
            ->get();     
            return view('calidad.movimientos.editarMovimiento',['movimiento'=>$movimiento,'instrumentos'=>$instrumentos]);
        }catch (Throwable $e) { 
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/movimientos')->with('error',$mensaje);
        }    
    }

    //Update
    public function update(Request $request, $id)
    {    
        try{   
            $validatedData = $request->validate([
                'fecha_movimiento' => ['required'],
                'descripcion' => ['required'],
                'instrumento_id' => ['required'],
            ]);  
            $movimiento = Movimiento::findOrFail($id);
            $movimiento->fecha_movimiento = $request->fecha_movimiento;
            $movimiento->descripcion = $request->descripcion;
            $movimiento->instrumento_id = $request->instrumento_id;
            $movimiento->save();
            return redirect('/movimientos')->with('edition','El evento se editó correctamente');
        }catch (Throwable $e) { 
            if($e->getMessage()=="The given data was invalid."){
                return back()->withErrors($e->validator);
            }else{
               $mensaje='Se ha producido un error al editar el evento.';
                return redirect('/movimientos')->with('error',$mensaje);
            }
        }        
    }*/

    //crear
    public function store(Request $request){
        try{   
            $validatedData = $request->validate([
                'fecha_reparacion' => ['required'],
                'descripcion' => ['required'],
                'equipo_id' => ['required'],
                'proveedor' => ['required'],
                'costo'=>['numeric','nullable'],
            ]);
         
            $dataReparacion=[
                'fecha_reparacion' => $request->fecha_reparacion,
                'descripcion' => $request->descripcion,
                'equipo_id' => $request->equipo_id,
                'proveedor' => $request->proveedor,
                'verificacion' => $request->verificacion,
                'costo' => $request->costo,
            ];
            $reparacion = Reparacion::create($dataReparacion);
            $evento= new Evento();
            $evento->fecha_evento = $request->fecha_reparacion;
            $evento->descripcion='Se crea el registro de la reparacion';
            $evento->reparacion_id=$reparacion->id;
            $evento->save();

            $equipo=DB::table('equipos')
            ->select('instrumento_id')
            ->where('id','=',$request->equipo_id)
            ->first();
            $movimiento = new Movimiento();
            $movimiento->fecha_movimiento = $request->fecha_reparacion;
            $movimiento->instrumento_id=$equipo->instrumento_id;
            $movimiento->descripcion='Se registra evento de reparacion';
            $movimiento->save();

            $mensaje='Se cargó una nueva reparación para el equipo seleccionado';
            return redirect('/reparaciones')->with('success',$mensaje);
        }catch (Throwable $e) { 
            if($e->getMessage()=="The given data was invalid."){
                return back()->withErrors($e->validator);
            }else{
               $mensaje='Se ha producido un error al editar el evento.';
                return redirect('/reparaciones')->with('error',$mensaje);
            }
        }
    }

    public function show($id)
    {
        try{
            $reparacion = DB::table('reparacions')
                ->join('equipos', 'reparacions.equipo_id', '=', 'equipos.id')
                ->select('reparacions.fecha_reparacion',
                'reparacions.descripcion',
                'reparacions.proveedor',
                'reparacions.id',
                'equipos.nro_equipo as equipo',
                'reparacions.verificacion',
                'reparacions.costo'
                )
                ->where('reparacions.id','=',$id) 
                ->first();       
            $reparacion->fecha_reparacion = Carbon::parse($reparacion->fecha_reparacion);
            
            $eventos = DB::table('eventos')
                ->where('reparacion_id','=',$id)
                ->orderBy('fecha_evento','desc')        
                ->get();
            foreach($eventos as $evento){
                $evento->fecha_evento = Carbon::parse($evento->fecha_evento);    
            }   
            return view('calidad.reparaciones.detalle',['reparacion'=>$reparacion,'eventos'=>$eventos]);
        }catch(Throwable $e){
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/reparaciones')->with('error',$mensaje);
        }  
    }
    
    public function crearEvento(Request $request){
        try{   
            $validatedData = $request->validate([
                'fecha_evento' => ['required'],
                'descripcion' => ['required'],
                'reparacion_id' => ['required'],
            ]);  
            $evento = new Evento;
            $evento->fecha_evento = $request->fecha_evento;
            $evento->descripcion = $request->descripcion;
            $evento->reparacion_id = $request->reparacion_id;
            $evento->save();
            $mensaje='Se registró un nuevo evento para la reparación';
            return back()->with('success',$mensaje);
        }catch (Throwable $e) { 
            if($e->getMessage()=="The given data was invalid."){
                return back()->withErrors($e->validator);
            }else{
               $mensaje='Se ha producido un error al editar el evento.';
                return redirect('/reparaciones')->with('error',$mensaje);
            }
        }
    }

}


