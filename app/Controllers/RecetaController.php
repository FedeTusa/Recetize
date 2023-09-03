<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RecetaModel;


class RecetaController extends BaseController
{
    public function new()
    {
       return view('receta/new');
    }

    public function create()
    {
       $receta = new RecetaModel();
       $receta->insert(
           [
                'nroReceta' => $this->request->getPost('nroReceta'),
                'fechaEmision' => $this->request->getPost('fechaEmision'),
                'Remedio_codigo' => $this->request->getPost('Remedio_codigo'),
                'Paciente_dni' => $this->request->getPost('Paciente_dni'),
                'Medico_matricula' => $this->request->getPost('Medico_matricula'),
            ]
        );
        
       return view('receta/new'); 
    }
}

