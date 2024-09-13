<?php

namespace App\Http\Controllers;


use App\Models\Medico;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class MedicoController extends Controller
{
    public function showAll()
    {
        $medicos = Medico::all();
        
        return response()->json($medicos);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $this->validate($request, [
            'matricula' => 'required|numeric|unique:medico',
        ]);

        // Crear el nuevo médico
        $medico = Medico::create([
            'matricula' => $request->matricula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'especialidad' => $request->especialidad,
            'prefijo' => $request->prefijo,
            'celular' => $request->celular,
            'email' => $request->email,
            'provincia' => $request->provincia,
            'localidad' => $request->localidad,
            'cp' => $request->cp,
            'calle' => $request->calle,
            'altura' => $request->altura
        ]);

        // Datos del nuevo médico para el historial
        $datosMedicoNew = [
            'matricula' => $medico->matricula,
            'nombre' => $medico->nombre,
            'apellido' => $medico->apellido,
            'especialidad' => $medico->especialidad,
            'prefijo' => $medico->prefijo,
            'celular' => $medico->celular,
            'email' => $medico->email,
            'provincia' => $medico->provincia,
            'localidad' => $medico->localidad,
            'cp' => $medico->cp,
            'calle' => $medico->calle,
            'altura' => $medico->altura,
        ];

        // Formatear los datos para el historial con campos en negrita
        $datosNuevos = '';

        foreach ($datosMedicoNew as $campo => $valor) {
            $datosNuevos .= ucfirst($campo) . ": {$valor}, ";
        }

        // Quitar la última coma y espacio
        $datosNuevos = rtrim($datosNuevos, ', ');

        // Guardar en el historial
        $historial = Historial::create([
            'fecha' => Carbon::now(),
            'accion' => 'Creación',
            'tipo' => 'Médico',
            'datos' => "Datos nuevos: <br>" . $datosNuevos,
        ]);

        return response()->json(['success' => true, 'message' => 'Médico creado exitosamente.']);
    }
public function busqueda(Request $request)
    {
        $busquedaMatricula = $request->input('busquedaMatricula');
        $busquedaNombre = $request->input('busquedaNombre');
        $busquedaApellido = $request->input('busquedaApellido');
        $busquedaEspecialidad = $request->input('busquedaEspecialidad');
        $busquedaLocalidad = $request->input('busquedaLocalidad');
        $limit = intval($request->input('limit', 100));
        // Construir la consulta
        $query = Medico::query();

        if ($busquedaMatricula) {
            $query->Where('matricula', 'LIKE', "%{$busquedaMatricula}%");
        }

        if ($busquedaNombre) {
            $query->Where('nombre', 'LIKE', "%{$busquedaNombre}%");
        }

        if ($busquedaApellido) {
            $query->Where('apellido', 'LIKE', "%{$busquedaApellido}%");
        }
        if ($busquedaEspecialidad) {
            $query->Where('especialidad', 'LIKE', "%{$busquedaEspecialidad}%");
        }
        if ($busquedaLocalidad) {
            $query->Where('localidad', 'LIKE', "%{$busquedaLocalidad}%");
        }

        // Ejecutar la consulta y obtener los resultados
        $medicos = $query->limit($limit)->get();

        // Devolver los resultados en formato JSON
        return response()->json($medicos);
    }
public function busquedapaginada(Request $request)
{
    $busquedaMatricula = $request->input('busquedaMatricula');
    $busquedaNombre = $request->input('busquedaNombre');
    $busquedaApellido = $request->input('busquedaApellido');
    $busquedaEspecialidad = $request->input('busquedaEspecialidad');
    $busquedaLocalidad = $request->input('busquedaLocalidad');
    $limit = intval($request->input('limit', 25)); // Ajusta el límite de resultados por página
    $page = intval($request->input('page', 1)); // Obtén el número de página

    // Construir la consulta
    $query = Medico::query();

    if ($busquedaMatricula) {
        $query->where('matricula', 'LIKE', "%{$busquedaMatricula}%");
    }

    if ($busquedaNombre) {
        $query->where('nombre', 'LIKE', "%{$busquedaNombre}%");
    }

    if ($busquedaApellido) {
        $query->where('apellido', 'LIKE', "%{$busquedaApellido}%");
    }
    if ($busquedaEspecialidad) {
        $query->where('especialidad', 'LIKE', "%{$busquedaEspecialidad}%");
    }
    if ($busquedaLocalidad) {
        $query->where('localidad', 'LIKE', "%{$busquedaLocalidad}%");
    }

    // Ejecutar la consulta con paginación
    $medicos = $query->paginate($limit, ['*'], 'page', $page);

    // Devolver los resultados en formato JSON
    return response()->json($medicos);
}
public function update($id, Request $request)
{
    // Reglas de validación
    $rules = [
        'matricula' => 'required|unique:medico,matricula,' . $id,
    ];

    // Mensajes de error personalizados
    $messages = [
        'matricula.unique' => 'La matrícula ya está en uso por otro médico.',
    ];

    // Validar la solicitud
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Buscar el médico y guardar los datos actuales antes de actualizar
    $medico = Medico::findOrFail($id);

    $datosMedicoOld = [
        'matricula' => $medico->matricula,
        'nombre' => $medico->nombre,
        'apellido' => $medico->apellido,
        'especialidad' => $medico->especialidad,
        'prefijo' => $medico->prefijo,
        'celular' => $medico->celular,
        'localidad' => $medico->localidad,
        'calle' => $medico->calle,
        'altura' => $medico->altura,
        'email' => $medico->email,           // Añadido email
        'provincia' => $medico->provincia,   // Añadido provincia
        'cp' => $medico->cp,                 // Añadido cp
    ];

    // Actualizar el médico con los datos nuevos
    $medico->matricula = $request->input('matricula', $medico->matricula);
    $medico->nombre = $request->input('nombre', $medico->nombre);
    $medico->apellido = $request->input('apellido', $medico->apellido);
    $medico->especialidad = $request->input('especialidad', $medico->especialidad);
    $medico->prefijo = $request->input('prefijo', $medico->prefijo);
    $medico->celular = $request->input('celular', $medico->celular);
    $medico->localidad = $request->input('localidad', $medico->localidad);
    $medico->calle = $request->input('calle', $medico->calle);
    $medico->altura = $request->input('altura', $medico->altura);
    $medico->email = $request->input('email', $medico->email);          // Añadido email
    $medico->provincia = $request->input('provincia', $medico->provincia);  // Añadido provincia
    $medico->cp = $request->input('cp', $medico->cp);                      // Añadido cp

    // Guarda los cambios
    $medico->save();

    // Cargar los datos actualizados del médico en $datosMedicoNew
    $datosMedicoNew = [
        'matricula' => $medico->matricula,
        'nombre' => $medico->nombre,
        'apellido' => $medico->apellido,
        'especialidad' => $medico->especialidad,
        'prefijo' => $medico->prefijo,
        'celular' => $medico->celular,
        'localidad' => $medico->localidad,
        'calle' => $medico->calle,
        'altura' => $medico->altura,
        'email' => $medico->email,           // Añadido email
        'provincia' => $medico->provincia,   // Añadido provincia
        'cp' => $medico->cp,                 // Añadido cp
    ];

    // Construir el string de datos con campos modificados en negrita
    $datosViejos = '';
    $datosNuevos = '';

    foreach ($datosMedicoOld as $campo => $valorOld) {
        $valorNew = $datosMedicoNew[$campo];

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
        'tipo' => 'Médico',
        'datos' => "Datos viejos: <br>" . $datosViejos . "<br><br>" .
                   "Datos nuevos: <br>" . $datosNuevos,
    ]);

    return response()->json(['success' => true, 'message' => 'Médico actualizado exitosamente.']);
}

    public function show($id)
    {
        $medico = Medico::find($id);
        
        if (!$medico) {
            return response()->json(['mensaje' => 'Medico no encontrado'], 404);
        }
        return response()->json($medico);
        
    }


    public function destroy($id)
    {
       try {
        $medico = Medico::findOrFail($id);
        
        $datosMedico =   "Matricula: " . $medico->matricula . ", " .
                         "Nombre: " . $medico->nombre . ", " .
                         "Apellido: " . $medico->apellido;
        
        $medico->delete();
        
        // Guarda la entrada en el historial
        $historial = Historial::create([
            'fecha' => Carbon::now(),
            'accion' => 'Eliminación',
            'tipo' => 'Medico',
            'datos' => $datosMedico,
        ]);
        
        return response()->json(['message' => 'Medico eliminado exitosamente', 'historial' => $historial], 200);
    } catch (\Illuminate\Database\QueryException $e) {
        \Log::error('Error al eliminar el Medico: ' . $e->getMessage());
        
        if ($e->getCode() == '23000') {
            // Código de error para clave externa
            return response()->json(['error' => 'No se puede eliminar el medico porque está asociado a una receta'], 400);
        }
        
        // Maneja otros tipos de excepciones
        return response()->json(['error' => 'Error al eliminar el medico'], 500);
    } catch (\Exception $e) {
        \Log::error('Error inesperado: ' . $e->getMessage());
        return response()->json(['error' => 'Error inesperado'], 500);
    }
    }

}