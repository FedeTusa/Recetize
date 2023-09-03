<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RemedioModel;


class RemedioController extends BaseController
{
    public function new()
    {
       return view('remedio/new');
    }

    public function create()
    {
       $remedio = new RemedioModel();
       $remedio->insert(
           [
                'codigo' => $this->request->getPost('codigo'),
                'droga' => $this->request->getPost('droga'),
                'medicamento' => $this->request->getPost('medicamento')

            ]
        );
        
       return view('remedio/new'); 
    }
}
