<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PacienteModel;
/* include('App\Models\PacienteModel'); */

class RecetaModel extends Model
{
    protected $table            = 'receta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nroReceta', 'fechaEmision', 'Remedio_id', 'Paciente_id', 'Medico_id'];

    private function sendRequest($method, $url, $data = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error en la solicitud cURL: ' . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }


    public function crearReceta($data)
    {
        return $this->sendRequest('POST', 'http://localhost:8000/receta', $data);
    }

    public function obtenerRecetas()
    {
        return $this->sendRequest('GET', 'http://localhost:8000/recetas');
    }
}
