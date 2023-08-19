<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Não precisa colocar o caminho do arquivo basta descomentar o codigo abaixo 
app\Providers\RouteServiceProvider.php
protected $namespace = 'App\\Http\\Controllers'; 
*/

//Route::resource('cliente','App\Http\Controllers\ClienteController'); --esse modelo tem o create e edite. 
Route::apiResource('cliente','App\Http\Controllers\ClienteController');
Route::apiResource('carro','App\Http\Controllers\CarroController');
Route::apiResource('locacao','App\Http\Controllers\LocacaoController');
Route::apiResource('marca','App\Http\Controllers\MarcaController');
Route::apiResource('modelo','App\Http\Controllers\ClienteController');