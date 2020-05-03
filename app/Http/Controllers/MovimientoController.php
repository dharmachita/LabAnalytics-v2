<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimiento;
use App\Instrumento;
use App\Equipo;
use App\Patron;
use Throwable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $movimientosEquipo = DB::table('movimientos')
                ->join('instrumentos', 'instrumentos.id', '=', 'movimientos.instrumento_id')
                ->join('equipos', 'instrumentos.id', '=', 'equipos.instrumento_id')
                ->select('movimientos.fecha_movimiento',
                        'equipos.nro_equipo as instrumento',
                        'movimientos.descripcion',
                        'movimientos.id'
            );
            $movimientosPatron = DB::table('movimientos')
            ->join('instrumentos', 'instrumentos.id', '=', 'movimientos.instrumento_id')
            ->join('patrons', 'instrumentos.id', '=', 'patrons.instrumento_id')
            ->select('movimientos.fecha_movimiento',
                    'patrons.id_patron as instrumento',
                    'movimientos.descripcion',
                    'movimientos.id'
            );
            $movimientos = $movimientosPatron->union($movimientosEquipo)
            ->orderBy('fecha_movimiento','desc')        
            ->get();
            foreach($movimientos as $movimiento){
                $movimiento->fecha_movimiento = Carbon::parse($movimiento->fecha_movimiento);
            }
            return view('calidad.movimientos.movimientos',['movimientos'=>$movimientos]);
        }catch(Throwable $e){
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/home')->with('error',$mensaje);
        }        
    }

    //mostrar formulario nuevo
    public function indexNuevo()
    {   
        try{
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
            return view('calidad.movimientos.nuevoMovimiento',['instrumentos'=>$instrumentos]);
        }catch (Throwable $e) { 
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/movimientos')->with('error',$mensaje);
        }    
    }  

    //Delete
    public function destroy($id)
    {
        try {
            $movimiento = Movimiento::findOrFail($id);
            $movimiento->delete();
            $mensaje='El evento se eliminó satisfactoriamente';
            return redirect('/movimientos')->with('delete',$mensaje);
        } catch (Throwable $e) {
            $mensaje='Se ha producido un error en la eliminación del evento solicitado';
            return redirect('/movimientos')->with('error',$mensaje);   
        }        
    }

    //Mostrar formulario de edicion
    public function edit($id){
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
    }

    //crear
    public function store(Request $request){
        try{   
            $validatedData = $request->validate([
                'fecha_movimiento' => ['required'],
                'descripcion' => ['required'],
                'instrumento_id' => ['required'],
            ]);  
            $movimiento = new Movimiento;
            $movimiento->fecha_movimiento = $request->fecha_movimiento;
            $movimiento->descripcion = $request->descripcion;
            $movimiento->instrumento_id = $request->instrumento_id;
            $movimiento->save();
            return redirect('/movimientos')->with('success','Se creó un nuevo evento para el equipo seleccionado');
        }catch (Throwable $e) { 
            if($e->getMessage()=="The given data was invalid."){
                return back()->withErrors($e->validator);
            }else{
               $mensaje='Se ha producido un error al editar el evento.';
                return redirect('/movimientos')->with('error',$mensaje);
            }
        }
    }
}
