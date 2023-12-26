<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\FacturacionControler;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\ProveedorController;
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

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


#rutas para menejar todo con producto
Route::middleware(['auth'])->group(function () {
    Route::controller(ProductoController::class)->group(function () {
        Route::get('/actualizar/{id}', 'actualizarProducto')->name('verActualizarPorduct');
        Route::get('/imagenproducto/{path}', 'verImagen')->name('verImagen');
        Route::get('/delete/{id}', 'delete')->name('deletePorduct');
        Route::get('/productos', 'index')->name('indexPorduct');
        Route::post('/agregar_productos', 'crearProducto')->name('postPorduct');
        Route::post('update/producto/{id}', 'updateProducto')->name('updatedProducto');
        Route::post('/delete/{id}', 'delete')->name('deletePorduct');
    });
});

#rutas para manejar todo lo de clientes 
Route::middleware(['auth'])->group(function () {
    Route::controller(ClientController::class)->group(function () {
        Route::post('/agregar_clientes', 'crearCliente')->name('postClient');
        Route::get('/ver/cliente/{id}', 'verActualizar')->name('verActualizar');
        Route::get('/actualizar/cliente/{id}', 'actualizarCliente')->name('verActualizarClient');
        Route::get('/delete/cliente/{id}', 'delete')->name('deleteClient');
        Route::get('/clientes', 'index')->name('indexClient');
        Route::post('update/cliente/{id}', 'updateCliente')->name('updatedClient');
    });
});


#para manejar tod con ventas
Route::middleware(['auth'])->group(function () {
    Route::controller(VentasController::class)->group(function () {
        Route::get('/ventas', 'cart')->name('indexVentas');
        Route::post('/cart-add',    'add')->name('cart.add');
        Route::post('/cart-addbarcode',    'barcode')->name('cart.barcode');
        Route::get('/cart-checkout', 'cart')->name('cart.checkout');
        Route::get('/cart-clear',  'clear')->name('cart.clear');
        Route::post('/cart-removeitem',  'removeitem')->name('cart.removeitem');
        Route::post('/cart-incrementar/{id}',  'incrementar')->name('cart.incrementar');
        Route::post('/cart-decrementar',  'decrementar')->name('cart.decrementar');
        Route::post('/cart-cantidad/{id}',  'Quantyti')->name('cart.actualizar');
    });
});

#para manejar todo con entradas 
Route::middleware(['auth'])->group(function () {
    Route::controller(EntradasController::class)->group(function () {
        Route::get('/productos/entradas', 'index')->name('product.entradas');
        Route::get('/productos/entradas/store/{id}', 'formulario')->name('product.formulario');
        Route::get('/productos/entradas/{id}', 'buscar')->name('product.buscar');
        Route::post('/productos/entradas/store/{id}', 'storeformulario')->name('product.store');
    });
});

#paar manejar todo con facturacion
Route::middleware(['auth'])->group(function () {
    Route::controller(FacturacionControler::class)->group(function () {
        Route::get('/facturacion', 'store')->name('facturacionView');
        Route::get('/abono/{id}', 'abonoView')->name('abonar');
        Route::post('/abono/{id}', 'abono')->name('Abono');
        Route::get('/factura/{id}', 'facturaIndex')->name('factura');
        Route::get('/historial', 'indexVentas')->name('historial');
        Route::post('/facturacion', 'facturacion')->name('facturacion');
        Route::get('/Abonos/{$id}', 'abonoView')->name('historial.abonos');
        // Route::get('/historial/abonos/{$id}', 'historialAbonos')->name('tabla.abonos');
    });
});

#para manejar todo lo de crear tienmdas 
Route::middleware(['auth'])->group(function () {
    Route::controller(TiendaController::class)->group(function () {

        Route::get('/tienda', 'index')->name('indexTienda');
        Route::post('/tienda', 'store')->name('storeTienda');
    });
});

#para manejar todo con proveedor
Route::middleware(['auth'])->group(function () {
    Route::controller(ProveedorController::class)->group(function () {
        Route::get('/proveedor', 'index')->name('indexProveedore');
        Route::post('/proveedor', 'store')->name('store.proveedore');
        Route::get('/proveedor/editar/{id}', 'showEdit')->name('edit.proveedore');
        Route::post('/proveedor/editar/{id}', 'edit')->name('update.proveedore');
        Route::get('/proveedor/eliminar/{id}', 'delete')->name('delete.Proveedore');
        Route::get('/proveedor/show/{id_provedor}', 'showDetalle')->name('show.proveedore');
    });
});
Route::get('/histrial/abonos/{id}', [App\Http\Controllers\LayoutController::class, 'historialAbonos'])->name('tabla.abonos');



require __DIR__ . '/auth.php';
