<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPatron;
use Throwable;

class TipoPatronController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    public function index()
    {
        try {
            $tipos = TipoPatron::all();
            return view('calidad\tipoPatron\tipoPatrones',['tipos'=>$tipos]);
        } catch (Throwable $e) {
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/home')->with('error',$mensaje);
        } 
    }

        //Delete
        public function destroy($id)
        {
            try {
                $tipo = TipoPatron::findOrFail($id);
                $tipo->delete();
                return redirect('/tipo_patron')->with('success',$tipo->nombre); 
            } catch (Throwable $e) {
                if($e->getCode()==23000){
                    $mensaje='Error al intentar borrar el tipo de patrón solicitado. Existen patrones asociados.';
                    return redirect('/tipo_patron')->with('error',$mensaje);  
                }else{
                    $mensaje='Se ha producido un error';
                    return redirect('/tipo_patron')->with('error',$mensaje);
                }   
            }           
        }
    
        //Update
        public function update(Request $request, $id)
        {   
            try{     
                $validatedData = $request->validate([
                    'nombre' => ['required'],
                    'descripcion' => ['required'],
                ]);  
                $tipo = TipoPatron::findOrFail($id);
                $tipo->nombre = $request->nombre;
                $tipo->descripcion = $request->descripcion;
                $tipo->save();
                return redirect('/tipo_patron')->with('edition','El tipo de patrón se editó correctamente');
            }catch (Throwable $e) { 
                $mensaje='Se ha producido un error';
                return redirect('/tipo_patron')->with('error',$mensaje);
            } 
        }
        
        //Crear
        public function store(Request $request)
        {
            try{
                $validatedData = $request->validate([
                    'nombre' => ['required'],
                    'descripcion' => ['required'],
                ]);
                $tipo = new TipoPatron();
                $tipo->nombre = $request->nombre;
                $tipo->descripcion = $request->descripcion;
                $tipo->save();
                return redirect('/tipo_patron');
            }catch (Throwable $e) { 
                $mensaje='Se ha producido un error';
                return redirect('/tipo_patron')->with('error',$mensaje);
            }
        }
    
        //Mostrar formulario de edicion
        public function edit($id){
            try{
                $tipo = TipoPatron::findOrFail($id);  
                return view('calidad.tipoPatron.editarTipoPatron',['tipo'=>$tipo]);
            }catch (Throwable $e) { 
                $mensaje='Se ha producido un error al cargar el recurso solicitado';
                return redirect('/tipo_patron')->with('error',$mensaje);
            }
        }
}
