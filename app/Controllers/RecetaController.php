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

    public function new()
    {

        $validation = \Config\Services::validation();

        return view('receta/new', ['validation' => $validation]);
    }

    public function create()
    {
        $nroReceta = $this->request->getPost('nroReceta');
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
        
        if ($responseData) {
            if (isset($responseData['id'])) {
                $receta_id = $responseData['id'];
                $this->remedioreceta->create($receta_id);
            }
            return view('receta/exito');
        } else {
            return view('receta/error');
        }
    }

    public function show()
    {
        $receta = new RecetaModel();
        $paciente = new PacienteModel();
        $medico = new MedicoModel();

        $todasLasRecetas = $receta->obtenerRecetas();

        $todasLasRecetas = json_decode($todasLasRecetas, true);

        foreach ($todasLasRecetas as &$unaReceta) {
            $idPaciente = (int) $unaReceta['Paciente_id'];
            $idMedico = (int) $unaReceta['Medico_id'];
            $nombrePaciente = $paciente->pacientePorId($idPaciente);
            $nombreMedico = $medico->medicoPorId($idMedico);
            $nombrePaciente = json_decode($nombrePaciente, true);
            $nombreMedico = json_decode($nombreMedico, true);
            $unaReceta['Paciente_id'] = $nombrePaciente['nombre']." ".$nombrePaciente['apellido'];
            $unaReceta['Medico_id'] = $nombreMedico['nombre']." ".$nombreMedico['apellido'];
        }
        unset($unaReceta);

        if ($todasLasRecetas) {
            return view('busqueda', ['todasLasRecetas' => $todasLasRecetas]);
        }
    }

    public function consult()
    {
        $receta = new RecetaModel();
        $paciente = new PacienteModel();
        $medico = new MedicoModel();

        $todasLasRecetas = $receta->obtenerRecetas();

        $todasLasRecetas = json_decode($todasLasRecetas, true);

        foreach ($todasLasRecetas as &$unaReceta) {
            $idPaciente = (int) $unaReceta['Paciente_id'];
            $idMedico = (int) $unaReceta['Medico_id'];
            $nombrePaciente = $paciente->pacientePorId($idPaciente);
            $nombreMedico = $medico->medicoPorId($idMedico);
            $nombrePaciente = json_decode($nombrePaciente, true);
            $nombreMedico = json_decode($nombreMedico, true);
            $unaReceta['Paciente_id'] = $nombrePaciente['nombre']." ".$nombrePaciente['apellido'];
            $unaReceta['Medico_id'] = $nombreMedico['nombre']." ".$nombreMedico['apellido'];
        }
        unset($unaReceta);

        if ($todasLasRecetas) {
            return view('consulta', ['todasLasRecetas' => $todasLasRecetas]);
        }
    }

    public function eliminacion()
    {
        $receta = new RecetaModel();
        $paciente = new PacienteModel();
        $medico = new MedicoModel();

        $todasLasRecetas = $receta->obtenerRecetas();

        $todasLasRecetas = json_decode($todasLasRecetas, true);

        foreach ($todasLasRecetas as $receta => &$unaReceta) {
            if ($unaReceta['borrado_logico'] == 1) {
                unset($todasLasRecetas[$receta]);
            } else {
                $idPaciente = (int) $unaReceta['Paciente_id'];
                $idMedico = (int) $unaReceta['Medico_id'];
                $nombrePaciente = $paciente->pacientePorId($idPaciente);
                $nombreMedico = $medico->medicoPorId($idMedico);
                $nombrePaciente = json_decode($nombrePaciente, true);
                $nombreMedico = json_decode($nombreMedico, true);
                $unaReceta['Paciente_id'] = $nombrePaciente['nombre']." ".$nombrePaciente['apellido'];
                $unaReceta['Medico_id'] = $nombreMedico['nombre']." ".$nombreMedico['apellido'];
            }
        }
        unset($unaReceta);

        if ($todasLasRecetas) {
            return view('eliminacion', ['todasLasRecetas' => $todasLasRecetas]);
        }
    }

    public function eliminarReceta(int $id)
    {
        $receta = new RecetaModel();

        $response = $receta->editarReceta($id, [
            'borrado_logico' => 1
        ]);

        return $this->eliminacion();

        // $responseData = json_decode($response, true);
        
        // if ($responseData) {
        //     return view('receta/exito');
        // } else {
        //     return view('receta/error');
        // }
    }
}
