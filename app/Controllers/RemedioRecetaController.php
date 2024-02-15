<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RemedioRecetaModel;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// helper('session');

// if (!session()->isStarted()) {
//     session()->start();
// }


class RemedioRecetaController extends BaseController
{
    /**
     * @var RemedioRecetaModel instance
     */
     // $remediorecetaModel;
     
    protected $remediorecetaModel;
    protected $session;

    /**
     * Initializer 
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        $this->remediorecetaModel = model('RemedioRecetaModel');
        $this->session = \Config\Services::session();
    }

    public function agregarRemedioTemporal() {
        $remedio_id = $this->request->getPost('remedio_id');

        $remedios_temporales = $this->session->get('remedios_temporales', []);
        $remedios_temporales[] = $remedio_id;
        $this->session->set('remedios_temporales', $remedios_temporales);
    }
    
    public function create(int $receta_id)
    {
        dd($this->session);
        $remedios_temporales = $this->session->get('remedios_temporales', []);
        
        foreach ($remedios_temporales as $remedio_id) {
            $this->remediorecetaModel->crearRemedioReceta([
                'remedio_id' => $remedio_id,
                'receta_id' => $receta_id
        ]);
        }
        
        $this->session->remove('remedios_temporales');
        // $responseData = json_decode($response, true);
        
        // if ($responseData) {
        //     return view('remedio/exito');
        // } else {
        //     return view('remedio/error');
        // }

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
