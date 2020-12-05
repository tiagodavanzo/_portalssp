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

$router->get('/usuario', 'UsuarioController@index');
$router->get('/usuario/{id}', 'UsuarioController@show');
$router->post('/usuario', 'UsuarioController@create');
$router->put('/usuario/{id}', 'UsuarioController@update');
$router->delete('/usuario/{id}', 'UsuarioController@delete');
$router->post('/login', 'UsuarioController@login');

$router->get('/chamado', 'ChamadoController@index');
$router->get('/chamado/{id}', 'ChamadoController@show');
$router->post('/chamado', 'ChamadoController@create');
$router->put('/chamado/{id}', 'ChamadoController@update');
$router->delete('/chamado/{id}', 'ChamadoController@delete');
$router->get('/chamadosCliente', 'ChamadoController@chamadosCliente');