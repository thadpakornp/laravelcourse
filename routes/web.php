<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\ShopController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth', 'isadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/form-save', [App\Http\Controllers\HomeController::class, 'formsave'])->name('form-save');
    Route::post('/form-save-store', [App\Http\Controllers\HomeController::class, 'formsavestore'])->name('form-save-store');

    Route::get('/form-delete/{id}', [App\Http\Controllers\HomeController::class, 'formdelete'])->name('form-delete');
    Route::get('/form-edit/{id}', [App\Http\Controllers\HomeController::class, 'formedit'])->name('form-edit');
    Route::post('/form-save-edit', [App\Http\Controllers\HomeController::class, 'formsaveedit'])->name('form-save-edit');

    Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
});

Route::middleware(['auth'])->prefix('shop')->name('shop.')->group(function() {
    Route::get('/addcart/{id}', [App\Http\Controllers\ShopController::class, 'addcart'])->name('addcart');
    Route::get('/cart', [App\Http\Controllers\ShopController::class, 'cart'])->name('cart');
    Route::get('/cartremove/{id}', [App\Http\Controllers\ShopController::class, 'cartremove'])->name('cartremove');
    Route::get('/clear', [App\Http\Controllers\ShopController::class, 'clear'])->name('clear');
    Route::get('/orders', [App\Http\Controllers\ShopController::class, 'orders'])->name('orders');
});

