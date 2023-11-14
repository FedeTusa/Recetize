<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MedicoModel;


class MedicoController extends BaseController
{
    public function new()
    {
        $validation = \Config\Services::validation();
        return view('medico/new', ['validation' => $validation]);
    }

    public function create()
    {

        $matricula = $this->request->getPost('matricula');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $especialidad = $this->request->getPost('especialidad');
        $localidad = $this->request->getPost('localidad');

        $medico = new MedicoModel();

        $response = $medico->crearMedico([
            'matricula' => $matricula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'especialidad' => $especialidad,
            'localidad' => $localidad,
        ]);

        $responseData = json_decode($response, true);

        if ($responseData) {
            return view('medico/exito');
        } else {
            return view('medico/error');
        }
    }
}
