<?php

namespace App\Models;

use CodeIgniter\Model;

class RemedioModel extends Model
{
    protected $table = 'remedio';
    protected $primaryKey = 'id';
    protected $allowedFields    = ['codigo', 'droga', 'medicamento'];

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


    public function crearRemedio($data)
    {
        /*        $data = [
            'codigo' => $data['codigo'],
            'droga' => $data['droga'],
            'medicamento' => $data['medicamento'],
        ];*/

        return $this->sendRequest('POST', 'http://localhost:8000/remedio', $data);
    }



    /*  // Dates 
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = []; */
}
