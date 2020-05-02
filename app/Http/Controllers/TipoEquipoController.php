<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoEquipo;
use Throwable;

class TipoEquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    public function index()
    {
        try {
            $tipos = TipoEquipo::all();
            return view('calidad.tipoEquipo.tipoEquipos',['tipos'=>$tipos]);
        } catch (Throwable $e) {
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/home')->with('error',$mensaje);
        }   
    }

        //Delete
        public function destroy($id)
        {
            try {
                $tipo = TipoEquipo::findOrFail($id);
                $tipo->delete();
                return redirect('/tipo_equipo')->with('success',$tipo->nombre);
            } catch (Throwable $e) {
                if($e->getCode()==23000){
                    $mensaje='Error al intentar borrar el tipo de equipo solicitado. Existen equipos asociados.';
                    return redirect('/tipo_equipo')->with('error',$mensaje);  
                }else{
                    $mensaje='Se ha producido un error';
                    return redirect('/tipo_equipo')->with('error',$mensaje);
                }   
            }        
        }
    
        //Update
        public function update(Request $request, $id)
        {    
            try{   
                $validatedData = $request->validate([
                    'nombre' => ['required'],
                    'uso' => ['required'],
                ]);  
                $tipo = TipoEquipo::findOrFail($id);
                $tipo->nombre = $request->nombre;
                $tipo->uso = $request->uso;
                $tipo->save();
                return redirect('/tipo_equipo')->with('edition','El tipo de equipo se editó correctamente');
            }catch (Throwable $e) { 
                if($e->getMessage()=="The given data was invalid."){
                    return back()->withErrors($e->validator);
                }else{
                   $mensaje='Se ha producido un error al editar el tipo de equipo.';
                    return redirect('/tipo_equipo')->with('error',$mensaje);
                }
            }        
        }
        
        //Crear
        public function store(Request $request)
        {
            try{
                $validatedData = $request->validate([
                    'nombre' => ['required'],
                    'uso' => ['required'],
                ]);
                $tipo = new TipoEquipo();
                $tipo->nombre = $request->nombre;
                $tipo->uso = $request->uso;
                $tipo->save();
                return redirect('/tipo_equipo')->with('created','Tipo de Equipo creado correctamente');
            }catch (Throwable $e) { 
                $mensaje='Se ha producido un error';
                return redirect('/tipo_equipo')->with('error',$mensaje);
            }
        }
    
        //Mostrar formulario de edicion
        public function edit($id){
            try{
                $tipo = TipoEquipo::findOrFail($id);  
                return view('calidad.tipoEquipo.editarTipoEquipo',['tipo'=>$tipo]);
            }catch (Throwable $e) { 
                $mensaje='Se ha producido un error al cargar el recurso solicitado';
                return redirect('/tipo_equipo')->with('error',$mensaje);
            }    
        }
}

