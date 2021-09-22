<?php

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

Route::redirect('/', '/login');
Auth::routes(['register' => false]);

Route::get('/products', [App\Http\Controllers\ListController::class, 'index'])->name('products');
Route::get('/list', [App\Http\Controllers\ListController::class, 'index'])->name('list');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

