<?php

use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'hello';
});

Route::get('/kitty', [App\Http\Controllers\HomeController::class, 'kitty']);
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about']);

Route::get('/testmysql', function () {
    $db = DB::connection()->getDatabaseName();
    dd($db);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/form-save', [App\Http\Controllers\HomeController::class, 'formsave'])->name('form-save');
Route::post('/form-save-store', [App\Http\Controllers\HomeController::class, 'formsavestore'])->name('form-save-store');

Route::get('/form-delete/{id}', [App\Http\Controllers\HomeController::class, 'formdelete'])->name('form-delete');
Route::get('/form-edit/{id}', [App\Http\Controllers\HomeController::class, 'formedit'])->name('form-edit');
Route::post('/form-save-edit', [App\Http\Controllers\HomeController::class, 'formsaveedit'])->name('form-save-edit');
