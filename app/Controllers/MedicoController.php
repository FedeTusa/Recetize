<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MedicoModel;


class MedicoController extends BaseController
{
    public function new()
    {
       return view('medico/new');
    }

    public function create()
    {
       $medico = new MedicoModel();
       $medico->insert(
           [
                'matricula' => $this->request->getPost('matricula'),
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'),
                'especialidad' => $this->request->getPost('especialidad'),
                'localidad' => $this->request->getPost('localidad'),

            ]
        );
        
       return "se hizo el post"; 
    }
}
