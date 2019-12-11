<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('Station')->group(function(){

    Route::prefix('station')->group(function(){
        //sensors
        Route::resource('/sensors', 'AdressesController');

        //stations
        Route::resource('/stations', 'AdressesController');

        //data
        Route::resource('/data', 'AdressesController');
    });
});
