<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarritoController;
use App\Livewire\HomeIndex;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', \App\Livewire\HomeIndex::class)->name('home');


// Rutas PÚBLICAS de productos (de main) - SOLO UNA VEZ
Route::get('/productos', [ProductoController::class, 'index'])->name('productos');

Route::get('/dashboard', [ProfileController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/productos/filtrar', [ProductoController::class, 'filter']);
Route::get('/productos/{id}', [ProductoController::class, 'verProducto']);

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/catalogo', \App\Livewire\HomeIndex::class)->name('catalogo');
    Route::get('/carrito', \App\Livewire\CarritoShow::class)->name('carrito');
    Route::get('/checkout', \App\Livewire\CheckoutPage::class)->name('checkout');
    Route::get('/checkout/confirmacion/{pedido}', \App\Livewire\CheckoutConfirmacion::class)->name('checkout.confirmacion');
    Route::get('/seleccionar-metodo-entrega/{productoId}', \App\Livewire\SeleccionarMetodoEntrega::class)->name('seleccionar-metodo-entrega');

    Route::get('/stats', function () {
        return view('stats');
    })->name('stats');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
