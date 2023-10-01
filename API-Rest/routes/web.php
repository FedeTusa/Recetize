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