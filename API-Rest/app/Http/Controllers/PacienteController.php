<?php

namespace App\Http\Controllers;


use App\Models\Paciente;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Carbon\Carbon;


class PacienteController extends Controller
{
  public function showAll()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);

    }
    
public function store(Request $request)
{
    // Validar la solicitud
    $this->validate($request, [
        'dni' => 'required|numeric|unique:paciente', 
        'nombre' => 'required|string|min:3|max:100',
        'apellido' => 'required|string|min:3|max:100',
        'localidad' => 'required|string|min:2|max:50',
    ]);

    // Crear el nuevo paciente
    $paciente = Paciente::create([
        'dni' => $request->dni,
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'obrasocial' => $request->obrasocial,
        'nroafiliado' => $request->nroafiliado,
        'prefijo' => $request->prefijo,
        'celular' => $request->celular,
        'email' => $request->email,
        'provincia' => $request->provincia,
        'localidad' => $request->localidad,
        'cp' => $request->cp,
        'calle' => $request->calle,
        'altura' => $request->altura
    ]);

    // Datos del nuevo paciente para el historial
    $datosPacienteNew = [
        'dni' => $paciente->dni,
        'nombre' => $paciente->nombre,
        'apellido' => $paciente->apellido,
        'obrasocial' => $paciente->obrasocial,
        'nroafiliado' => $paciente->nroafiliado,
        'prefijo' => $paciente->prefijo,
        'celular' => $paciente->celular,
        'email' => $paciente->email,
        'provincia' => $paciente->provincia,
        'localidad' => $paciente->localidad,
        'cp' => $paciente->cp,
        'calle' => $paciente->calle,
        'altura' => $paciente->altura,
    ];

    // Formatear los datos para el historial con campos en negrita
    $datosNuevos = '';

    foreach ($datosPacienteNew as $campo => $valor) {
        // Asegurarse de que 'dni' esté en mayúsculas
        if ($campo === 'dni') {
            $campo = strtoupper($campo);
        }
        
        $datosNuevos .= ucfirst($campo) . ": {$valor}, ";
    }

    // Quitar la última coma y espacio
    $datosNuevos = rtrim($datosNuevos, ', ');

    // Guardar en el historial
    $historial = Historial::create([
        'fecha' => Carbon::now(),
        'accion' => 'Creación',
        'tipo' => 'Paciente',
        'datos' => "Datos nuevos: <br>" . $datosNuevos,
    ]);

    return response()->json(['success' => true, 'message' => 'Paciente creado exitosamente.']);
}
    
public function busqueda(Request $request)
{
    $busquedaDNI = $request->input('busquedaDNI');
    $busquedaNombre = $request->input('busquedaNombre');
    $busquedaApellido = $request->input('busquedaApellido');
    $busquedaNroafiliado = $request->input('busquedaNroafiliado');
    $busquedaObrasocial = $request->input('busquedaObrasocial');
    $busquedaLocalidad = $request->input('busquedaLocalidad');
    // Construir la consulta
    $query = Paciente::query();

    if ($busquedaDNI) {
        $query->Where('dni', 'LIKE', "%{$busquedaDNI}%");
    }

    if ($busquedaNombre) {
        $query->Where('nombre', 'LIKE', "%{$busquedaNombre}%");
    }

    if ($busquedaApellido) {
        $query->Where('apellido', 'LIKE', "%{$busquedaApellido}%");
    }
    if ($busquedaNroafiliado) {
        $query->Where('nroafiliado', 'LIKE', "%{$busquedaNroafiliado}%");
    }
    if ($busquedaObrasocial) {
        $query->Where('obrasocial', 'LIKE', "%{$busquedaObrasocial}%");
    }
    if ($busquedaLocalidad) {
        $query->Where('localidad', 'LIKE', "%{$busquedaLocalidad}%");
    }

    // Ejecutar la consulta y obtener los resultados
    $pacientes = $query->get();

    // Devolver los resultados en formato JSON
    return response()->json($pacientes);
}
public function busquedapaginada(Request $request)
{
    $busquedaDNI = $request->input('busquedaDNI');
    $busquedaNombre = $request->input('busquedaNombre');
    $busquedaApellido = $request->input('busquedaApellido');
    $busquedaNroafiliado = $request->input('busquedaNroafiliado');
    $busquedaObrasocial = $request->input('busquedaObrasocial');
    $busquedaLocalidad = $request->input('busquedaLocalidad');
    $limit = intval($request->input('limit', 25)); // Ajusta el límite de resultados por página
    $page = intval($request->input('page', 1)); // Obtén el número de página

    // Construir la consulta
    $query = Paciente::query();

    if ($busquedaDNI) {
        $query->Where('dni', 'LIKE', "%{$busquedaDNI}%");
    }

    if ($busquedaNombre) {
        $query->Where('nombre', 'LIKE', "%{$busquedaNombre}%");
    }

    if ($busquedaApellido) {
        $query->Where('apellido', 'LIKE', "%{$busquedaApellido}%");
    }
    if ($busquedaNroafiliado) {
        $query->Where('nroafiliado', 'LIKE', "%{$busquedaNroafiliado}%");
    }
    if ($busquedaObrasocial) {
        $query->Where('obrasocial', 'LIKE', "%{$busquedaObrasocial}%");
    }
    if ($busquedaLocalidad) {
        $query->Where('localidad', 'LIKE', "%{$busquedaLocalidad}%");
    }

    // Ejecutar la consulta y obtener los resultados
    $pacientes = $query->paginate($limit, ['*'], 'page', $page);

    // Devolver los resultados en formato JSON
    return response()->json($pacientes);
}

