<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('RemedioController');
$routes->resource('PacienteController');
$routes->resource('MedicoController');
$routes->resource('RecetaController');

$routes->get('/pagprincipal', 'Home::main');