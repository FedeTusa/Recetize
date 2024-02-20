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
            return response()->json(['mensaje' => 'receta no encontrada'], 404);
        }
        return response()->json($receta);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nroReceta' => 'required|numeric|unique:receta', 
            'fechaEmision' => 'required',
            'Paciente_id' => 'required',
            'Medico_id' => 'required'
        ]);
        
        $paciente = Paciente::findOrFail($request->Paciente_id);
        $medico = Medico::findOrFail($request->Medico_id);

        $receta = Receta::create([
            'nroReceta' => $request->nroReceta,
            'fechaEmision' => $request->fechaEmision,
            'Paciente_id' => $paciente->id,
            'Medico_id' => $medico->id
        ]);

        return response()->json($receta, 201);
    }

/*     public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nroReceta' => 'required|numeric|unique:receta', 
            'fechaEmision' => 'required',
            'Remedio_id' => 'required',
            'Paciente_id' => 'required',
            'Medico_id' => 'required'
        ]);

        $receta = Receta::find($id);

        if (!$receta) {
            return response()->json(['mensaje' => 'receta no encontrada'], 404);
        }

        if ($request->input('nroReceta')) {$receta->nroReceta = $request->input('nroReceta');}
        if ($request->input('fechaEmision')) {$receta->fechaEmision = $request->input('fechaEmision');}
        if ($request->input('Remedio_id')) {$remedio->id = $request->input('Remedio_id');}
        if ($request->input('Paciente_id')) {$paciente->celular = $request->input('celular');}
        if ($request->input('Medico_id')) {$paciente->localidad = $request->input('localidad');}

        $receta->save();

        return response()->json($receta);
    } */

    public function destroy($id)
    {
        $receta = Receta::find($id);

        if (!$receta) {
            return response()->json(['mensaje' => 'receta no encontrada'], 404);
        }

        $receta = Receta::where('id', $id)->delete();

        return response()->json(['mensaje' => 'receta eliminada con éxito'], 200);
    }

    public function busqueda(Request $request)
    {
        $nroReceta = $request->input('nroReceta') ? $request->input('nroReceta') : null;;
        $fechaEmision = $request->input('fechaEmision') ? $request->input('fechaEmision') : null;
        $paciente_id = $request->input('paciente_id') ? $request->input('paciente_id') : null;
        $medico_id = $request->input('medico_id') ? $request->input('medico_id') : null;

        $recetaQuery = Receta::query();

        if ($nroReceta) {
            $recetaQuery->where('nroReceta', $nroReceta);
        }

        if ($fechaEmision) {
            $recetaQuery->where('fechaEmision', $fechaEmision);
        }
        
        if ($paciente_id) {
            $recetaQuery->where('paciente_id', $paciente_id);
        }
        
        if ($medico_id) {
            $recetaQuery->where('medico_id', $medico_id);
        }
        
        $receta = $recetaQuery->select('*')
                             ->orderBy('id')
                             ->limit(10)
                             ->get();

        header("Access-Control-Allow-Origin: http://recetize.test");

        return response()->json($receta);


    }

}