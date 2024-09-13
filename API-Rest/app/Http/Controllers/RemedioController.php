<?php

namespace App\Http\Controllers;


use App\Models\Remedio;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class RemedioController extends Controller
{
    public function showAll()
    {
        $remedios = Remedio::all();
        
        return response()->json($remedios);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|numeric|unique:remedio',
            'droga' => 'required|string|max:100',
            'medicamento' => 'nullable|string|max:100'
        ]);
        
        $remedio = Remedio::create([
            'codigo' => $request->codigo,
            'droga' => $request->droga,
            'medicamento' => $request->medicamento,
            'prestacion' => $request->prestacion,
            'farmacodinamia' => $request->farmacodinamia

        ]);
        
        return response()->json($remedio, 201);
    }

    public function busqueda(Request $request)
    {
        $busquedaCodigo = $request->input('busquedaCodigo');
        $busquedaDroga = $request->input('busquedaDroga');
        $busquedaMedicamento = $request->input('busquedaMedicamento');
        $busquedaFarmacodinamia = $request->input('busquedaFarmacodinamia');
        $limit = intval($request->input('limit', 100));

        // Construir la consulta
        $query = Remedio::query();

        if ($busquedaCodigo) {
            $query->Where('codigo', 'LIKE', "%{$busquedaCodigo}%");
        }

        if ($busquedaDroga) {
            $query->Where('droga', 'LIKE', "%{$busquedaDroga}%");
        }

        if ($busquedaMedicamento) {
            $query->Where('medicamento', 'LIKE', "%{$busquedaMedicamento}%");
        }

        if ($busquedaFarmacodinamia) {
            $query->Where('farmacodinamia', 'LIKE', "%{$busquedaFarmacodinamia}%");
        }
        $Remedio = $query->limit($limit)->get();

    return response()->json($Remedio);
    }

    public function busquedapaginada(Request $request)
    {
        $busquedaCodigo = $request->input('busquedaCodigo');
        $busquedaDroga = $request->input('busquedaDroga');
        $busquedaMedicamento = $request->input('busquedaMedicamento');
        $busquedaFarmacodinamia = $request->input('busquedaFarmacodinamia');
        $limit = intval($request->input('limit', 25)); // Ajusta el límite de resultados por página
        $page = intval($request->input('page', 1)); // Obtén el número de página

        // Construir la consulta
        $query = Remedio::query();

        if ($busquedaCodigo) {
            $query->Where('codigo', 'LIKE', "%{$busquedaCodigo}%");
        }

        if ($busquedaDroga) {
            $query->Where('droga', 'LIKE', "%{$busquedaDroga}%");
        }

        if ($busquedaMedicamento) {
            $query->Where('medicamento', 'LIKE', "%{$busquedaMedicamento}%");
        }

        if ($busquedaFarmacodinamia) {
            $query->Where('farmacodinamia', 'LIKE', "%{$busquedaFarmacodinamia}%");
        }
        $Remedio = $query->paginate($limit, ['*'], 'page', $page);

    return response()->json($Remedio);
    }

    public function busquedaedit(Request $request)
    {
        $busquedaCodigo = $request->input('busquedaCodigo');

        // Construir la consulta
        $query = Remedio::query();

        if ($busquedaCodigo) {
            $query->Where('codigo', '=', $busquedaCodigo);
        }


        $Remedio = $query->get();

    return response()->json($Remedio);
    }
    
    public function buscarMedicamento(Request $request)
        {
            $query = $request->input('query');
            $medicamentos = Remedio::where('medicamento', 'LIKE', "%{$query}%")
                ->distinct()
                ->take(6)
                ->get(['medicamento']);
            
            return response()->json($medicamentos);
        }

        // Método para buscar prestaciones basadas en el medicamento seleccionado
        public function buscarPrestaciones(Request $request)
        {
            $medicamento = $request->input('medicamento');
            $prestaciones = Remedio::where('medicamento', $medicamento)->get(['prestacion', 'codigo', 'id']);
            return response()->json($prestaciones);
        }

      
