<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
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

Route::get('/', [ClientController::class, 'home']);
Route::get('/shop', [ClientController::class, 'shop']);
Route::get('/cart', [ClientController::class, 'cart']);
Route::get('/checkout', [ClientController::class, 'checkout']);
Route::get('/login', [ClientController::class, 'login']);
Route::get('/signup', [ClientController::class, 'signup']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

Route::get('/admin/categories', [CategoryController::class, 'index']);
Route::get('/admin/category/add', [CategoryController::class, 'create']);

Route::get('/admin/products', [ProductController::class, 'index']);
Route::get('/admin/product/add', [ProductController::class, 'create']);

Route::get('/admin/sliders', [SliderController::class, 'index']);
Route::get('/admin/slider/add', [SliderController::class, 'create']);

Route::get('/admin/orders', [OrderController::class, 'index']);
