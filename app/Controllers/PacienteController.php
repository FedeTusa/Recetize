<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PacienteModel;


class PacienteController extends BaseController
{   
    public function inicio()
    {

       $validation = \Config\Services::validation(); 

       return view('paciente/InicioPaciente',['validation' => $validation]);
    }
    public function new()
    {

       $validation = \Config\Services::validation(); 

       return view('paciente/NuevoPaciente/new',['validation' => $validation]);
    }
     public function exito()
    {

       $validation = \Config\Services::validation(); 

       return view('paciente/NuevoPaciente/exito',['validation' => $validation]);
    }
        public function new2()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/NuevaReceta/PacienteReceta/new',['validation' => $validation]);
    }
     public function exito2()
    {

       $validation = \Config\Services::validation(); 

       return view('receta/NuevaReceta/PacienteReceta/exito',['validation' => $validation]);
    }
     public function buscar()
    {

       $validation = \Config\Services::validation(); 

       return view('paciente/BuscarPaciente/busqueda',['validation' => $validation]);
    }
     public function modificar()
    {

       $validation = \Config\Services::validation(); 

       return view('paciente/ModificarPaciente/modificar',['validation' => $validation]);
    }
    public function editar()
    {

       $validation = \Config\Services::validation(); 

       return view('paciente/ModificarPaciente/edit',['validation' => $validation]);
    }
    public function eliminar()
    {

       $validation = \Config\Services::validation(); 

       return view('paciente/EliminarPaciente/eliminacion',['validation' => $validation]);
    }
    
    public function create()
    {
        $rules = [
          'dni' => 'is_unique[paciente.dni]',
          /* BUSCAR MAS REGLAS DE PACIENTE CONTROLLER DE LA API, VAN ACA, NO ALLA!! */
        ];
        $rules1 = [
          'nroafiliado' => 'is_unique[paciente.nroafiliado]',
        ];

        if(!$this->validate($rules)){
          return redirect()->to('index.php/pagprincipal/paciente/nuevo')->withInput()->with('message', 'Documento Duplicado');
        }
        if(!$this->validate($rules1)){
          return redirect()->to('index.php/pagprincipal/paciente/nuevo')->withInput()->with('message2', 'Nro de Afiliado Duplicado');
        }


        $dni = $this->request->getPost('dni');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $obrasocial = $this->request->getPost('obrasocial');
        $nroafiliado = $this->request->getPost('nroafiliado');
        $prefijo = $this->request->getPost('prefijo') ?: 0;
        $celular = $this->request->getPost('celular') ?: 0;
        $email = $this->request->getPost('email') ?: '-';
        $provincia = $this->request->getPost('provincia');
        $localidad = $this->request->getPost('localidad');
        $cp = $this->request->getPost('cp');
        $calle = $this->request->getPost('calle') ?: '-';
        $altura = $this->request->getPost('altura') ?: 0;
    
        $paciente = new PacienteModel();

       $response = $paciente->crearPaciente([
            'dni' => $dni,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'obrasocial' => $obrasocial,
            'nroafiliado' => $nroafiliado,
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
            return view('/index.php/pagprincipal/paciente/error');
        }
    // Establecer el mensaje de éxito en la sesión
    session()->setFlashdata('message3', 'Paciente cargado exitosamente');

    // Devolver a la misma página para mostrar el mensaje
    return redirect()->to('index.php/pagprincipal/paciente/nuevo');

    }
        public function create2()
    {
        $rules = [
          'dni' => 'is_unique[paciente.dni]',
          /* BUSCAR MAS REGLAS DE PACIENTE CONTROLLER DE LA API, VAN ACA, NO ALLA!! */
        ];
        $rules1 = [
          'nroafiliado' => 'is_unique[paciente.nroafiliado]',
        ];

        if(!$this->validate($rules)){
          return redirect()->to('index.php/pagprincipal/recetapaciente/nuevo')->withInput()->with('message', 'Documento Duplicado');
        }
        if(!$this->validate($rules1)){
          return redirect()->to('index.php/pagprincipal/recetapaciente/nuevo')->withInput()->with('message2', 'Nro de Afiliado Duplicado');
        }


        $dni = $this->request->getPost('dni');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $obrasocial = $this->request->getPost('obrasocial');
        $nroafiliado = $this->request->getPost('nroafiliado');
        $prefijo = $this->request->getPost('prefijo') ?: 0;
        $celular = $this->request->getPost('celular') ?: 0;
        $localidad = $this->request->getPost('localidad');
        $calle = $this->request->getPost('calle') ?: '-';
        $altura = $this->request->getPost('altura') ?: 0;
    
        $paciente = new PacienteModel();

       $response = $paciente->crearPaciente([
            'dni' => $dni,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'obrasocial' => $obrasocial,
            'nroafiliado' => $nroafiliado,
            'prefijo' => $prefijo,
            'celular' => $celular,
            'localidad' => $localidad,
            'calle' => $calle,
            'altura' => $altura,
        ]);
        $responseData = json_decode($response, true);

        if (!$responseData) {
            return view('/index.php/pagprincipal/paciente/error');
        }
        return redirect()->to('/index.php/pagprincipal/recetapaciente/exito');
        

    }
}
