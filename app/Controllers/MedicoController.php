<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MedicoModel;


class MedicoController extends BaseController
{
    public function inicio()
    {

       $validation = \Config\Services::validation(); 

       return view('medico/InicioMedico',['validation' => $validation]);
    }
    public function new()
    {

       $validation = \Config\Services::validation(); 

       return view('medico/NuevoMedico/new',['validation' => $validation]);
    }
    public function exito()
    {

       $validation = \Config\Services::validation(); 

       return view('medico/NuevoMedico/exito',['validation' => $validation]);
    }

    public function buscar()
    {

       $validation = \Config\Services::validation(); 

       return view('medico/BuscarMedico/busqueda',['validation' => $validation]);
    }
     public function modificar()
    {

       $validation = \Config\Services::validation(); 

       return view('medico/ModificarMedico/modificar',['validation' => $validation]);
    }
    public function editar()
    {

       $validation = \Config\Services::validation(); 

       return view('medico/ModificarMedico/edit',['validation' => $validation]);
    }
    public function eliminar()
    {

       $validation = \Config\Services::validation(); 

       return view('medico/EliminarMedico/eliminacion',['validation' => $validation]);
    }
    
    public function create()
    {
        $rules = [
            'matricula' => 'is_unique[medico.matricula]',
            // Agregar otras reglas de validación aquí
        ];

        if(!$this->validate($rules)){
          return redirect()->to('index.php/pagprincipal/medico/nuevo')->withInput()->with('message', 'Matricula Duplicada');
        }

        $matricula = $this->request->getPost('matricula');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $especialidad = $this->request->getPost('especialidad');
        $prefijo = $this->request->getPost('prefijo') ?: 0;
        $celular = $this->request->getPost('celular') ?: 0;
        $email = $this->request->getPost('email') ?: '-';
        $provincia = $this->request->getPost('provincia');
        $localidad = $this->request->getPost('localidad');
        $cp = $this->request->getPost('cp');
        $calle = $this->request->getPost('calle') ?: '-';
        $altura = $this->request->getPost('altura') ?: 0;

        $medico = new MedicoModel();

       $response = $medico->crearMedico([
            'matricula' => $matricula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'especialidad' => $especialidad,
            'prefijo' => $prefijo,
            'celular' => $celular,
            'email' => $email,
            'provincia' => $provincia,
            'localidad' => $localidad,
            'cp' => $cp,
            'calle' => $calle,
            'altura' => $altura,
        ]);
        $responseData = json_decode($response, true);
        if (!$responseData) {
            return view('/index.php/pagprincipal/medico/error');
            }
        // Establecer el mensaje de éxito en la sesión
        session()->setFlashdata('message3', 'Medico cargado exitosamente');

        // Devolver a la misma página para mostrar el mensaje
        return redirect()->to('index.php/pagprincipal/medico/nuevo');


    }

  }
  