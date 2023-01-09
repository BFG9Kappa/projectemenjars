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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/hola',function() {
    echo "Hola";
});

//Route::get('/comandas', [App\Http\Controllers\api\comandasController::class, 'index']);
//Route::get('/comandas/{id}', [App\Http\Controllers\api\comandasController::class, 'show']);
//Route::delete('/comandas/{id}', [App\Http\Controllers\api\comandasController::class, 'destroy']);
//Route::post('/comandas/{id}', [App\Http\Controllers\api\comandasController::class, 'store']);
//Route::put('/comandas/{id}', [App\Http\Controllers\api\comandasController::class, 'update']);

Route::resource('/comandas',App\Http\Controllers\api\comandasController::class);