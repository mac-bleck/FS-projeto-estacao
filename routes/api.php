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

/*
Route::namespace('Api')->group(function(){

    Route::prefix('station')->group(function(){
        //sensors
        Route::resource('/sensors', 'SensorsController');

        //stations
        Route::resource('/stations', 'StationsController');

        //data
        Route::resource('/data', 'DataController');

        //user
        Route::resource('/user', 'UserController');

    });
});
*/

Route::namespace('Site')->group(function(){

    Route::get('/grafic/main', 'MainController@sendDataGrafic')->name('main.sendDataGrafic');
    Route::get('/sensor/main', 'MainController@sendDataSensor')->name('main.sendDataSensor');

    Route::get('/sensor/{id}', 'SensorController@sendDataSensor')->name('sensor.sendDataSensor');
    
    Route::post('/data', 'DataController@store')->name('data.store');
});

