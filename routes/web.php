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

/**********************************************************************
                    CRUD - UBICACIONES / TE / TP
**********************************************************************/

//UBICACIONES
Route::resource('/ubicaciones', 'UbicacionController')->middleware('calidad');

//TIPO DE EQUIPO
Route::resource('/tipo_equipo', 'TipoEquipoController')->middleware('calidad');

//TIPO DE PATRON
Route::resource('/tipo_patron', 'TipoPatronController')->middleware('calidad');


/**********************************************************************
                        CRUD - EQUIPOS
**********************************************************************/

//LISTA DE EQUIPOS
Route::get('/equipos', 'EquipoController@index')->middleware('auth');

//DETALLES DE EQUIPOS
Route::get('/equipos/detalle/{equipo}', 'EquipoController@show')->middleware('auth');

//CREAR EQUIPOS
Route::get('/equipos/nuevo', 'EquipoController@indexNuevo')->middleware('calidad');
Route::post('/equipos/nuevo', 'EquipoController@store')->middleware('calidad');


/**********************************************************************
                        CRUD - PATRONES
**********************************************************************/

//LISTA DE PATRONES
Route::get('/patrones', 'PatronController@index')->middleware('auth');

//DETALLES DE PATRONES
Route::get('/patrones/detalle/{patron}', 'PatronController@show')->middleware('auth');

//CREAR PATRONES 
Route::get('/patrones/nuevo', 'PatronController@indexNuevo')->middleware('calidad');
Route::post('/patrones/nuevo', 'PatronController@store')->middleware('calidad');


/**********************************************************************
                        CRUD - MOVIMIENTOS
**********************************************************************/

//VISUALIZAR MOVIMIENTO
Route::get('/movimientos','MovimientoController@index')->middleware('auth');

//ELIMINAR MOVIMIENTOS
Route::delete('/movimientos/{id}','MovimientoController@destroy')->middleware('calidad');

//EDITAR MOVIMIENTO
Route::get('/movimientos/{id}/edit','MovimientoController@edit')->middleware('calidad');
Route::put('/movimientos/{id}','MovimientoController@update')->middleware('calidad');

//CREAR MOVIMIENTO
Route::get('/movimientos/nuevo', 'MovimientoController@indexNuevo')->middleware('calidad');
Route::post('/movimientos/nuevo', 'MovimientoController@store')->middleware('calidad');

Route::get('/movimientos/{id}', function () {return abort(404);})->middleware('calidad');

/**********************************************************************
                        CRUD - REPARACIONES
**********************************************************************/

//VISUALIZAR REPARACIONES
Route::get('/reparaciones','ReparacionController@index')->middleware('auth');
Route::get('/reparaciones/{id}', function () {return abort(404);})->middleware('calidad');

//DETALLE DE REPARACIONES
Route::get('/reparaciones/detalle/{id}','ReparacionController@show')->middleware('auth');

//ELIMINAR REPARACIONES
Route::delete('/reparaciones/{id}','ReparacionController@destroy')->middleware('calidad');

//EDITAR REPARACIONES
Route::put('/reparaciones/{id}','ReparacionController@update')->middleware('calidad');

//CREAR REPARACIONES
Route::get('/reparaciones_nuevo', 'ReparacionController@indexNuevo')->middleware('calidad');
Route::post('/reparaciones', 'ReparacionController@store')->middleware('calidad');

//CREAR EVENTO
Route::post('/crear_evento', 'ReparacionController@crearEvento')->middleware('calidad');
Route::get('/crear_evento', function () {return abort(404);})->middleware('calidad');