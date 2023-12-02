<?php

namespace App\Http\Controllers;


use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function showAll()
    {
        $medicos = Medico::all();
        
        return response()->json($medicos);
    }

    public function show($id)
    {
        $medico = Medico::find($id);
        
        if (!$medico) {
            return response()->json(['mensaje' => 'medico no encontrado'], 404);
        }
        return response()->json($medico);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'matricula' => 'required|numeric|unique:medico', 
            'nombre' => 'required|string|min:3|max:100',
            'apellido' => 'required|string|min:3|max:100',
            'especialidad' => 'required|string|min:2|max:100',
            'localidad' => 'required|string|min:2|max:50'
        ]);
        
        $medico = Medico::create([
            'matricula' => $request->matricula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'especialidad' => $request->especialidad,
            'localidad' => $request->localidad
        ]);
        
        return response()->json($medico, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'matricula' => 'numeric|unique:medico', 
            'nombre' => 'string|min:3|max:100',
            'apellido' => 'string|min:3|max:100',
            'especialidad' => 'string|min:2|max:100',
            'localidad' => 'string|min:2|max:50'
        ]);

        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['mensaje' => 'medico no encontrado'], 404);
        }

        if ($request->input('matricula')) {$medico->matricula = $request->input('matricula');}
        if ($request->input('nombre')) {$medico->nombre = $request->input('nombre');}
        if ($request->input('apellido')) {$medico->apellido = $request->input('apellido');}
        if ($request->input('especialidad')) {$medico->especialidad = $request->input('especialidad');}
        if ($request->input('localidad')) {$medico->localidad = $request->input('localidad');}

        $medico->save();

        return response()->json($medico);
    }

    public function destroy($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['mensaje' => 'medico no encontrado'], 404);
        }

        $medico = Medico::where('id', $id)->delete();

        return response()->json(['mensaje' => 'medico eliminado con éxito'], 200);
    }

}