<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\RemedioRecetaController;

use App\Models\RecetaModel;
use App\Models\PacienteModel;
use App\Models\MedicoModel;

class RecetaController extends BaseController
{
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
        $remedioreceta = new RemedioRecetaController();

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
                $remedioreceta->create($receta_id);
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
}
