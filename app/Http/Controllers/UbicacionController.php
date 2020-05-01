<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ubicacion;
use App\Exceptions\Handler;
use Throwable;

class UbicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    //Mostrar los elementos en el view
    public function index()
    {
        try {
            $ubicaciones = Ubicacion::all();
            return view('calidad.ubi.ubicaciones',['ubicaciones'=>$ubicaciones]);
        } catch (Throwable $e) {
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/home')->with('error',$mensaje);
        }    
    }   

    //Delete
    public function destroy($id)
    {
        try {
            $ubicacion = Ubicacion::findOrFail($id);
            $ubicacion->delete();
            return redirect('/ubicaciones')->with('success',$ubicacion->nombre);
        } catch (Throwable $e) {
            if($e->getCode()==23000){
                $mensaje='Error al intentar borrar la ubicación solicitada. Existen equipos asociados.';
                return redirect('/ubicaciones')->with('error',$mensaje);  
            }else{
                $mensaje='Se ha producido un error';
                return redirect('/ubicaciones')->with('error',$mensaje);
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
            $ubicacion = Ubicacion::findOrFail($id);
            $ubicacion->nombre = $request->nombre;
            $ubicacion->descripcion = $request->descripcion;
            $ubicacion->save();
            return redirect('/ubicaciones')->with('edition','La ubicación se editó correctamente');
        }catch (Throwable $e) { 
            $mensaje='Se ha producido un error';
            return redirect('/ubicaciones')->with('error',$mensaje);
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
            $ubicacion = new Ubicacion();
            $ubicacion->nombre = $request->nombre;
            $ubicacion->descripcion = $request->descripcion;
            $ubicacion->save();
            return redirect('/ubicaciones')->with('created','Ubicación creada correctamente');
        }catch (Throwable $e) { 
            $mensaje='Se ha producido un error';
            return redirect('/ubicaciones')->with('error',$mensaje);
        }
    }

    //Mostrar formulario de edicion
    public function edit($id){
        try{
            $ubicacion = Ubicacion::findOrFail($id);  
            return view('calidad.ubi.editarUbicacion',['ubicacion'=>$ubicacion]);
        }catch (Throwable $e) { 
            $mensaje='Se ha producido un error al cargar el recurso solicitado';
            return redirect('/ubicaciones')->with('error',$mensaje);
        }
    }
}
