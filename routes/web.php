<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlatController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComandaController;

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

Route::get('/taulacomandas', function () {
    return view('comandes.api.index');
});

// Auth
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Plats
Route::get('/plats', [App\Http\Controllers\PlatController::class, 'index'])->name('plats.index');
Route::get('/plats/show/{plat}', [App\Http\Controllers\PlatController::class, 'show'])->name('plats.show');

Route::group(['middleware'=>['auth','is_admin']], function() {
    Route::get('/plats/create', [App\Http\Controllers\PlatController::class, 'create'])->name('plats.create');
    Route::post('/plats/store', [App\Http\Controllers\PlatController::class, 'store'])->name('plats.store');
    Route::get('/plats/edit/{plat}', [App\Http\Controllers\PlatController::class, 'edit'])->name('plats.edit');
    Route::post('/plats/update/{plat}', [App\Http\Controllers\PlatController::class, 'update'])->name('plats.update');
    Route::get('/plats/destroy/{plat}', [App\Http\Controllers\PlatController::class, 'destroy'])->name('plats.destroy');
    Route::get('/plats/{plat}/ingredients', [App\Http\Controllers\PlatController::class, 'editIngredients'])->name('plats.editingredients');
    Route::post('/plats/{plat}/assigningredients', [App\Http\Controllers\PlatController::class, 'attachIngredients'])->name('plats.assigningredients');
    Route::post('/plats/{plat}/detachingredients', [App\Http\Controllers\PlatController::class, 'detachIngredients'])->name('plats.detachingredients');
});

// Ingredients
Route::get('/ingredients', [App\Http\Controllers\IngredientController::class, 'index'])->name('ingredients.index');

Route::group(['middleware'=>['auth','is_admin']], function() {
    Route::get('/ingredients/create', [App\Http\Controllers\IngredientController::class, 'create'])->name('ingredients.create');
    Route::post('/ingredients/store', [App\Http\Controllers\IngredientController::class, 'store'])->name('ingredients.store');
    Route::get('/ingredients/edit/{ingredient}', [App\Http\Controllers\IngredientController::class, 'edit'])->name('ingredients.edit');
    Route::post('/ingredients/update/{ingredient}', [App\Http\Controllers\IngredientController::class, 'update'])->name('ingredients.update');
    Route::get('/ingredients/destroy/{ingredient}', [App\Http\Controllers\IngredientController::class, 'destroy'])->name('ingredients.destroy');
});

// Comandes
Route::group(['middleware'=>'auth'], function() {
    Route::get('/comandes', [App\Http\Controllers\ComandaController::class, 'index'])->name('comandes.index');
    Route::get('/comandes/show/{comanda}', [App\Http\Controllers\ComandaController::class, 'show'])->name('comandes.show');
    Route::get('/comandes/create', [App\Http\Controllers\ComandaController::class, 'create'])->name('comandes.create');
    Route::post('/comandes/store', [App\Http\Controllers\ComandaController::class, 'store'])->name('comandes.store');
    Route::get('/comandes/edit/{comanda}', [App\Http\Controllers\ComandaController::class, 'edit'])->name('comandes.edit');
    Route::post('/comandes/update/{comanda}', [App\Http\Controllers\ComandaController::class, 'update'])->name('comandes.update');
    Route::get('/comandes/destroy/{comanda}', [App\Http\Controllers\ComandaController::class, 'destroy'])->name('comandes.destroy');
    Route::get('/comandes/{comanda}/plats', [App\Http\Controllers\ComandaController::class, 'editPlats'])->name('comandes.editplats');
    Route::post('/comandes/{comanda}/assignplats', [App\Http\Controllers\ComandaController::class, 'attachPlats'])->name('comandes.assignplats');
    Route::post('/comandes/{comanda}/detachplats', [App\Http\Controllers\ComandaController::class, 'detachPlats'])->name('comandes.detachplats');
});

// Clients
Route::group(['middleware'=>['auth','is_admin']], function() {
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [App\Http\Controllers\ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients/store', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/edit/{client}', [App\Http\Controllers\ClientController::class, 'edit'])->name('clients.edit');
    Route::post('/clients/update/{client}', [App\Http\Controllers\ClientController::class, 'update'])->name('clients.update');
    Route::get('/clients/destroy/{client}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('clients.destroy');
});
