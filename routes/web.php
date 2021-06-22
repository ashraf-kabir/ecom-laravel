<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
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

Route::get('/', [ClientController::class, 'home']);

Route::get('/shop', [ClientController::class, 'shop']);
Route::get('/shop/cat/{id}', [ClientController::class, 'shop_by_category']);

Route::get('/cart', [CartController::class, 'cart']);
Route::get('/add_to_cart/{id}', [CartController::class, 'add_to_cart']);
Route::post('/update_qty', [CartController::class, 'update_qty']);
Route::get('/cart/remove_item/{id}', [CartController::class, 'remove_item']);

Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/post_checkout', [CheckoutController::class, 'post_checkout']);

Route::get('/login', [ClientController::class, 'login']);
Route::get('/signup', [ClientController::class, 'signup']);

Route::post('/create_account', [ClientController::class, 'create_account']);
Route::post('/login_account', [ClientController::class, 'login_account']);
Route::get('/logout', [ClientController::class, 'logout']);

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
Route::get('/admin/orders/view_pdf/{id}', [PdfController::class, 'view_pdf']);

Route::group(['prefix' => 'admin'], function ()
{
  Auth::routes([
    'register' => false, // Register Routes...
    'reset'    => false, // Reset Password Routes...
    'verify'   => false // Email Verification Routes...
  ]);
});