public function buscarPaciente(Request $request)
    {
        $pacienteId = $request->input('id');
        $paciente = Paciente::find($pacienteId);

        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        return response()->json($paciente);
    }



public function update($id, Request $request)
{
    // Reglas de validación
    $rules = [
        'dni' => 'required|unique:paciente,dni,' . $id,
        'email' => 'nullable|email',
        'provincia' => 'nullable|string|max:255',
        'cp' => 'nullable|numeric',
        // Otras reglas de validación
    ];

    // Mensajes de error personalizados
    $messages = [
        'dni.unique' => 'El DNI ya está en uso por otro paciente.',
        // Otros mensajes de error personalizados
    ];

    // Validar la solicitud
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Buscar el paciente y guardar los datos actuales antes de actualizar
    $paciente = Paciente::findOrFail($id);

    $datosPacienteOld = [
        'dni' => $paciente->dni,
        'nombre' => $paciente->nombre,
        'apellido' => $paciente->apellido,
        'obrasocial' => $paciente->obrasocial,
        'nroafiliado' => $paciente->nroafiliado,
        'prefijo' => $paciente->prefijo,
        'celular' => $paciente->celular,
        'email' => $paciente->email,
        'provincia' => $paciente->provincia,
        'localidad' => $paciente->localidad,
        'cp' => $paciente->cp,
        'calle' => $paciente->calle,
        'altura' => $paciente->altura,
    ];

    // Actualizar el paciente con los datos nuevos
    $paciente->dni = $request->input('dni', $paciente->dni);
    $paciente->nombre = $request->input('nombre', $paciente->nombre);
    $paciente->apellido = $request->input('apellido', $paciente->apellido);
    $paciente->obrasocial = $request->input('obrasocial', $paciente->obrasocial);
    $paciente->nroafiliado = $request->input('nroafiliado', $paciente->nroafiliado);
    $paciente->prefijo = $request->input('prefijo', $paciente->prefijo);
    $paciente->celular = $request->input('celular', $paciente->celular);
    $paciente->email = $request->input('email', $paciente->email);
    $paciente->provincia = $request->input('provincia', $paciente->provincia);
    $paciente->localidad = $request->input('localidad', $paciente->localidad);
    $paciente->cp = $request->input('cp', $paciente->cp);
    $paciente->calle = $request->input('calle', $paciente->calle);
    $paciente->altura = $request->input('altura', $paciente->altura);

    // Guarda los cambios
    $paciente->save();

    // Cargar los datos actualizados del paciente en $datosPacienteNew
    $datosPacienteNew = [
        'dni' => $paciente->dni,
        'nombre' => $paciente->nombre,
        'apellido' => $paciente->apellido,
        'obrasocial' => $paciente->obrasocial,
        'nroafiliado' => $paciente->nroafiliado,
        'prefijo' => $paciente->prefijo,
        'celular' => $paciente->celular,
        'email' => $paciente->email,
        'provincia' => $paciente->provincia,
        'localidad' => $paciente->localidad,
        'cp' => $paciente->cp,
        'calle' => $paciente->calle,
        'altura' => $paciente->altura,
    ];

    // Construir el string de datos con campos modificados en negrita
    $datosViejos = '';
    $datosNuevos = '';

    foreach ($datosPacienteOld as $campo => $valorOld) {
        $valorNew = $datosPacienteNew[$campo];

        // Convertir a cadenas para comparación y eliminar comas
        $valorOld = is_numeric($valorOld) ? str_replace(',', '', $valorOld) : trim($valorOld);
        $valorNew = is_numeric($valorNew) ? str_replace(',', '', $valorNew) : trim($valorNew);

        // Convertir a enteros para comparación
        $valorOld = is_numeric($valorOld) ? intval($valorOld) : $valorOld;
        $valorNew = is_numeric($valorNew) ? intval($valorNew) : $valorNew;

        // Formatear el campo en negrita con la primera letra en mayúscula
        if ($campo === 'dni') {
            $campo = strtoupper($campo); // Asegurarse de que el nombre del campo 'dni' esté en mayúsculas
        }
        
        if ($valorOld !== $valorNew) {
            $datosViejos .= ucfirst($campo) . ": {$valorOld}, ";
            $datosNuevos .= "<strong>" . ucfirst($campo) . ": {$valorNew}</strong>, ";
        } else {
            $datosViejos .= ucfirst($campo) . ": {$valorOld}, ";
            $datosNuevos .= ucfirst($campo) . ": {$valorNew}, ";
        }
    }

    // Quitar la última coma y espacio
    $datosViejos = rtrim($datosViejos, ', ');
    $datosNuevos = rtrim($datosNuevos, ', ');

    // Guardar en el historial
    $historial = Historial::create([
        'fecha' => Carbon::now(),
        'accion' => 'Modificación',
        'tipo' => 'Paciente',
        'datos' => "Datos viejos: <br>" . $datosViejos . "<br><br>" .
                   "Datos nuevos: <br>" . $datosNuevos,
    ]);

    return response()->json(['success' => true, 'message' => 'Paciente actualizado exitosamente.']);
}
        
    public function show($id)
    {
        $paciente = Paciente::find($id);
        
        if (!$paciente) {
            return response()->json(['mensaje' => 'paciente no encontrado'], 404);
        }
        return response()->json($paciente);
        
    }


    public function destroy($id)
{
    try {
        // Encuentra el paciente
        $paciente = Paciente::findOrFail($id);
        
        // Crear el string con todos los datos del paciente
        $datosPaciente = "DNI: " . $paciente->dni . ", " .
                         "Nombre: " . $paciente->nombre . ", " .
                         "Apellido: " . $paciente->apellido . ", " .
                         "Obra Social: " . $paciente->obrasocial . ", " .
                         "Número de Afiliado: " . $paciente->nroafiliado;
        
        // Elimina el paciente
        $paciente->delete();
        
        // Guarda la entrada en el historial
        $historial = Historial::create([
            'fecha' => Carbon::now(),
            'accion' => 'Eliminación',
            'tipo' => 'Paciente',
            'datos' => $datosPaciente,
        ]);
        
        return response()->json(['message' => 'Paciente eliminado exitosamente', 'historial' => $historial], 200);
    } catch (\Illuminate\Database\QueryException $e) {
        \Log::error('Error al eliminar el paciente: ' . $e->getMessage());
        
        if ($e->getCode() == '23000') {
            // Código de error para clave externa
            return response()->json(['error' => 'No se puede eliminar el paciente porque está asociado a una receta'], 400);
        }
        
        // Maneja otros tipos de excepciones
        return response()->json(['error' => 'Error al eliminar el paciente'], 500);
    } catch (\Exception $e) {
        \Log::error('Error inesperado: ' . $e->getMessage());
        return response()->json(['error' => 'Error inesperado'], 500);
    }
}

}