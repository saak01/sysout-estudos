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
    return view('welcome');
});

//Rotas para gerenciar veículos
Route::group([],function(){
        //Listar os usuários cadastrados
        Route::get('/usuarios', ['uses' => 'UserController@index', 'role' => 'user.index']);
        //Exibir Formulário para cadastrar um novo usuário
        Route::get('/usuarios/cadastrar', ['uses' => 'UserController@create', 'role' => 'user.create']);
        //Criar Usuário
        Route::post('/usuarios',['uses' => 'UserController@insert', 'role' => 'user.create']);
        //Exibir formulário para editar um usuário já cadastrado
        Route::get('/usuarios/{id}/editar', ['uses' => 'UserController@edit', 'role' => 'user.update']);
        //Atualizarr Usuário
        Route::put('/usuarios',['uses' => 'UserController@update', 'role' => 'user.update']);
        //Deletar Usuário
        Route::delete('/usuarios',['uses' => 'UserController@delete', 'role' => 'user.delete']);
});

//Rotas para gerenciar veículos
Route::group([],function(){
    // Exibir form listar veiculos
    Route::get('/veiculos', ['uses' => 'VehicleController@index', 'role' => 'vehicle.index']);
    // Exibir form cadastro de um novo veículo.
    Route::get('/veiculos/cadastrar', ['uses' => 'VehicleController@create', 'role' => 'vehicle.create']);
    // Cadastrar novo veículo
    Route::post('/veiculos', ['uses' => 'VehicleController@insert', 'role' => 'vehicle.create']);
    // Exibir form Listar veículo
    Route::get('/veiculos/{id}/editar', ['uses' => 'VehicleController@edit', 'role' => 'vehicle.update']);
    // Editar Veículo
    Route::put('/veiculos', ['uses' => 'VehicleController@update', 'role' => 'vehicle.update']);
    // Deletar Veículo
    Route::delete('/veiculos', ['uses' => 'VehicleController@delete', 'role' => 'vehicle.delete']);
});
