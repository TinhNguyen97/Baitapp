<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TypeProductController;
use App\Http\Controllers\UserController;

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


Route::prefix('/products')->middleware('admin')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/', [ProductController::class, 'add'])->name('add');
    Route::delete('/{id}', [ProductController::class, 'delete'])->name('delete');
    Route::put('/{id}', [ProductController::class, 'put'])->name('put');


    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::post('search', [ProductController::class, 'addSearch'])->name('addSearch');
    Route::delete('search/{id}', [ProductController::class, 'deleteSearch'])->name('deleteSearch');
    Route::put('search/{id}', [ProductController::class, 'putSearch'])->name('putSearch');
});
Route::prefix('/types')->middleware('admin')->name('types.')->group(function () {
    Route::get('/', [TypeProductController::class, 'index'])->name('index');
    Route::post('/', [TypeProductController::class, 'add'])->name('add');
    Route::delete('/{id}', [TypeProductController::class, 'delete'])->name('delete');
    Route::put('/{id}', [TypeProductController::class, 'put'])->name('put');


    Route::get('search', [TypeProductController::class, 'search'])->name('search');
    Route::post('search', [TypeProductController::class, 'addSearch'])->name('addSearch');
    Route::delete('search/{id}', [TypeProductController::class, 'deleteSearch'])->name('deleteSearch');
    Route::put('search/{id}', [TypeProductController::class, 'putSearch'])->name('putSearch');
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
    Route::get('/profile', [HomeController::class, 'profile'])->middleware('auth')->name('profile');
    Route::put('/profile', [HomeController::class, 'updateProfile'])->middleware('auth')->name('updateprofile');
    Route::get('/changepassword', [HomeController::class, 'changePassword'])->middleware('auth')->name('changepassword');
    Route::patch('/changepassword', [HomeController::class, 'handleChangePass'])->middleware('auth')->name('handleChangePass');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/addtocart/{id}', [HomeController::class, 'addToCart'])->middleware('auth')->name('addtocart');
    Route::get('/deletefromcart/{id}', [HomeController::class, 'deleteFromCart'])->middleware('auth')->name('deletefromcart');
    Route::get('/deleteallcart', [HomeController::class, 'deleteAllCart'])->middleware('auth')->name('deleteallcart');
    Route::post('/updateCart/{id}', [HomeController::class, 'updateCart'])->middleware('auth')->name('updatecart');
    Route::get('/order', [HomeController::class, 'order'])->middleware('auth')->name('order');
    Route::get('/orderdetail', [HomeController::class, 'orderDetail'])->middleware('auth')->name('orderdetail');
    Route::post('/handleorder', [HomeController::class, 'handleOrder'])->middleware('auth')->name('handleorder');
    Route::get('/history', [HomeController::class, 'history'])->middleware('auth')->name('history');
    Route::get('/forget-pass', [HomeController::class, 'forgetPass'])->name('forgetpass');
    Route::post('/forget-pass', [HomeController::class, 'checkForgetPass'])->name('checkforgetpass');
    Route::get('/get-pass/{user}/{token}', [HomeController::class, 'getPass'])->name('getpass');
    Route::post('/get-pass/{user}/{token}', [HomeController::class, 'checkPass'])->name('checkpass');
    Route::post('/comment/{id}', [HomeController::class, 'comment'])->middleware('auth')->name('comment');
});

Route::prefix('/orders')->middleware('admin')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/orderdetails/{id}', [OrderController::class, 'orderDetails'])->name('orderdetails');
    Route::get('/search', [OrderController::class, 'search'])->name('search');
    Route::get('/searchdetail', [OrderController::class, 'searchDetail'])->name('searchdetail');
    Route::get('/handleapprove/{id}', [OrderController::class, 'handleApprove'])->name('handleapprove');
    Route::get('/history', [OrderController::class, 'history'])->name('history');
    Route::get('/ordercancel', [OrderController::class, 'orderCancel'])->name('ordercancel');
    Route::get('/handlecancel{id}', [OrderController::class, 'handleCancel'])->name('handlecancel');
    Route::get('/historydetail/{id}', [OrderController::class, 'historyDetail'])->name('historydetail');
    Route::get('/searchordercancel', [OrderController::class, 'searchOrderCancel'])->name('searchordercancel');
    Route::get('/searchhistory', [OrderController::class, 'searchHistory'])->name('searchhistory');
});
Route::prefix('/users')->middleware('admin')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/handleactive/{id}', [UserController::class, 'handleActive'])->name('handleactive');
    Route::delete('/handledelete/{id}', [UserController::class, 'handleDelete'])->name('handledelete');
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/active-admin/{id}', [UserController::class, 'activeAdmin'])->name('activeadmin');
});
Route::prefix('/infors')->middleware('admin')->name('infors.')->group(function () {
    Route::get('/', [InfoController::class, 'index'])->name('index');
    Route::post('/infor', [InfoController::class, 'add'])->name('infor');
    Route::post('/update/{id}', [InfoController::class, 'update'])->name('update');
});

Route::get('/remove-all-notification', [NotificationController::class, 'removeAllnoti'])->middleware('admin')->name('removeallnoti');
