<?php

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


Route::group(['middleware' =>['auth']],function(){

  Route::get('/', 'HomeController@index')->name('home');

  Route::get('/empresas', 'EmpresaController@index')->name('empresas');

  //Ruta para crear la empresa
  Route::post('/crearEmpresa',[
    'uses' => 'EmpresaController@store',
    'as'   => 'crearEmpresa'
  ]);

  //Ruta para editar la empresa
  Route::put('editarEmpresa/{id}',[
    'uses' => 'EmpresaController@update',
    'as'   => 'editarEmpresa'
  ]);
  //Ruta para eliminar la empresa
  Route::get('eliminarEmpresa/{id}',[
    'uses' => 'EmpresaController@destroy',
    'as'   => 'eliminarEmpresa'
  ]);

  Route::get('/empleados', 'EmpleadoController@index')->name('empelados');

  //Ruta para crear la empresa
  Route::post('/crearEmpleado',[
    'uses' => 'EmpleadoController@store',
    'as'   => 'crearEmpleado'
  ]);

  //Ruta para editar la empresa
  Route::put('editarEmpleado/{id}',[
    'uses' => 'EmpleadoController@update',
    'as'   => 'editarEmpleado'
  ]);
  //Ruta para eliminar la empresa
  Route::get('eliminarEmpleado/{id}',[
    'uses' => 'EmpleadoController@destroy',
    'as'   => 'eliminarEmpleado'
  ]);

});
Auth::routes();
