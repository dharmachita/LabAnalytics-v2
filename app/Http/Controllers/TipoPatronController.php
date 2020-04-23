<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPatron;

class TipoPatronController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    public function index()
    {
        $tipos = TipoPatron::all();
        return view('calidad\tipoPatron\tipoPatrones',['tipos'=>$tipos]);
    }

        //Delete
        public function destroy($id)
        {
            $tipo = TipoPatron::find($id);
            $tipo->delete();
            return redirect('/tipo_patron')->with('success',$tipo->nombre);   
        }
    
        //Update
        public function update(Request $request, $id)
        {      
            $validatedData = $request->validate([
                'nombre' => ['required'],
                'descripcion' => ['required'],
            ]);  
            $tipo = TipoPatron::find($id);
            $tipo->nombre = $request->nombre;
            $tipo->descripcion = $request->descripcion;
            $tipo->save();
            return redirect('/tipo_patron')->with('edition','El tipo de patrón se editó correctamente');
        }
        
        //Crear
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'nombre' => ['required'],
                'descripcion' => ['required'],
            ]);
            $tipo = new TipoPatron();
            $tipo->nombre = $request->nombre;
            $tipo->descripcion = $request->descripcion;
            $tipo->save();
            return redirect('/tipo_patron');
        }
    
        //Mostrar formulario de edicion
        public function edit($id){
            $tipo = TipoPatron::find($id);  
            return view('calidad.tipoPatron.editarTipoPatron',['tipo'=>$tipo]);
        }
}
