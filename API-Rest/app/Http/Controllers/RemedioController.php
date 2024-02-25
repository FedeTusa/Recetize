<?php

namespace App\Http\Controllers;


use App\Models\Remedio;
use Illuminate\Http\Request;

class RemedioController extends Controller
{
    public function showAll()
    {
        $remedios = Remedio::all();
        
        return response()->json($remedios);
    }

    public function show($id)
    {
        $remedio = Remedio::find($id);
        
        if (!$remedio) {
            return response()->json(['mensaje' => 'remedio no encontrado'], 404);
        }
        return response()->json($remedio);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|numeric|unique:remedio',           // esta el validador codigo|digits:10 que no se como usarlo
            'droga' => 'required|string|max:100',
            'medicamento' => 'nullable|string|max:100'
        ]);
        
        $remedio = Remedio::create([
            'codigo' => $request->codigo,
            'droga' => $request->droga,
            'medicamento' => $request->medicamento
        ]);
        
        return response()->json($remedio, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'codigo' => 'numeric|unique:remedio',
            'droga' => 'string|max:100',
            'medicamento' => 'nullable|string|max:100'
        ]);

        $remedio = Remedio::find($id);

        if (!$remedio) {
            return response()->json(['mensaje' => 'remedio no encontrado'], 404);
        }

        if ($request->input('codigo')) {$remedio->codigo = $request->input('codigo');}
        if ($request->input('droga')) {$remedio->droga = $request->input('droga');}
        if ($request->input('medicamento')) {$remedio->medicamento = $request->input('medicamento');}

        $remedio->save();

        return response()->json($remedio);
    }

    public function destroy($id)
    {
        $remedio = Remedio::find($id);

        if (!$remedio) {
            return response()->json(['mensaje' => 'remedio no encontrado'], 404);
        }

        $remedio = Remedio::where('id', $id)->delete();

        return response()->json(['mensaje' => 'remedio eliminado con éxito'], 200);
    }

    public function busqueda(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $remedio = Remedio::where('codigo', 'like', '%' . $busqueda . '%')
                     ->select('id', 'codigo', 'droga')
                     ->orderBy('id')
                     ->limit(10)
                     ->get();
                     
        header("Access-Control-Allow-Origin: http://recetize.test");

        return response()->json($remedio);
    }

}
