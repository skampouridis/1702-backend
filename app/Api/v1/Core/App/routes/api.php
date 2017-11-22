<?php

Route::group(['prefix' => 'v1'], function () {

     Route::get('{url}', function () {

        return [
            'code'=>500,
            'message'=>'Unknown endpoint'
        ];
    });
});
