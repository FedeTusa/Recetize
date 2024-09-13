<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicoModel extends Model
{
    protected $table            = 'medico';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['matricula', 'nombre', 'apellido', 'especialidad', 'prefijo', 'celular',  'email', 'provincia', 'localidad', 'cp', 'calle', 'altura'];

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


    public function crearMedico($data)
    {
        return $this->sendRequest('POST', 'http://localhost:8000/api/medico', $data);
    }

    public function medicoPorId(int $id)
    {
       return $this->sendRequest('GET', 'http://recetize.test/index.php/pagprincipal/medico'.$id);
    }

}
