<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/remedios', ['uses' => 'RemedioController@showAll']); 
$router->get('/remedio/{id}', ['uses' => 'RemedioController@show']);

$router->post('/remedio',['uses' => 'RemedioController@store']);
$router->post('/editarRemedio/{id}',['uses' => 'RemedioController@update']);

$router->delete('/remedio/{id}',['uses' => 'RemedioController@destroy']);

$router->get('/pacientes', ['uses' => 'PacienteController@showAll']); 
$router->get('/paciente/{id}', ['uses' => 'PacienteController@show']);

$router->post('/paciente',['uses' => 'PacienteController@store']);
$router->post('/editarPaciente/{id}',['uses' => 'PacienteController@update']);

$router->delete('/paciente/{id}',['uses' => 'PacienteController@destroy']);

$router->get('/medicos', ['uses' => 'MedicoController@showAll']); 
$router->get('/medico/{id}', ['uses' => 'MedicoController@show']);

$router->post('/medico',['uses' => 'MedicoController@store']);
$router->post('/editarMedico/{id}',['uses' => 'MedicoController@update']);

$router->delete('/medico/{id}',['uses' => 'MedicoController@destroy']);

$router->get('/recetas', ['uses' => 'RecetaController@showAll']);
$router->get('/receta/{id}', ['uses' => 'RecetaController@show']);

$router->post('/editarReceta/{id}',['uses' => 'RecetaController@update']);
$router->post('/receta',['uses' => 'RecetaController@store']);

$router->delete('/receta/{id}',['uses' => 'RecetaController@destroy']);

$router->get('/remedioreceta', ['uses' => 'RemedioRecetaController@showAll']);
$router->get('/remedioreceta/{id}', ['uses' => 'RemedioRecetaController@show']);

$router->post('/remedioreceta',['uses' => 'RemedioRecetaController@store']);
$router->post('/actualizarRemedioReceta/{id}',['uses' => 'RemedioRecetaController@update']);


