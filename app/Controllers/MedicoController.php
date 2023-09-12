<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MedicoModel;


class MedicoController extends BaseController
{
    public function new()
    {
       $validation = \Config\Services::validation();
       return view('medico/new',['validation' => $validation]);
    }

    public function create()
    {
       $medico = new MedicoModel();

       if($this->validate('medico')){
            $medico->insert(
                [
                    'matricula' => $this->request->getPost('matricula'),
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'especialidad' => $this->request->getPost('especialidad'),
                    'localidad' => $this->request->getPost('localidad'),

                ]
            );
            return view('medico/exito');
        }
        
       return view('medico/error'); 
    }
}
