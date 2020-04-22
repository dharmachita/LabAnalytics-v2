<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ubicacion;

class UbicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    //Mostrar los elementos en el view
    public function index()
    {
        $ubicaciones = Ubicacion::all();
        return view('calidad\ubi\ubicaciones',['ubicaciones'=>$ubicaciones]);
    }

    //Delete
    public function destroy($id)
    {
        $ubicacion = Ubicacion::find($id);
        $ubicacion->delete();
        return redirect('/ubicaciones')->with('success',$ubicacion->nombre);   
    }

    //Update
    public function update(Request $request, $id)
    {      
        $validatedData = $request->validate([
            'nombre' => ['required'],
            'descripcion' => ['required'],
        ]);  
        $ubicacion = Ubicacion::find($id);
        $ubicacion->nombre = $request->nombre;
        $ubicacion->descripcion = $request->descripcion;
        $ubicacion->save();
        return redirect('/ubicaciones');
    }
    
    //Crear
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => ['required'],
            'descripcion' => ['required'],
        ]);
        $ubicacion = new Ubicacion();
        $ubicacion->nombre = $request->nombre;
        $ubicacion->descripcion = $request->descripcion;
        $ubicacion->save();
        return redirect('/ubicaciones');
    }
}
