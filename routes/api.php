<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function(){

});

Route::get('allProductos', [ProductoController::class, 'mostrarProductos']);
Route::get('/detalles/{id}', [ProductoController::class, 'buscarProduc']);
