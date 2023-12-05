<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Remedio;
use App\Models\Medico;
use App\Models\Receta;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function showAll()
    {
        $recetas = Receta::all();
        
        return response()->json($recetas);
    }

    public function show($id)
    {
        $receta = Receta::find($id);
        
        if (!$receta) {
            return response()->json(['mensaje' => 'receta no encontrado'], 404);
        }
        return response()->json($receta);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nroReceta' => 'required|numeric|unique:receta', 
            'fechaEmision' => 'required',
            'Remedio_id' => 'required',
            'Paciente_id' => 'required',
            'Medico_id' => 'required'
        ]);
        
        $paciente = Paciente::findOrFail($request->Paciente_id);
        $remedio = Remedio::findOrFail($request->Remedio_id);
        $medico = Medico::findOrFail($request->Medico_id);

        $receta = Receta::create([
            'nroReceta' => $request->nroReceta,
            'fechaEmision' => $request->fechaEmision,
            'Remedio_id' => $remedio->id,
            'Paciente_id' => $paciente->id,
            'Medico_id' => $medico->id
        ]);

        return response()->json($receta, 201);
    }

}