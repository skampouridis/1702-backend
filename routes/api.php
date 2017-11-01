<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$availableResourceRoutes = ['index', 'show'];

Route::get('/', function(){
   return view('index');
});

Route::post('search', 'SearchController@search');

Route::resource('clients', 'ClientController', ['only' => $availableResourceRoutes]);
Route::resource('vessels', 'VesselController', ['only' => $availableResourceRoutes]);
Route::resource('searches', 'SearchController', ['only' => $availableResourceRoutes]);
Route::resource('tracks', 'VesselTrackController', ['only' => $availableResourceRoutes]);

