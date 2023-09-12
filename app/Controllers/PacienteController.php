<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PacienteModel;


class PacienteController extends BaseController
{
    public function new()
    {

       $validation = \Config\Services::validation(); 

       return view('paciente/new',['validation' => $validation]);
    }

    public function create()
    {
       $paciente = new PacienteModel();

       if($this->validate('paciente')){
            $paciente->insert(
                [
                    'dni' => $this->request->getPost('dni'),
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'celular' => $this->request->getPost('celular'),
                    'localidad' => $this->request->getPost('localidad'),
                    'calle' => $this->request->getPost('calle'),
                    'altura' => $this->request->getPost('altura')
    
                ]
            );
            return view('paciente/exito');
        }

       //return redirect()->back()->withInput();
       return view('paciente/error'); 
    }
}
