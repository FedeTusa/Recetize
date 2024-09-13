<?php

use Illuminate\http\response;


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


$router->post('/api/paciente', 'PacienteController@store');
$router->get('/api/pacientes', 'PacienteController@showAll');
$router->get('/api/paciente', 'PacienteController@busqueda');
$router->get('/api/pacientepag', 'PacienteController@busquedapaginada');
$router->get('/api/paciente1', 'PacienteController@buscarPaciente');
$router->get('/api/paciente/{id}', 'PacienteController@show');
$router->put('/api/paciente/{id}', 'PacienteController@update');
$router->delete('/api/paciente/{id}','PacienteController@destroy');


$router->post('/api/remedio', 'RemedioController@store');
$router->get('/api/remedios', 'RemedioController@showAll');
$router->get('/api/remedio', 'RemedioController@busqueda');
$router->get('/api/remediopag', 'RemedioController@busquedapaginada');
$router->get('/api/remedio3', 'RemedioController@busquedaedit');
$router->get('/api/remedio1', 'RemedioController@buscarMedicamento');
$router->get('/api/remedio2', 'RemedioController@buscarPrestaciones');
$router->get('/api/remedio/{id}', 'RemedioController@show');
$router->put('/api/remedio/{id}', 'RemedioController@update');
$router->delete('/api/remedio/{id}','RemedioController@destroy');


$router->post('/api/medico', 'MedicoController@store');
$router->get('/api/medicos', 'MedicoController@showAll');
$router->get('/api/medico', 'MedicoController@busqueda');
$router->get('/api/medicopag', 'MedicoController@busquedapaginada');
$router->get('/api/medico/{id}', 'MedicoController@show');
$router->put('/api/medico/{id}', 'MedicoController@update');
$router->delete('/api/medico/{id}','MedicoController@destroy');





// Ruta para búsqueda específica
$router->get('/api/receta/busqueda', 'RecetaController@busqueda2');

// Rutas generales para recetas
$router->post('/api/receta', 'RecetaController@store');
$router->get('/api/recetas', 'RecetaController@showAll');
$router->get('/api/receta', 'RecetaController@busqueda');
$router->get('/api/recetapag', 'RecetaController@busquedapaginada');
$router->put('/api/receta/{id}', 'RecetaController@update');
$router->get('/api/receta/{id}', 'RecetaController@show');
$router->delete('/api/receta/{id}', 'RecetaController@destroy');
$router->get('/api/receta/check/{nroReceta}/{excludeId}', 'RecetaController@checkRecetaExists');
$router->get('/api/recetafechamin', 'RecetaController@FechaMin');

// Rutas para remediorecetas
$router->post('/api/remedioreceta', 'RemedioRecetaController@store');
$router->get('/api/remediorecetas', 'RemedioRecetaController@showAll');
$router->get('/api/remedioreceta', 'RemedioRecetaController@busqueda');
$router->delete('/api/remedioreceta/delete/{recetaId}', 'RemedioRecetaController@eliminarPorReceta');

// Rutas para historial
$router->get('/api/historial', 'HistorialController@showAll');
$router->post('/api/historial', 'HistorialController@CreateDelete');
$router->post('/api/historials', 'HistorialController@store');
$router->get('/api/historialpag', 'HistorialController@busquedapaginada');
$router->get('/api/historial', 'HistorialController@busqueda');
$router->get('/api/historialfechamin', 'HistorialController@FechaMin');

$router->get('/api/obrasocial', 'ObraSocialController@busqueda');