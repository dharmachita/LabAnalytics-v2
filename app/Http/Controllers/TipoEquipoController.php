<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoEquipo;

class TipoEquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('calidad');
    }

    public function index()
    {
        $tipos = TipoEquipo::all();
        return view('calidad\tipoEquipo\tipoEquipos',['tipos'=>$tipos]);
    }

        //Delete
        public function destroy($id)
        {
            $tipo = TipoEquipo::find($id);
            $tipo->delete();
            return redirect('/tipo_equipo')->with('success',$tipo->nombre);   
        }
    
        //Update
        public function update(Request $request, $id)
        {      
            $validatedData = $request->validate([
                'nombre' => ['required'],
                'uso' => ['required'],
            ]);  
            $tipo = TipoEquipo::find($id);
            $tipo->nombre = $request->nombre;
            $tipo->uso = $request->uso;
            $tipo->save();
            return redirect('/tipo_equipo')->with('edition','El tipo de equipo se editó correctamente');
        }
        
        //Crear
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'nombre' => ['required'],
                'uso' => ['required'],
            ]);
            $tipo = new TipoEquipo();
            $tipo->nombre = $request->nombre;
            $tipo->uso = $request->uso;
            $tipo->save();
            return redirect('/tipo_equipo');
        }
    
        //Mostrar formulario de edicion
        public function edit($id){
            $tipo = TipoEquipo::find($id);  
            return view('calidad.tipoEquipo.editarTipoEquipo',['tipo'=>$tipo]);
        }
}

