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
                        'movimientos.descripcion'
            );
            $movimientosPatron = DB::table('movimientos')
            ->join('instrumentos', 'instrumentos.id', '=', 'movimientos.instrumento_id')
            ->join('patrons', 'instrumentos.id', '=', 'patrons.instrumento_id')
            ->select('movimientos.fecha_movimiento',
                    'patrons.id_patron as instrumento',
                    'movimientos.descripcion'
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
}
