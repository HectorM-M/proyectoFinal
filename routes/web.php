<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;

/*
|------------------------------------
| 1. RUTAS DE AUTENTICACIÓN (LOGIN)
|-------------------------------------
*/
 // Mostrar formulario de inicio de sesión
 Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');

 // Procesar el envío de credenciales (Validación y Hash)
 Route::post('/login', [AuthController::class, 'autenticar'])->name('login.autenticar');

 // Cierre de sesión seguro
 Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|----------------------------------------------------------------------
| 1. RUTAS PROTEGIDAS (SOLO PARA USUARIOS AUTENTICADOS)
|----------------------------------------------------------------------
*/
 Route::middleware(['auth'])->group(function () {

   // --- CRUD DE PRODUCTOS ---
Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

// ESTA ES LA QUE TE FALTABA PARA EL BOTÓN EDITAR (GET)
Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');

// ESTA PROCESA LA ACTUALIZACIÓN (PUT)
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');

// ELIMINAR (DELETE) - OK
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

// --- PROCESO DE VENTA ---
// PASO A (Formulario) - OK
Route::get('/productos/{id}/vender', [ProductoController::class, 'formularioVenta'])->name('productos.formVenta');
// PASO B (Procesamiento) - OK
Route::post('/productos/{id}/vender', [ProductoController::class, 'mostrarVenta'])->name('productos.vender');

   /*
    |----------------------------------------------
    | 4. APARTADO DE ARTÍCULOS
    |----------------------------------------------- */

    Route::get('/articulos', [ProductoController::class, 'mostrarArticulos'])->name('productos.articulos');

     /*
    |----------------------------------------------
    | 5. APARTADO DE Carrito
    |----------------------------------------------- */
    
    Route::get('/carrito', [ProductoController::class, 'verCarrito'])->name('carrito.index');
    // Ruta para añadir producto al carrito (usando su ID)
    Route::post('/carrito/agregar/{id}', [ProductoController::class, 'agregarAlCarrito'])->name('carrito.agregar');
    // Ruta para eliminar producto del carrito
    Route::delete('/carrito/eliminar/{id}', [ProductoController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');

});