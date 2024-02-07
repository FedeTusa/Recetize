<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RemedioRecetaModel;


class RemedioRecetaController extends BaseController
{

    protected $ultimosCreados = [];

    public function create()
    {
        $remedio = $this->request->getPost('remedio_id');
    
        $remedioreceta = new RemedioRecetaModel();

        $response = $remedioreceta->crearRemedioReceta([
            'remedio_id' => $remedio
        ]);

        
        $responseData = json_decode($response, true);
        
        if ($responseData) {
            $this->cargarUltimos();
            return view('remedio/exito');
        } else {
            return view('remedio/error');
        }

    }

    protected function cargarUltimos()
    {
        $remedioreceta = new RemedioRecetaModel();

        $ultimoRemedioReceta = $remedioreceta->ultimoRemedioReceta;

        $this->ultimosCreados[] = $ultimoRemedioReceta;

        // Llama a la función recursiva si deseas seguir creando registros
        // (puedes agregar una condición para determinar cuándo detener la recursión)
        // Ejemplo: if ($condicion) { $this->create(); }
    }

    public function resetUltimo()
    {
        $this->ultimosCreados = [];
    }

    public function actualizarRemedioReceta($receta_id) 
    {
        foreach ($this->ultimosCreados as $aActualizar) {
            $aActualizar->receta_id = $receta_id;
            $aActualizar->save();
        }
    }

}
