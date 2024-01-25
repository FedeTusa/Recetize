<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RecetaModel;


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
        $Remedio_id = $this->request->getPost('Remedio_id');
        $Paciente_id = $this->request->getPost('Paciente_id');
        $Medico_id = $this->request->getPost('Medico_id');

        $receta = new RecetaModel();

        $response = $receta->crearReceta([
            'nroReceta' => $nroReceta,
            'fechaEmision' => $fechaEmision,
            'Remedio_id' => $Remedio_id,
            'Paciente_id' => $Paciente_id,
            'Medico_id' => $Medico_id,
        ]);

        $responseData = json_decode($response, true);

        if ($responseData) {
            return view('receta/exito');
        } else {
            return view('receta/error');
        }
    }

    public function show()
    {
        $receta = new RecetaModel();

        $todasLasRecetas = $receta->obtenerRecetas();

        $todasLasRecetas = json_decode($todasLasRecetas, true);
        
        if ($todasLasRecetas) {
            return view('busqueda', ['todasLasRecetas' => $todasLasRecetas]);
        }
    }
}
