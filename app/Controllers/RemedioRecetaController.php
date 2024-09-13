<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RemedioRecetaModel;
use App\Models\RecetaModel;
use App\Models\PacienteModel;
use App\Models\MedicoModel;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;



class RemedioRecetaController extends BaseController
{
    protected $format    = 'json';

public function create()
{
    // Reglas de validación para el ID del paciente y del médico
    $rules = [
        'Paciente_id_hidden' => 'required',
        'Medico_id_hidden' => 'required'
    ];

    if (!$this->validate($rules)) {
        return redirect()->to('index.php/pagprincipal/receta/nuevo')
                         ->withInput()
                         ->with('message2', 'El DNI de paciente o el DNI de médico no se encuentran en la base de datos.');
    }

    // Reglas de validación para el array de remedios
    $rules2 = [
        'array_remedio_id' => 'required',
    ];

    if (!$this->validate($rules2)) {
        return redirect()->to('index.php/pagprincipal/receta/nuevo')
                         ->withInput()
                         ->with('message3', 'Falta cargar remedios');
    }

    // Obtener los datos del formulario
    $nroReceta = strval($this->request->getPost('nroReceta'));
    $fechaEmision = $this->request->getPost('fechaEmision');
    $Paciente_id_hidden = intval($this->request->getPost('Paciente_id_hidden'));
    $nroafiliado = $this->request->getPost('nroafiliado');
    $obrasocial = $this->request->getPost('obrasocial');
    $Medico_id_hidden = intval($this->request->getPost('Medico_id_hidden'));

    // Crear una nueva instancia del modelo Receta
    $receta = new RecetaModel();

    // Guardar los datos de la receta
    $response1 = $receta->crearReceta([
        'nroReceta' => $nroReceta,
        'fechaEmision' => $fechaEmision,
        'Paciente_id' => $Paciente_id_hidden,
        'nroafiliado' => $nroafiliado,
        'obrasocial' => $obrasocial,
        'Medico_id' => $Medico_id_hidden,
    ]);
    $responseData1 = json_decode($response1, true);

    if (!$responseData1 || !isset($responseData1['id'])) {
        return view('/index.php/pagprincipal/paciente/error');
    }

    // Obtener el ID de la receta recién creada
    $receta_id = $responseData1['id'];


    // Obtener el array de remedios del formulario
    $array_remedio_id = $this->request->getPost('array_remedio_id');

    // Verificar si hay datos necesarios
    if (empty($receta_id) || empty($array_remedio_id)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Datos incompletos'])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
    }

    // Decodificar el JSON del array de remedios
    $remedios = json_decode($array_remedio_id, true);

    // Crear una nueva instancia del modelo RemedioReceta
    $remedioreceta = new RemedioRecetaModel();

    // Iterar sobre el array de remedios y guardar cada remedio-receta
    foreach ($remedios as $remedio_id) {
        $remedio_id = intval($remedio_id);

        $response = $remedioreceta->crearRemedioReceta([
            'remedio_id' => $remedio_id,
            'receta_id' => $receta_id  // Utilizar el ID de la receta en lugar del nroReceta
        ]);

        // Verificar la respuesta de la API
        $responseData = json_decode($response, true);
        if (!$responseData) {
            return view('/index.php/pagprincipal/paciente/error');
        }
    }
        // Establecer el mensaje de éxito en la sesión
        session()->setFlashdata('message4', 'receta cargada exitosamente');
        // Devolver a la misma página para mostrar el mensaje
        return redirect()->to('index.php/pagprincipal/receta/nuevo');
}
public function update()
{

    $input = $this->request->getJSON();

    // Verificar si hay datos necesarios
    if (empty($input->receta_id) || empty($input->array_remedio_id)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Datos incompletos'])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
    }

    $receta_id = $input->receta_id;
    $array_remedio_id = $input->array_remedio_id;


    // Asegúrate de que `array_remedio_id` sea un array
    if (!is_array($array_remedio_id)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'El formato de array_remedio_id es incorrecto'])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
    }

    $remedioreceta = new RemedioRecetaModel();

    foreach ($array_remedio_id as $remedio_id) {
        $remedio_id = intval($remedio_id);

        $response = $remedioreceta->crearRemedioReceta([
            'remedio_id' => $remedio_id,
            'receta_id' => $receta_id
        ]);

        $responseData = json_decode($response, true);
        if (!$responseData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error al procesar los datos'])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    return $this->response->setJSON(['status' => 'success', 'message' => 'Datos procesados correctamente']);
}

}