public function update(Request $request, $id)
{
    // Reglas de validación
    $rules = [
        'codigo' => 'required|digits_between:1,13|unique:remedio,codigo,' . $id,
    ];

    // Mensajes de error personalizados
    $messages = [
        'codigo.unique' => 'El código ya está en uso en otro remedio.',
        'codigo.digits_between' => 'El código debe tener entre 1 y 13 dígitos.',
    ];

    // Validar la solicitud
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Buscar el remedio y guardar los datos actuales antes de actualizar
    $remedio = Remedio::findOrFail($id);

    $datosRemedioOld = [
        'codigo' => $remedio->codigo,
        'droga' => $remedio->droga,
        'medicamento' => $remedio->medicamento,
        'prestacion' => $remedio->prestacion,
        'farmacodinamia' => $remedio->farmacodinamia,
    ];

    // Actualizar el remedio con los datos nuevos
    $remedio->codigo = $request->input('codigo', $remedio->codigo);
    $remedio->droga = $request->input('droga', $remedio->droga);
    $remedio->medicamento = $request->input('medicamento', $remedio->medicamento);
    $remedio->prestacion = $request->input('prestacion', $remedio->prestacion);
    $remedio->farmacodinamia = $request->input('farmacodinamia', $remedio->farmacodinamia);

    // Guarda los cambios
    $remedio->save();

    // Cargar los datos actualizados del remedio en $datosRemedioNew
    $datosRemedioNew = [
        'codigo' => $remedio->codigo,
        'droga' => $remedio->droga,
        'medicamento' => $remedio->medicamento,
        'prestacion' => $remedio->prestacion,
        'farmacodinamia' => $remedio->farmacodinamia,
    ];

    // Construir el string de datos con campos modificados en negrita
    $datosViejos = '';
    $datosNuevos = '';

    foreach ($datosRemedioOld as $campo => $valorOld) {
        $valorNew = $datosRemedioNew[$campo];

        // Convertir a cadenas para comparación y eliminar comas
        $valorOld = is_numeric($valorOld) ? str_replace(',', '', $valorOld) : trim($valorOld);
        $valorNew = is_numeric($valorNew) ? str_replace(',', '', $valorNew) : trim($valorNew);

        // Convertir a enteros para comparación
        $valorOld = is_numeric($valorOld) ? intval($valorOld) : $valorOld;
        $valorNew = is_numeric($valorNew) ? intval($valorNew) : $valorNew;

        // Formatear el campo en negrita con la primera letra en mayúscula
        $campoFormateado = ucfirst($campo); // La primera letra en mayúscula del nombre del campo

        if ($valorOld !== $valorNew) {
            $datosViejos .= ucfirst($campoFormateado) . ": {$valorOld}, ";
            $datosNuevos .= "<strong>" . ucfirst($campoFormateado) . ": {$valorNew}</strong>, ";
        } else {
            $datosViejos .= ucfirst($campoFormateado) . ": {$valorOld}, ";
            $datosNuevos .= ucfirst($campoFormateado) . ": {$valorNew}, ";
        }
    }

    // Quitar la última coma y espacio
    $datosViejos = rtrim($datosViejos, ', ');
    $datosNuevos = rtrim($datosNuevos, ', ');

    // Guardar en el historial
    $historial = Historial::create([
        'fecha' => Carbon::now(),
        'accion' => 'Modificación',
        'tipo' => 'Remedio',
        'datos' => "Datos viejos: <br>" . $datosViejos . "<br><br>" .
                   "Datos nuevos: <br>" . $datosNuevos,
    ]);

    return response()->json(['success' => true, 'message' => 'Remedio actualizado exitosamente.']);
}

    public function show($id)
    {
        $remedio = Remedio::find($id);
        
        if (!$remedio) {
            return response()->json(['mensaje' => 'remedio no encontrado'], 404);
        }
        return response()->json($remedio);
    }

    public function destroy($id)
    {

      try {
        // Encuentra el paciente
        $remedio = Remedio::findOrFail($id);
        
        // Crear el string con todos los datos del paciente
        $datosRemedio =  "Codigo: " . $remedio->codigo . ", " .
                         "Medicamento: " . $remedio->medicamento . ", " .
                         "Droga: " . $remedio->droga;
        
        // Elimina el paciente
        $remedio->delete();
        
        // Guarda la entrada en el historial
        $historial = Historial::create([
            'fecha' => Carbon::now(),
            'accion' => 'Eliminación',
            'tipo' => 'Remedio',
            'datos' => $datosRemedio,
        ]);
        
        return response()->json(['message' => 'Remedio eliminado exitosamente', 'historial' => $historial], 200);
    } catch (\Illuminate\Database\QueryException $e) {
        \Log::error('Error al eliminar el remedio: ' . $e->getMessage());
        
        if ($e->getCode() == '23000') {
            // Código de error para clave externa
            return response()->json(['error' => 'No se puede eliminar el remedio porque está asociado a una receta'], 400);
        }
        
        // Maneja otros tipos de excepciones
        return response()->json(['error' => 'Error al eliminar el remedio'], 500);
    } catch (\Exception $e) {
        \Log::error('Error inesperado: ' . $e->getMessage());
        return response()->json(['error' => 'Error inesperado'], 500);
    }
    }




}