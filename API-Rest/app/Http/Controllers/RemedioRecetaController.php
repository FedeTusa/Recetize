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

    public function store(Request $request)
    {
        // dd(1);
        $receta_id = $request->input('receta_id');
        $remedio_id = $request->input('remedio_id');
        
        // Validar los datos
        if (empty($receta_id) || empty($remedio_id)) {
            return response()->json(['status' => 'error', 'message' => 'Datos incompletos'], 400);
        }

        $remedioreceta = RemedioReceta::create([
            'remedio_id' => $request->remedio_id,
            'receta_id' => $request->receta_id
        ]);

        return response()->json($remedioreceta, 201);
    }
    public function busqueda(Request $request)
    {
        $nroReceta = $request->input('nroReceta');

        // Validar que se proporcionó el nroReceta
        if (!$nroReceta) {
            return response()->json(['error' => 'El campo nroReceta es obligatorio'], 400);
        }

        // Buscar remedio_id en la tabla remedioreceta basados en receta_id (nroReceta)
        $remedioIds = RemedioReceta::where('nroReceta','LIKE', $nroReceta)->pluck('remedio_id');

        if ($remedioIds->isEmpty()) {
            return response()->json(['error' => 'No se encontraron remedios para el nroReceta proporcionado'], 404);
        }

        // Obtener los detalles de los remedios basados en los remedio_id obtenidos
        $remedios = Remedio::whereIn('id', $remedioIds)->get();

        // Devolver los remedios encontrados en formato JSON
        return response()->json($remedios);
    }
    public function eliminarPorReceta($recetaId)
    {
        // Verificar si el valor es numérico
        if (!is_numeric($recetaId)) {
            return response()->json(['error' => 'Valor de receta id no válido'], 400);
        }

        // Eliminar los registros
        $deletedRows = Remedioreceta::where('receta_id', $recetaId)->delete();

        // Verificar si se eliminaron registros
        if ($deletedRows) {
            return response()->json(['message' => 'Registros eliminados correctamente', 'deleted' => $deletedRows], 200);
        } else {
            return response()->json(['message' => 'No se encontraron registros para eliminar'], 404);
        }
    }
}


