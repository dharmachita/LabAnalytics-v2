<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');

});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Registration Routes...
if ($options['register'] ?? true) {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
}


// Password Reset Routes...
if ($options['reset'] ?? true) {
    Route::resetPassword();
}

// Email Verification Routes...
if ($options['verify'] ?? false) {
    Route::emailVerification();
}

//Rutas de la aplicación
//UBICACIONES
Route::resource('/ubicaciones', 'UbicacionController')->middleware('calidad');

//TIPO DE EQUIPO
Route::resource('/tipo_equipo', 'TipoEquipoController')->middleware('calidad');

//TIPO DE PATRON
Route::resource('/tipo_patron', 'TipoPatronController')->middleware('calidad');

//LISTA DE EQUIPOS
Route::get('/equipos', 'EquipoController@index');

//LISTA DE PATRONES
Route::get('/patrones', 'PatronController@index');

//DETALLES DE EQUIPOS
Route::get('/equipos/detalle/{equipo}', 'EquipoController@show');

//DETALLES DE PATRONES
Route::get('/patrones/detalle/{patron}', 'PatronController@show');

//CREAR EQUIPOS --> USAR MIDDELWARE
Route::get('/equipos/nuevo', 'EquipoController@indexNuevo')->middleware('calidad');
Route::post('/equipos/nuevo', 'EquipoController@store')->middleware('calidad');

//CREAR PATRONES --> USAR MIDDELWARE
Route::get('/patrones/nuevo', 'PatronController@indexNuevo')->middleware('calidad');
Route::post('/patrones/nuevo', 'PatronController@store')->middleware('calidad');

//VISUALIZAR MOVIMIENTO
Route::get('/movimientos','MovimientoController@index');