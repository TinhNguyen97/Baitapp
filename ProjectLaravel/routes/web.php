<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
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

Route::prefix('/')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/', [ProductController::class, 'add'])->name('add');
    Route::delete('/{id}', [ProductController::class, 'delete'])->name('delete');
    Route::put('/{id}', [ProductController::class, 'put'])->name('put');

    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::post('search', [ProductController::class, 'addSearch'])->name('addSearch');
    Route::delete('search/{id}', [ProductController::class, 'deleteSearch'])->name('deleteSearch');
    Route::put('search/{id}', [ProductController::class, 'putSearch'])->name('putSearch');
});
Route::prefix('home')->name('homes.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
});
