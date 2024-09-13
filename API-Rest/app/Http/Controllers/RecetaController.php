<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Remedio;
use App\Models\Medico;
use App\Models\Receta;
use App\Models\RemedioReceta;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class RecetaController extends Controller
{
    public function showAll()
    {
        $recetas = Receta::all();
        
        return response()->json($recetas);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'fechaEmision' => 'required',
            'Paciente_id' => 'required',
            'Medico_id' => 'required'
        ]);
        
        $receta = new Receta();
        $receta->nroReceta = $request->input('nroReceta');
        $receta->fechaEmision = $request->input('fechaEmision');
        $receta->Paciente_id = $request->input('Paciente_id');
        $receta->nroafiliado = $request->input('nroafiliado');
        $receta->obrasocial = $request->input('obrasocial');
        $receta->Medico_id = $request->input('Medico_id');
        $receta->save();

        // Devolver el ID de la receta creada
        return response()->json(['id' => $receta->id], 201);
    }

    public function update($id, Request $request)
    {
        // Buscar la receta por su ID
        $receta = Receta::findOrFail($id);

        // Obtener el valor de nroReceta desde el request
        $nroReceta = $request->input('nroReceta');
        $nroafiliado = $request->input('nroafiliado');
        $obrasocial = $request->input('obrasocial');

        // Si el valor de nroReceta está vacío, asigna 0
        if (empty($nroReceta)) {
            $nroReceta = 0;
        } else {
            // Asegúrate de que sea un string válido
            $nroReceta = strval($nroReceta);
        }
        if (empty($nroafiliado)) {
            $nroafiliado = null;
        }
        if (empty($obrasocial)) {
            $obrasocial = "";
        } else {
            // Asegúrate de que sea un string válido
            $obrasocial = strval($obrasocial);
        }
        

        // Actualizar los campos de la receta
        $receta->nroReceta = $nroReceta;
        $receta->fechaEmision = $request->input('fechaEmision');
        $receta->Paciente_id = $request->input('Paciente_id_hidden');
        $receta->nroafiliado = $nroafiliado;
        $receta->obrasocial = $obrasocial;
        $receta->Medico_id = $request->input('Medico_id_hidden');
        // Agrega más campos según sea necesario

        // Guarda los cambios
        $receta->save();

        return response()->json(['success' => true, 'message' => 'Receta actualizada con éxito.']);
    }

    public function destroy($id)
    {
        $receta = Receta::find($id);

        if (!$receta) {
            return response()->json(['mensaje' => 'receta no encontrada'], 404);
        }

        $receta = Receta::where('id', $id)->delete();

        return response()->json(['mensaje' => 'receta eliminada con éxito'], 200);
    }
    // public function checkRecetaExists($nroReceta, $excludeId)
    // {
    //     $exists = Receta::where('nroReceta', $nroReceta)
    //                     ->where('id', '!=', $excludeId)
    //                     ->exists();

    //     return response()->json(['exists' => $exists]);
    // }

