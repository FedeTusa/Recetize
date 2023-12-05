<?php

namespace App\Models;

use CodeIgniter\Model;

class PacienteModel extends Model
{
    protected $table            = 'paciente';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['dni', 'nombre', 'apellido', 'celular', 'localidad', 'calle', 'altura'];

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

        curl_close($ch);

        return $response;
    }


    public function crearPaciente($data)
    {
        return $this->sendRequest('POST', 'http://localhost:8000/paciente', $data);
    }

}
