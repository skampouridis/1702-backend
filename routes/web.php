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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// log : Stores incoming requests into the database
// throttle : Limits requests per user to 10/hour. (Using the request remote IP as a user identifier)
// formatter : Formats an Eloquent collection in json, xml or csv formats.
$router->group(['middleware' => ['log', 'throttle', 'formatter']], function () use ($router) {
    $router->get('api/v1/positions', 'PositionController@index');
    $router->get('api/v1/positions/{id}', 'PositionController@get');
    $router->post('api/v1/positions', 'PositionController@create');
    $router->put('api/v1/positions/{id}', 'PositionController@update');
    $router->patch('api/v1/positions/{id}', 'PositionController@update');
    $router->delete('api/v1/positions/{id}', 'PositionController@delete');
});