public function busqueda(Request $request)
{
    $nroReceta = $request->input('nroReceta');
    $fechaEmision = $request->input('fechaEmision');
    $paciente_id = $request->input('paciente_id');
    $nroafiliado = $request->input('nroafiliado');
    $obrasocial = $request->input('obrasocial');
    $medico_id = $request->input('medico_id');
    $receta_id = $request->input('receta_id'); // Nuevo campo para buscar por receta.id

    // Construir la consulta base
    $query = DB::table('receta')
        ->leftJoin('paciente', 'receta.Paciente_id', '=', 'paciente.id')
        ->leftJoin('medico', 'receta.Medico_id', '=', 'medico.id')
        ->leftJoin('remedioreceta', 'receta.id', '=', 'remedioreceta.receta_id')
        ->leftJoin('remedio', 'remedioreceta.remedio_id', '=', 'remedio.id')
        ->select(
            'receta.*',
            'paciente.id as paciente_id',
            'paciente.dni as paciente_dni',
            'paciente.nombre as paciente_nombre',
            'paciente.apellido as paciente_apellido',
            'receta.nroafiliado',
            'receta.obrasocial',
            'medico.id as medico_id',
            'medico.matricula as medico_matricula',
            'medico.nombre as medico_nombre',
            'medico.apellido as medico_apellido',
            'remedio.medicamento',
            'remedio.prestacion',
            'remedio.codigo'
        );

    // Aplicar filtros si existen
    if ($nroReceta) {
        $query->where('receta.nroReceta', 'LIKE', "%{$nroReceta}%");
    }

    if ($fechaEmision) {
        $query->where('receta.fechaEmision', 'LIKE', "%{$fechaEmision}%");
    }

    if ($paciente_id) {
        $query->where('paciente.dni', 'LIKE', "%{$paciente_id}%");
    }

    if ($nroafiliado) {
        $query->where('receta.nroafiliado', 'LIKE', "%{$nroafiliado}%");
    }

    if ($obrasocial) {
        $query->where('receta.obrasocial', 'LIKE', "%{$obrasocial}%");
    }

    if ($medico_id) {
        $query->where('medico.matricula', 'LIKE', "%{$medico_id}%");
    }

    if ($receta_id) {
        $query->where('receta.id', '=', $receta_id); // Filtrar por receta.id
    }

    // Obtener los resultados de la consulta
    $recetas = $query->get();

    // Log de depuración
    Log::info('Consulta ejecutada:', ['query' => $query->toSql(), 'bindings' => $query->getBindings()]);
    Log::info('Resultados obtenidos:', ['recetas' => $recetas]);

    // Formatear los resultados
    $recetasAgrupadas = [];
    foreach ($recetas as $receta) {
        if (!isset($recetasAgrupadas[$receta->id])) {
            $recetasAgrupadas[$receta->id] = [
                'id' => $receta->id,
                'nroReceta' => $receta->nroReceta,
                'fechaEmision' => $receta->fechaEmision,
                'paciente' => [
                    'id' => $receta->paciente_id,
                    'dni' => $receta->paciente_dni,
                    'nombre' => $receta->paciente_nombre,
                    'apellido' => $receta->paciente_apellido,
                ],
                'nroafiliado' => $receta->nroafiliado,
                'obrasocial' => $receta->obrasocial,
                'medico' => [
                    'id' => $receta->medico_id,
                    'matricula' => $receta->medico_matricula,
                    'nombre' => $receta->medico_nombre,
                    'apellido' => $receta->medico_apellido,
                ],
                'remedios' => [],
                'created_at' => $receta->created_at,
            ];
        }

        // Agregar remedios a la receta correspondiente
        if ($receta->medicamento || $receta->prestacion || $receta->codigo) {
            $recetasAgrupadas[$receta->id]['remedios'][] = [
                'medicamento' => $receta->medicamento,
                'prestacion' => $receta->prestacion,
                'codigo' => $receta->codigo,
            ];
        }
    }

    // Convertir a array para la respuesta JSON
    $recetasAgrupadas = array_values($recetasAgrupadas);

    return response()->json($recetasAgrupadas);
}

