<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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


Route::prefix('/products')->name('products.')->group(function () {
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
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/typesearch/{idType}', [HomeController::class, 'typeSearch'])->name('typesearch');
    Route::get('details/{id}', [HomeController::class, 'details'])->name('detail');
    Route::get('/login', [HomeController::class, 'login'])->name('login');
    Route::post('/login', [HomeController::class, 'checkLogin'])->name('checklogin');
    Route::get('/register', [HomeController::class, 'register'])->name('register');
    Route::post('/register', [HomeController::class, 'checkRegister'])->name('checkregister');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::put('/profile', [HomeController::class, 'updateProfile'])->name('updateprofile');
    Route::get('/changepassword', [HomeController::class, 'changePassword'])->name('changepassword');
    Route::patch('/changepassword', [HomeController::class, 'handleChangePass'])->name('handleChangePass');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/addtocart/{id}', [HomeController::class, 'addToCart'])->middleware('auth')->name('addtocart');
    Route::get('/deletefromcart/{id}', [HomeController::class, 'deleteFromCart'])->name('deletefromcart');
    Route::get('/deleteallcart', [HomeController::class, 'deleteAllCart'])->name('deleteallcart');
    Route::get('/order', [HomeController::class, 'order'])->name('order');
});

Route::prefix('/orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    // Route::get('/search', [HomeController::class, 'search'])->name('search');
    // Route::get('/typesearch/{idType}', [HomeController::class, 'typeSearch'])->name('typesearch');
});
