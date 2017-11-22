<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//We don't want any web view, so the API will return a json response for unknown urls.
//The framework automatically converts the response array into json
Route::get('/', function () {
    return [
        "code"=>401,
        "status"=>"error",
        "message"=>"Invalid request"
    ];
});
