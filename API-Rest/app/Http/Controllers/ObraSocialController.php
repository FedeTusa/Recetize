<?php

namespace App\Http\Controllers;


use App\Models\ObraSocial;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Carbon\Carbon;


class ObraSocialController extends Controller
{
    public function busqueda(Request $request)
    {
        $busquedaObrasocial = $request->input('busquedaObrasocial');

        // Construir la consulta
        $query = ObraSocial::query();

        if ($busquedaObrasocial) {
            $query->Where('obrasocial', 'LIKE', "%{$busquedaObrasocial}%");
        }


        // Ejecutar la consulta y obtener los resultados
        $obrasocial = $query->get();

        // Devolver los resultados en formato JSON
        return response()->json($obrasocial);
    }

}