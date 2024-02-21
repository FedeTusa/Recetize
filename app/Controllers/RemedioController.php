<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RemedioModel;


class RemedioController extends BaseController
{
    // private $apiUrl;
    // private $client;

    // public function __construct()
    // {
    //     $this->apiUrl = 'http://localhost:8000';

    //     $this->client = \Config\Services::curlrequest();
    // }

    public function new()
    {
       $validation = \Config\Services::validation();

       return view('remedio/new',['validation' => $validation]);
    }

    // public function create()
    // {
    //    $remedio = new RemedioModel();

    //    if($this->validate('remedio')){
    //         $remedio->insert(
    //             [
    //                 'codigo' => $this->request->getPost('codigo'),
    //                 'droga' => $this->request->getPost('droga'),
    //                 'medicamento' => $this->request->getPost('medicamento')

    //             ]
    //         );
    //         return view('remedio/exito');
    //     }
        
    //    return view('remedio/error'); 
    // }

    

    public function create()
    {

        $codigo = $this->request->getPost('codigo');
        $droga = $this->request->getPost('droga');
        $medicamento = $this->request->getPost('medicamento');

        $remedio = new RemedioModel();

        $response = $remedio->crearRemedio([
            'codigo' => $codigo,
            'droga' => $droga,
            'medicamento' => $medicamento,
        ]);

        $responseData = json_decode($response, true);

        if (!$responseData) {
            return view('remedio/error');
        }

        return redirect()->to('/RemedioController/new');

        // $apiUrl = 'http://localhost:8000/remedio';


        // $response = $client->request('POST', $apiUrl, [
        //     'headers' => [
        //         'Content-Type' => 'application/json',
        //     ],
        //     'json' => $newTask,
        // ]);

        // $codigo = $this->request->getPost('codigo');
        // $droga = $this->request->getPost('droga');
        // $medicamento = $this->request->getPost('medicamento');

        // $data = [
        //     'codigo' => $codigo,
        //     'droga' => $droga,
        //     'medicamento' => $medicamento,
        // ];
            
        // $ch = curl_init($apiUrl);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        // $response = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // curl_close($ch);

        // if ($httpCode == 201) {
        //     echo 'Remedio creado con éxito';
        // } else {
        //     echo 'Error al crear el remedio';
        // }

        // if ($response->getStatusCode() === 201) {
        //     return redirect()->to('/tasks')->with('success', 'Tarea creada exitosamente.');
        // } else {
        //     return redirect()->to('/tasks')->with('error', 'Error al crear la tarea.');
        // }
    }
}
