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

Route::get('/', function () {

    if(Auth::guard('superusuarios')->check()){
        return redirect('administradores');
    }  

    if(Auth::guard('administradores')->check()){
        return redirect('medicos');
    }   

    if(Auth::guard('medicos')->check()){
        return redirect('check');
    }  




    return view('home.home');
});


Route::resource('login', 'App\Http\Controllers\Login\LoginController');
Route::get('logout', 'App\Http\Controllers\Login\LoginController@Logout');
Route::get('newpass/{id}', 'App\Http\Controllers\Login\LoginController@NewPass');
Route::post('savepass/{id}', 'App\Http\Controllers\Login\LoginController@SavePass');


Route::post('Ingresar', 'App\Http\Controllers\Login\LoginController@Ingresar');



/**
 * Rutas Super Usuarios
 */

 Route::resource('empresas', 'App\Http\Controllers\SuperUsuario\EmpresaController');
 Route::get('BorrarEmpresa/{id}', 'App\Http\Controllers\SuperUsuario\EmpresaController@BorrarEmpresa');

 Route::resource('administradores', 'App\Http\Controllers\SuperUsuario\AdministradorController');
 Route::get('BorrarAdmin/{id}', 'App\Http\Controllers\SuperUsuario\AdministradorController@BorrarAdmin');



 /**
  * Rutas Administradores 
  */


  Route::resource('registros', 'App\Http\Controllers\Administrador\RegistroController');
  Route::resource('faltas', 'App\Http\Controllers\Administrador\FaltaController');
  Route::get('minimapa/{lat}/{lon}', 'App\Http\Controllers\Administrador\RegistroController@MiniMapa');

  Route::resource('geocercas', 'App\Http\Controllers\Administrador\GeocercaController');


  Route::resource('equipos', 'App\Http\Controllers\Administrador\EquipoController');
  

  Route::get('BorrarEquipo/{id}', 'App\Http\Controllers\Administrador\EquipoController@BorrarEquipo');

  Route::resource('formularios', 'App\Http\Controllers\Administrador\FormularioController');
  Route::post('UpdatePregunta/{id}', 'App\Http\Controllers\Administrador\FormularioController@UpdatePregunta');
  Route::get('formularios/Copy/{id}', 'App\Http\Controllers\Administrador\FormularioController@Copy');
  Route::post('Copiar/{id}', 'App\Http\Controllers\Administrador\FormularioController@Copiar');
  Route::get('EliminarFormulario/{id}', 'App\Http\Controllers\Administrador\FormularioController@EliminarFormulario');
  Route::get('DestroyFormulario/{id}', 'App\Http\Controllers\Administrador\FormularioController@DestroyFormulario');
  

  Route::post('GuardarNombreFormulario/{id}', 'App\Http\Controllers\Administrador\FormularioController@GuardarNombreFormulario');
  

  Route::resource('medicos', 'App\Http\Controllers\Administrador\MedicoController');
  Route::post('NuevoPeriodo/{id}', 'App\Http\Controllers\Administrador\MedicoController@NuevoPeriodo');
  Route::post('EliminarPeriodo/{id}', 'App\Http\Controllers\Administrador\MedicoController@EliminarPeriodo');

  Route::get('BorrarMedico/{id}', 'App\Http\Controllers\Administrador\MedicoController@BorrarMedico');
  

  /**
   * Rutas Medicos
   */

   Route::resource('check', 'App\Http\Controllers\Medico\CheckinController');

   Route::post('checkin', 'App\Http\Controllers\Medico\CheckinController@Checkin');

   Route::post('checkout', 'App\Http\Controllers\Medico\CheckinController@Checkout');

   Route::post('GuardarEncuesta', 'App\Http\Controllers\Medico\CheckinController@GuardarEncuesta');