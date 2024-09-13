<?php

namespace App\Http\Controllers;


use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    public function showAll()
    {
        $historial = Historial::all();
        
        return response()->json($historial);
    }
    public function CreateDelete(Request $request)
    {
        $datosPaciente = $request->input('datosPaciente');
        $historial = Historial::create([
            'fecha' => Carbon::now(),
            'accion' => 'Eliminación',
            'tipo' => 'Receta',
            'datos' => $datosPaciente,
        ]);
        return response()->json($historial, 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'accion' => 'required|string',
            'tipo' => 'required|string',
            'datos' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Formatea la fecha a un formato que MySQL acepta
        $validatedData = $validator->validated();
        $validatedData['fecha'] = Carbon::parse($validatedData['fecha'])->format('Y-m-d H:i:s');

        $historial = Historial::create($validatedData);

        return response()->json(['status' => 'success', 'message' => 'Historial guardado exitosamente.'], 200);
    }

    public function busqueda(Request $request)
    {
        // Obtener los parámetros de búsqueda
        $busquedaFechaInicio = $request->input('busquedaFechaInicio');
        $busquedaFechaFin = $request->input('busquedaFechaFin');
        $busquedaAccion = $request->input('busquedaAccion');
        $busquedaTipo = $request->input('busquedaTipo');
        $busquedaDatos = $request->input('busquedaDatos');
        $limit = intval($request->input('limit', 100)); // Número máximo de resultados por página

        // Construir la consulta
        $query = Historial::query();

        // Aplicar filtros si existen
        if ($busquedaFechaInicio && $busquedaFechaFin) {
            $query->whereBetween('fecha', [$busquedaFechaInicio, $busquedaFechaFin]);
        }

        if ($busquedaAccion) {
            $query->where('accion', 'LIKE', "%{$busquedaAccion}%");
        }

        if ($busquedaTipo) {
            $query->where('tipo', 'LIKE', "%{$busquedaTipo}%");
        }

        if ($busquedaDatos) {
            $query->where('datos', 'LIKE', "%{$busquedaDatos}%");
        }

        // Ejecutar la consulta y obtener los resultados
        $historiales = $query->limit($limit)->get();

        // Devolver los resultados en formato JSON
        return response()->json($historiales);
    }

public function busquedapaginada(Request $request)
{
    // Obtener los parámetros de búsqueda
    $busquedaFechaInicio = $request->input('busquedaFechaInicio');
    $busquedaFechaFin = $request->input('busquedaFechaFin');
    $busquedaAccion = $request->input('busquedaAccion');
    $busquedaTipo = $request->input('busquedaTipo');
    $busquedaDatos = $request->input('busquedaDatos');
    $limit = intval($request->input('limit', 15)); // Número máximo de resultados por página (valor predeterminado: 15)
    $page = intval($request->input('page', 1)); // Número de página actual (valor predeterminado: 1)

    // Construir la consulta
    $query = Historial::query();

    // Aplicar filtros si existen
    if ($busquedaFechaInicio && $busquedaFechaFin) {
        $query->whereBetween('fecha', [$busquedaFechaInicio, $busquedaFechaFin]);
    }

    if ($busquedaAccion) {
        $query->where('accion', 'LIKE', "%{$busquedaAccion}%");
    }

    if ($busquedaTipo) {
        $query->where('tipo', 'LIKE', "%{$busquedaTipo}%");
    }

    if ($busquedaDatos) {
        $query->where('datos', 'LIKE', "%{$busquedaDatos}%");
    }

    // Ordenar por fecha descendente
    $query->orderBy('fecha', 'desc');

    // Ejecutar la consulta con paginación
    $historiales = $query->paginate($limit, ['*'], 'page', $page);

    // Devolver los resultados paginados en formato JSON
    return response()->json([
        'data' => $historiales->items(),
        'current_page' => $historiales->currentPage(),
        'last_page' => $historiales->lastPage(),
        'per_page' => $historiales->perPage(),
        'total' => $historiales->total(),
    ]);
}
    public function FechaMin() 
    {
    $fechaMinima = DB::table('historial')->min('fecha'); // Suponiendo que 'fecha_emision' es la columna de fecha
    return response()->json(['fechaMinima' => $fechaMinima]);
    }

}