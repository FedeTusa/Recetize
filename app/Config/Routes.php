<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/pagprincipal', 'Home::main');

/**
$routes->resource('RemedioController');
$routes->resource('PacienteController');
$routes->resource('MedicoController');
$routes->resource('RecetaController');
$routes->resource('RemedioRecetaController');
**/
$routes->post('RemedioRecetaController/agregarRemedioTemporal', 'RemedioRecetaController::agregarRemedioTemporal');

$routes->get('/pagprincipal/paciente', 'PacienteController::inicio');
$routes->get('/pagprincipal/paciente/nuevo', 'PacienteController::new');
$routes->get('/pagprincipal/paciente/exito', 'PacienteController::exito');
$routes->get('/pagprincipal/recetapaciente/nuevo', 'PacienteController::new2');
$routes->get('/pagprincipal/recetapaciente/exito', 'PacienteController::exito2');
$routes->post('/pagprincipal/paciente', 'PacienteController::create');
$routes->post('/pagprincipal/recetapaciente', 'PacienteController::create2');
$routes->get('/pagprincipal/paciente/buscar', 'PacienteController::buscar');
$routes->get('/pagprincipal/paciente/modificar', 'PacienteController::modificar');
$routes->get('/pagprincipal/paciente/editar', 'PacienteController::editar');
$routes->get('/pagprincipal/paciente/eliminar', 'PacienteController::eliminar');




$routes->get('/pagprincipal/remedio', 'RemedioController::inicio');
$routes->get('/pagprincipal/remedio/nuevo', 'RemedioController::new');
$routes->get('/pagprincipal/remedio/exito', 'RemedioController::exito');
$routes->post('/pagprincipal/remedio', 'RemedioController::create');
$routes->get('/pagprincipal/remedio/buscar', 'RemedioController::buscar');
$routes->get('/pagprincipal/remedio/modificar', 'RemedioController::modificar');
$routes->get('/pagprincipal/remedio/editar', 'RemedioController::editar');
$routes->get('/pagprincipal/remedio/eliminar', 'RemedioController::eliminar');





$routes->get('/pagprincipal/medico', 'MedicoController::inicio');
$routes->get('/pagprincipal/medico/nuevo', 'MedicoController::new');
$routes->get('/pagprincipal/medico/exito', 'MedicoController::exito');
$routes->post('/pagprincipal/medico', 'MedicoController::create');
$routes->get('/pagprincipal/medico/buscar', 'MedicoController::buscar');
$routes->get('/pagprincipal/medico/modificar', 'MedicoController::modificar');
$routes->get('/pagprincipal/medico/editar', 'MedicoController::editar');
$routes->get('/pagprincipal/medico/eliminar', 'MedicoController::eliminar');





$routes->get('/pagprincipal/receta', 'RecetaController::inicio');
$routes->get('/pagprincipal/receta/nuevo', 'RecetaController::new');
$routes->get('/pagprincipal/receta/exito', 'RecetaController::exito');
$routes->get('/pagprincipal/receta/buscar', 'RecetaController::buscar');
$routes->get('/pagprincipal/receta/modificar', 'RecetaController::modificar');
$routes->get('/pagprincipal/receta/editar', 'RecetaController::editar');
$routes->get('/pagprincipal/receta/eliminar', 'RecetaController::eliminar');


$routes->post('/pagprincipal/remedioreceta', 'RemedioRecetaController::create');
$routes->post('/pagprincipal/remedioreceta1', 'RemedioRecetaController::update');


$routes->get('/pagprincipal/historial', 'HistorialController::inicio');