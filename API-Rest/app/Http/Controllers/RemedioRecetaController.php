<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Remedio;
use App\Models\Receta;
use App\Models\RemedioReceta;
use Illuminate\Http\Request;

class RemedioRecetaController extends Controller
{
    public function showAll()
    {
        $remedioreceta = RemedioReceta::all();
        
        return response()->json($remedioreceta);
    }

    public function show($id)
    {
        $remedioreceta = RemedioReceta::find($id);
        
        if (!$remedioreceta) {
            return response()->json(['mensaje' => 'no existe remedioreceta'], 404);
        }
        return response()->json($remedioreceta);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'remedio_id' => 'required'
        ]);
        
        $remedio = Remedio::findOrFail($request->remedio_id);

        $remedioreceta = RemedioReceta::create([
            'remedio_id' => $remedio->id
        ]);

        return response()->json($remedioreceta, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'remedio_id' => 'numeric', 
            'receta_id' => 'numeric'
        ]);

        $remedioreceta = RemedioReceta::find($id);

        if (!$remedioreceta) {
            return response()->json(['mensaje' => 'no existe remedioreceta con id= ' . $id], 404);
        }

        if ($request->input('remedio_id')) {$remedioreceta->remedio_id = $request->input('remedio_id');}
        if ($request->input('receta_id')) {$remedioreceta->receta_id = $request->input('receta_id');}

        $remedioreceta->save();

        return response()->json($remedioreceta);
    }

}