<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//ruta funciones api
Route::apiResource('v1/products', App\Http\Controllers\Api\V1\ProductController::class)
    ->only(['index','show', 'destroy', 'store', 'update'])
        ->middleware('auth:sanctum');

//ruta autenticación
Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);