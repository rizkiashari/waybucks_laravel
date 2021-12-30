<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AddToppingController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'loginView']);
Route::post('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'registerView']);
Route::post('/register', [HomeController::class, 'register']);
Route::get('/logout', [HomeController::class, 'logout'])->middleware('auth');

Route::get('/detailproduct', [DetailProductController::class, 'detailProduct']);


Route::get('/admin', [HomeController::class, 'adminView']);
Route::get('/cart', [HomeController::class, 'cartView']);

Route::get('/addtopping', [AddToppingController::class, 'index']);
Route::post('/addtopping', [AddToppingController::class, 'insert']);
Route::get('/addproduct', [AddProductController::class, 'index']);
Route::post('/addproduct', [AddProductController::class, 'insert']);