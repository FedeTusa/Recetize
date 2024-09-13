<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RemedioModel;


class RemedioController extends BaseController
{
    public function inicio()
    {
       $validation = \Config\Services::validation();

       return view('remedio/InicioRemedio',['validation' => $validation]);
    }
    public function new()
    {

       $validation = \Config\Services::validation(); 

       return view('remedio/NuevoRemedio/new',['validation' => $validation]);
    }
    public function exito()
    {

       $validation = \Config\Services::validation(); 

       return view('remedio/NuevoRemedio/exito',['validation' => $validation]);
    }
    public function buscar()
    {

       $validation = \Config\Services::validation(); 

       return view('remedio/BuscarRemedio/busqueda',['validation' => $validation]);
    }
     public function modificar()
    {

       $validation = \Config\Services::validation(); 

       return view('remedio/ModificarRemedio/modificar',['validation' => $validation]);
    }
    public function editar()
    {

       $validation = \Config\Services::validation(); 

       return view('remedio/ModificarRemedio/edit',['validation' => $validation]);
    }
    public function eliminar()
    {

       $validation = \Config\Services::validation(); 

       return view('remedio/EliminarRemedio/eliminacion',['validation' => $validation]);
    }

    public function create()
    {
        $rules = [
          'codigo' => 'is_unique[remedio.codigo]',
        ];

        $rules1 = [
          'codigo' => 'max_length[13]',
        ];

        if(!$this->validate($rules)){
          return redirect()->to('index.php/pagprincipal/remedio/nuevo')->withInput()->with('message', 'codigo duplicado');
        }
        if(!$this->validate($rules1)){
          return redirect()->to('index.php/pagprincipal/remedio/nuevo')->withInput()->with('message', 'codigo con mas de 13 caracteres');
        }

        $codigo = $this->request->getPost('codigo');
        $droga = $this->request->getPost('droga');
        $medicamento = $this->request->getPost('medicamento');
        $prestacion = $this->request->getPost('prestacion');
        $farmacodinamia = $this->request->getPost('farmacodinamia');

        $remedio = new RemedioModel();

        $response = $remedio->crearRemedio([
            'codigo' => $codigo,
            'droga' => $droga,
            'medicamento' => $medicamento,
            'prestacion' => $prestacion,
        'farmacodinamia' => $farmacodinamia,
        ]);

        $responseData = json_decode($response, true);

        if (!$responseData) {
            return view('remedio/error');
        }

        return redirect()->to('/index.php/pagprincipal/remedio/exito');
    }
}
