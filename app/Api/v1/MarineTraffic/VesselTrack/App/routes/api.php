<?php

Route::group(['prefix' => 'v1/vesseltrack','middleware'=>['rate-limit']], function () {

     Route::get('',
         [
             'uses' => 'VesselTrackController@index'
         ]);

    Route::get('mmsi/{mmsi}',
        [
            'uses' => 'VesselTrackController@findByMmsi'
        ]);

    Route::get('time/{from},{to}',
        [
            'uses' => 'VesselTrackController@findByTimeInterval'
        ]);

    Route::get('coordinates/{from}/{to}',
        [
            'uses' => 'VesselTrackController@findByCoordinatesRange'
        ]);
});

