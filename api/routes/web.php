<?php

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

/*$router->get('/', function () use ($router) {
    return view('home');
});*/

$router->get('candidatos', 'CandidatoController@index');
$router->get('candidatos/{id}', 'CandidatoController@get');
$router->put('candidatos/{id}', 'CandidatoController@update');
$router->post('candidatos', 'CandidatoController@store');
$router->delete('candidatos/{id}', 'CandidatoController@delete');
$router->get('next/{id}', 'CandidatoController@next');
$router->get('prev/{id}', 'CandidatoController@prev');

 