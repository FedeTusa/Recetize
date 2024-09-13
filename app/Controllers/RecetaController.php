<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\RemedioRecetaController;

use App\Models\RecetaModel;
use App\Models\PacienteModel;
use App\Models\MedicoModel;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use CodeIgniter\API\ResponseTrait;
use App\Models\RemedioRecetaModel;
use App\Models\RemedioModel;

class RecetaController extends BaseController
{
    protected $remedioreceta;
    protected $session;

    /**
     * Initializer 
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->remedioreceta = new RemedioRecetaController($request, $response, $logger);
        $this->session = \Config\Services::session();
    }

    public function inicio()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/InicioReceta',['validation' => $validation]);
    }
    public function new()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/NuevaReceta/new',['validation' => $validation]);
    }
    public function exito()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/NuevaReceta/exito',['validation' => $validation]);
    }
    public function buscar()
    {

       $validation = \Config\Services::validation(); 
       
       return view('receta/BuscarReceta/busqueda',['validation' => $validation]);
    }
     public function modificar()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/ModificarReceta/modificar',['validation' => $validation]);
    }
    public function editar()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/ModificarReceta/edit',['validation' => $validation]);
    }
    public function eliminar()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/EliminarReceta/eliminacion',['validation' => $validation]);
    }

    public function create()
    {
        $nroReceta = strval($this->request->getPost('nroReceta'));
        $fechaEmision = $this->request->getPost('fechaEmision');
        $Paciente_id = $this->request->getPost('Paciente_id');
        $Medico_id = $this->request->getPost('Medico_id');

        $receta = new RecetaModel();

        $response = $receta->crearReceta([
            'nroReceta' => $nroReceta,
            'fechaEmision' => $fechaEmision,
            'Paciente_id' => $Paciente_id,
            'Medico_id' => $Medico_id,
        ]);

        $responseData = json_decode($response, true);
        
        if (!$responseData) {
            return view('/index.php/pagprincipal/receta/error');
            }
        // Establecer el mensaje de éxito en la sesión
        session()->setFlashdata('message4', 'Receta cargada exitosamente');

        // Devolver a la misma página para mostrar el mensaje
        return redirect()->to('index.php/pagprincipal/receta/nuevo');
    }

    use ResponseTrait;

    public function buscarRecetas()
    {
        $nroReceta = $this->request->getGet('nroReceta');
        $fechaEmision = $this->request->getGet('fechaEmision');
        $paciente_id = $this->request->getGet('paciente_id');
        $medico_id = $this->request->getGet('medico_id');

        $recetaModel = new RecetaModel();
        $remedioRecetaModel = new RemedioRecetaModel();
        $remedioModel = new RemedioModel();

        // Construir la consulta de recetas
        $recetas = $recetaModel->where(function($query) use ($nroReceta, $fechaEmision, $paciente_id, $medico_id) {
            if ($nroReceta) {
                $query->like('nroReceta', $nroReceta);
            }
            if ($fechaEmision) {
                $query->like('fechaEmision', $fechaEmision);
            }
            if ($paciente_id) {
                $query->like('paciente_id', $paciente_id);
            }
            if ($medico_id) {
                $query->like('medico_id', $medico_id);
            }
        })->findAll();
        
        $resultados = [];

        foreach ($recetas as $receta) {
            // Obtener los remedios asociados a la receta
            $remedioIds = $remedioRecetaModel->where('receta_id', $receta['nroReceta'])->findColumn('remedio_id');
            $remedios = $remedioModel->whereIn('id', $remedioIds)->findAll();

            // Agregar los remedios a la receta
            $receta['remedios'] = $remedios;

            // Obtener datos del paciente y del médico de la API Lumen
            $paciente = $this->obtenerDatosPaciente($receta['paciente_id']);
            $medico = $this->obtenerDatosMedico($receta['medico_id']);

            $receta['paciente'] = $paciente;
            $receta['medico'] = $medico;

            $resultados[] = $receta;
        }

        return $this->respond($resultados);
    }

    private function obtenerDatosPaciente($paciente_id)
{
    // Llamada a la API Lumen para obtener datos del paciente
    $response = \Config\Services::curlrequest()->get("http://localhost:8000/api/paciente1", [
        'query' => ['id' => $paciente_id]
    ]);

    $data = json_decode($response->getBody(), true);
    return $data ?: []; // Devolver un array vacío si no se encuentra el paciente
}

private function obtenerDatosMedico($medico_id)
{
    // Llamada a la API Lumen para obtener datos del médico
    $response = \Config\Services::curlrequest()->get("http://localhost:8000/api/medico1", [
        'query' => ['id' => $medico_id]
    ]);

    $data = json_decode($response->getBody(), true);
    return $data ?: []; // Devolver un array vacío si no se encuentra el médico
}

}
