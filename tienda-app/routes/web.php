<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
#rutas para menejar todo con producto
Route::controller(ProductoController::class)->group(function () {
    Route::get('/actualizar/{id}', 'actualizarProducto')->name('verActualizarPorduct');
    Route::get('/imagenproducto/{path}', 'verImagen')->name('verImagen');
    Route::get('/delete/{id}', 'delete')->name('deletePorduct');
    Route::get('/', 'index')->name('indexPorduct');
    Route::post('/agregar_productos', 'crearProducto')->name('postPorduct');
    Route::post('update/producto/{id}', 'updateProducto')->name('updatedProducto');
    Route::post('/delete/{id}', 'delete')->name('deletePorduct');
});
#rutas para manejar todo lo de clientes 
Route::controller(ClientController::class)->group(function () {
    Route::post('/agregar_clientes', 'crearCliente')->name('postClient');
    Route::get('/ver/cliente/{id}', 'verActualizar')->name('verActualizar');
    Route::get('/actualizar/cliente/{id}', 'actualizarCliente')->name('verActualizarClient');
    Route::get('/delete/cliente/{id}', 'delete')->name('deleteClient');
    Route::get('/clientes', 'index')->name('indexClient');
    Route::post('update/cliente/{id}', 'updateCliente')->name('updatedClient');
});
