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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::namespace('Station')->middleware('auth')->group(function(){
    
    Route::get('/', 'HomeController@index')->name('home');

    //sensors
    Route::resource('/sensors', 'SensorsController');
    Route::get('/sensors/{sensor}/delete', 'SensorsController@delete')->name('sensors.delete');

    //stations
    Route::resource('/stations', 'StationsController');
    Route::get('/stations/{station}/delete', 'StationsController@delete')->name('stations.delete');

    //data
    Route::resource('/data', 'DataController');

    //user
    Route::resource('/user', 'UserController');
});