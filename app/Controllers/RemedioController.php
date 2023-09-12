<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RemedioModel;


class RemedioController extends BaseController
{
    public function new()
    {
       $validation = \Config\Services::validation();

       return view('remedio/new',['validation' => $validation]);
    }

    public function create()
    {
       $remedio = new RemedioModel();

       if($this->validate('remedio')){
            $remedio->insert(
                [
                    'codigo' => $this->request->getPost('codigo'),
                    'droga' => $this->request->getPost('droga'),
                    'medicamento' => $this->request->getPost('medicamento')

                ]
            );
            return view('remedio/exito');
        }
        
       return view('remedio/error'); 
    }
}
