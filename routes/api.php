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


Route::namespace('Site')->group(function(){

    //dados do grafico da pagina main de cada estação
    Route::get('/grafic/main', 'MainController@sendDataGrafic')->name('main.sendDataGrafic');

    //dados dos sensores da pagina main de cada estação
    Route::get('/sensor/main', 'MainController@sendDataSensor')->name('main.sendDataSensor');

    //dados do grafico do sensor especifico
    Route::get('/sensor/{id}', 'SensorController@sendDataSensor')->name('sensor.sendDataSensor');
    
    //dados do grafico do sensor especifico
    Route::get('/home/stations/{id}', 'HomeController@sendStations')->name('home.sendStations');

    //dados do usuario
    Route::get('/config/{id}', 'ConfigController@sendUserInfo')->name('config.sendUserInfo');
    
    //rota para a chegada de dados mandodos pelo nodemcu
    Route::post('/data', 'DataController@store')->name('data.store')->middleware('auth.token');

});

