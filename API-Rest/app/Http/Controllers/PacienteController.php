<?php

namespace App\Http\Controllers;


use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function showAll()
    {
        $pacientes = Paciente::all();
        
        return response()->json($pacientes);
    }

    public function show($id)
    {
        $paciente = Paciente::find($id);
        
        if (!$paciente) {
            return response()->json(['mensaje' => 'paciente no encontrado'], 404);
        }
        return response()->json($paciente);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'dni' => 'required|numeric|unique:paciente', 
            'nombre' => 'required|string|min:3|max:100',
            'apellido' => 'required|string|min:3|max:100',
            'celular' => 'required|string',
            'localidad' => 'required|string|min:2|max:50',
            'calle' => 'required|string|min:2|max:50',
            'altura' => 'required|numeric'
        ]);
        
        $paciente = Paciente::create([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'celular' => $request->celular,
            'localidad' => $request->localidad,
            'calle' => $request->calle,
            'altura' => $request->altura
        ]);
        
        return response()->json($paciente, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dni' => 'numeric|unique:paciente', 
            'nombre' => 'string|min:3|max:100',
            'apellido' => 'string|min:3|max:100',
            'celular' => 'string|min:8|max:10',
            'localidad' => 'string|min:2|max:50',
            'calle' => 'string|min:2|max:50',
            'altura' => 'numeric'
        ]);

        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['mensaje' => 'paciente no encontrado'], 404);
        }

        if ($request->input('dni')) {$paciente->dni = $request->input('dni');}
        if ($request->input('nombre')) {$paciente->nombre = $request->input('nombre');}
        if ($request->input('apellido')) {$paciente->apellido = $request->input('apellido');}
        if ($request->input('celular')) {$paciente->celular = $request->input('celular');}
        if ($request->input('localidad')) {$paciente->localidad = $request->input('localidad');}
        if ($request->input('calle')) {$paciente->calle = $request->input('calle');}
        if ($request->input('altura')) {$paciente->altura = $request->input('altura');}

        $paciente->save();

        return response()->json($paciente);
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['mensaje' => 'paciente no encontrado'], 404);
        }

        $paciente = Paciente::where('id', $id)->delete();

        return response()->json(['mensaje' => 'paciente eliminado con éxito'], 200);
    }

    public function busqueda(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $paciente = Paciente::where('dni', 'like', '%' . $busqueda . '%')
                     ->select('id', 'dni')
                     ->orderBy('id')
                     ->limit(10)
                     ->get();

        return response()->json($paciente);
    }

}