<?php

namespace App\Models;

use CodeIgniter\Model;

class RemedioRecetaModel extends Model
{
    protected $table            = 'remedioreceta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['remedio_id', 'receta_id'];

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
    
    public function crearRemedioReceta($data)
    {
        // dd($data);
        return $this->sendRequest('POST', 'http://localhost:8000/api/remedioreceta', $data);
    }

    public function remediosDeReceta(int $id_receta)
    {
        return $this->sendRequest('GET', 'http://localhost:8000/busqueda/remedioreceta?busqueda=' . $id_receta);
    }

}
