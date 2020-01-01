<?php
use Illuminate\Http\Request;
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

Auth::routes();

Route::namespace('Station')->middleware('auth')->group(function(){

    //sensors
    Route::resource('/sensors', 'SensorsController');
    Route::get('/sensors/{sensor}/delete', 'SensorsController@delete')->name('sensors.delete');

    //stations
    Route::resource('/stations', 'StationsController');
    Route::get('/stations/{station}/delete', 'StationsController@delete')->name('stations.delete');

    //user
    Route::resource('/user', 'UserController');

});

Route::namespace('Site')->middleware('auth')->group(function(){
    
    //pagina home
    Route::get('/', 'HomeController@index')->name('home');

    //pagina main
    Route::get('/main', 'MainController@index')->name('main');

    //pagina de sensores
    Route::get('/sensor/{id}', 'SensorController@show')->name('sensor.show');
    Route::post('/sensor/download', 'SensorController@downloadData')->name('sensor.download');

    //config
    Route::get('/config', 'ConfigController@index')->name('config');
    
});