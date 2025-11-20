<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/marca/{slug}', [FrontendController::class, 'marcaProductos'])->name('marca.productos');
Route::get('/producto/{slug}', [FrontendController::class, 'productoDetalle'])->name('producto.detalle');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [FrontendController::class, 'articuloDetalle'])->name('articulo.detalle');