public function busquedapaginada(Request $request)
{
    // Obtener los parámetros de la solicitud
    $nroReceta = $request->input('nroReceta');
    $fechaEmision = $request->input('fechaEmision');
    $fechaInicio = $request->input('fechaInicio'); // Nuevo campo para rango de fechas
    $fechaFin = $request->input('fechaFin'); // Nuevo campo para rango de fechas
    $paciente_id = $request->input('paciente_id');
    $nroafiliado = $request->input('nroafiliado');
    $obrasocial = $request->input('obrasocial');
    $medico_id = $request->input('medico_id');
    $receta_id = $request->input('receta_id');
    $limit = intval($request->input('limit', 15)); // Número de resultados por página

    // Consulta base para obtener recetas
    $query = DB::table('receta')
        ->leftJoin('paciente', 'receta.Paciente_id', '=', 'paciente.id')
        ->leftJoin('medico', 'receta.Medico_id', '=', 'medico.id')
        ->select(
            'receta.id',
            'receta.nroReceta',
            'receta.fechaEmision',
            'receta.nroafiliado',
            'receta.obrasocial',
            'receta.created_at',
            'paciente.id as paciente_id',
            'paciente.dni as paciente_dni',
            'paciente.nombre as paciente_nombre',
            'paciente.apellido as paciente_apellido',
            'medico.id as medico_id',
            'medico.matricula as medico_matricula',
            'medico.nombre as medico_nombre',
            'medico.apellido as medico_apellido'
        )
        ->when($nroReceta, function ($query, $nroReceta) {
            return $query->where('receta.nroReceta', 'LIKE', "%{$nroReceta}%");
        })
        ->when($fechaEmision, function ($query, $fechaEmision) {
            return $query->whereDate('receta.fechaEmision', '=', $fechaEmision);
        })
        ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
            return $query->whereBetween('receta.fechaEmision', [$fechaInicio, $fechaFin]);
        })
        ->when($paciente_id, function ($query, $paciente_id) {
            return $query->where('paciente.dni', 'LIKE', "%{$paciente_id}%");
        })
        ->when($nroafiliado, function ($query, $nroafiliado) {
            return $query->where('receta.nroafiliado', 'LIKE', "%{$nroafiliado}%");
        })
        ->when($obrasocial, function ($query, $obrasocial) {
            return $query->where('receta.obrasocial', 'LIKE', "%{$obrasocial}%");
        })
        ->when($medico_id, function ($query, $medico_id) {
            return $query->where('medico.matricula', 'LIKE', "%{$medico_id}%");
        })
        ->when($receta_id, function ($query, $receta_id) {
            return $query->where('receta.id', '=', $receta_id);
        })
        ->distinct()
        ->paginate($limit);

    // Obtener las recetas de la página actual
    $recetas = $query->items();
    $recetaIds = array_column($recetas, 'id');

    // Obtener medicamentos para las recetas de la página actual
    $medicamentos = DB::table('remedioreceta')
        ->leftJoin('remedio', 'remedioreceta.remedio_id', '=', 'remedio.id')
        ->whereIn('remedioreceta.receta_id', $recetaIds)
        ->select(
            'remedioreceta.receta_id',
            'remedio.medicamento',
            'remedio.prestacion',
            'remedio.codigo'
        )
        ->get()
        ->groupBy('receta_id');

    // Agrupar medicamentos por receta
    $recetasAgrupadas = array_map(function ($receta) use ($medicamentos) {
        return [
            'id' => $receta->id,
            'nroReceta' => $receta->nroReceta,
            'fechaEmision' => $receta->fechaEmision,
            'paciente' => [
                'id' => $receta->paciente_id,
                'dni' => $receta->paciente_dni,
                'nombre' => $receta->paciente_nombre,
                'apellido' => $receta->paciente_apellido,
            ],
            'nroafiliado' => $receta->nroafiliado,
            'obrasocial' => $receta->obrasocial,
            'medico' => [
                'id' => $receta->medico_id,
                'matricula' => $receta->medico_matricula,
                'nombre' => $receta->medico_nombre,
                'apellido' => $receta->medico_apellido,
            ],
            'remedios' => isset($medicamentos[$receta->id]) ? $medicamentos[$receta->id]->map(function ($item) {
                return [
                    'medicamento' => $item->medicamento,
                    'prestacion' => $item->prestacion,
                    'codigo' => $item->codigo,
                ];
            })->toArray() : [],
            'created_at' => $receta->created_at,
        ];
    }, $recetas);

    // Devolver los resultados paginados y formateados en JSON
    return response()->json([
        'data' => $recetasAgrupadas,
        'current_page' => $query->currentPage(),
        'last_page' => $query->lastPage(),
        'per_page' => $query->perPage(),
        'total' => $query->total(),
    ]);
}



    public function show($id)
    {
        $receta = Receta::find($id);
        
        if (!$receta) {
            return response()->json(['mensaje' => 'Receta no encontrada'], 404);
        }
        return response()->json($receta);
        
    }

    public function busqueda2(Request $request)
    {
      $recetaId = $request->input('id');  // Busca por el id de la receta

      // Construir la consulta base
      $query = DB::table('receta')
          ->leftJoin('paciente', 'receta.Paciente_id', '=', 'paciente.id')
          ->leftJoin('medico', 'receta.Medico_id', '=', 'medico.id')
          ->leftJoin('remedioreceta', 'receta.id', '=', 'remedioreceta.receta_id')
          ->leftJoin('remedio', 'remedioreceta.remedio_id', '=', 'remedio.id')
          ->select(
              'receta.nroReceta',
              'paciente.dni',
              'paciente.nombre as nombrePaciente',
              'paciente.apellido as apellidoPaciente',
              'receta.nroafiliado',
              'receta.obrasocial',
              'medico.matricula',
              'medico.nombre as nombreMedico',
              'medico.apellido as apellidoMedico',
              'remedio.medicamento',
              'remedio.prestacion',
              'remedio.codigo'
          )
          ->where('receta.id', $recetaId)
          ->get();

      // Formatear los resultados
      $recetasAgrupadas = [
          'Nro de receta' => null,
          'DNI' => null,
          'Paciente' => null,
          'Matricula' => null,
          'Nro de afiliado' => null,
          'Obra social' => null,
          'Medico' => null,
          'Remedios' => [],
      ];

      foreach ($query as $receta) {
          // Verificar si ya hemos asignado los datos de la receta
          if (is_null($recetasAgrupadas['Nro de receta'])) {
              $recetasAgrupadas['Nro de receta'] = $receta->nroReceta;
              $recetasAgrupadas['DNI'] = $receta->dni;
              $recetasAgrupadas['Paciente'] = ['nombre' => $receta->nombrePaciente,
                                               'apellido' => $receta->apellidoPaciente 
                                              ];
              $recetasAgrupadas['Nro de afiliado'] = $receta->nroafiliado;
              $recetasAgrupadas['Obra social'] = $receta->obrasocial;
              $recetasAgrupadas['Matricula'] = $receta->matricula;
              $recetasAgrupadas['Medico'] = ['nombre' => $receta->nombreMedico,
                                             'apellido' => $receta->apellidoMedico 
                                            ];
          }

          // Agregar remedios a la receta correspondiente
          if ($receta->medicamento || $receta->prestacion || $receta->codigo) {
              $recetasAgrupadas['Remedios'][] = [
                  'medicamento' => $receta->medicamento,
                  'prestacion' => $receta->prestacion,
                  'codigo' => $receta->codigo,
              ];
          }
      }

      return response()->json($recetasAgrupadas);
    }

    public function FechaMin() 
    {
    $fechaMinima = DB::table('receta')->min('fechaEmision'); // Suponiendo que 'fecha_emision' es la columna de fecha
    return response()->json(['fechaMinima' => $fechaMinima]);
    }

}
