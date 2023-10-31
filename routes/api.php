<?php

use Illuminate\Support\Facades\Route;

Route::namespace('V1')->prefix('v1')->group(function () {

    // authentication
    Route::prefix('auth')
        ->namespace('Authentication')
        ->controller('AuthenticationController')
        ->group(function () {
            Route::post('send_code', 'send_code');
            Route::post('confirmation_code', 'confirmation_code');
        });


    // private routes
    Route::middleware('auth:api')->group(function(){

        // Locations
        Route::prefix('location')->namespace('Location')->controller('LocationController')->group(function(){
            Route::post('store', 'store');
        });


    });



});
