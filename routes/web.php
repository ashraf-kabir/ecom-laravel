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
Route::post('/admin/category/store', [CategoryController::class, 'store']);
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit']);
Route::put('/admin/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/admin/category/delete/{id}', [CategoryController::class, 'destroy']);

Route::get('/admin/products', [ProductController::class, 'index']);
Route::get('/admin/product/add', [ProductController::class, 'create']);
Route::post('/admin/product/store', [ProductController::class, 'store']);
Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit']);
Route::put('/admin/product/update/{id}', [ProductController::class, 'update']);
Route::get('/admin/product/delete/{id}', [ProductController::class, 'destroy']);
Route::get('/admin/product/activate/{id}', [ProductController::class, 'activate']);
Route::get('/admin/product/deactivate/{id}', [ProductController::class, 'deactivate']);

Route::get('/admin/sliders', [SliderController::class, 'index']);
Route::get('/admin/slider/add', [SliderController::class, 'create']);
Route::post('/admin/slider/store', [SliderController::class, 'store']);
Route::get('/admin/slider/edit/{id}', [SliderController::class, 'edit']);
Route::put('/admin/slider/update/{id}', [SliderController::class, 'update']);
Route::get('/admin/slider/delete/{id}', [SliderController::class, 'destroy']);
Route::get('/admin/slider/activate/{id}', [SliderController::class, 'activate']);
Route::get('/admin/slider/deactivate/{id}', [SliderController::class, 'deactivate']);

Route::get('/admin/orders', [OrderController::class, 'index']);
