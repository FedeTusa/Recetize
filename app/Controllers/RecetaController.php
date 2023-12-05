<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RecetaModel;


class RecetaController extends BaseController
{
    public function new()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/new',['validation' => $validation]);
    }

    public function create()
    {
       

        $dni = $this->request->getPost('dni');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $celular = $this->request->getPost('celular');
        $localidad = $this->request->getPost('localidad');
        $calle = $this->request->getPost('calle');
        $altura = $this->request->getPost('altura');
    
        $paciente = new RecetaModel();

        $response = $paciente->crearPaciente([
            'dni' => $dni,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'celular' => $celular,
            'localidad' => $localidad,
            'calle' => $calle,
            'altura' => $altura,
        ]);

        $responseData = json_decode($response, true);

        if ($responseData) {
            return view('remedio/exito');
        } else {
            return view('remedio/error');
        }

    }
}

