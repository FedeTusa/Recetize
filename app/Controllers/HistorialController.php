<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HistorialController extends Controller
{
    public function inicio()
    {

       $validation = \Config\Services::validation(); 

       return view('historial/historial',['validation' => $validation]);
    }
    public function index()
    {

        $response = $client->request('GET', 'http://localhost:8000/api/historial');
        $data = json_decode($response->getBody(), true);

        $data = [
            'title' => 'Historial',
            'historial' => $historial // Los datos del historial
        ]; // Agrega cualquier dato adicional que quieras pasar a la vista
        return view('historial', $data);
    }
}