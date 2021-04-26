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

// Route::get('/', function ()
// {
//   return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\ClientController@home');
Route::get('/shop', 'App\Http\Controllers\ClientController@shop');
Route::get('/cart', 'App\Http\Controllers\ClientController@cart');
Route::get('/checkout', 'App\Http\Controllers\ClientController@checkout');
Route::get('/login', 'App\Http\Controllers\ClientController@login');
Route::get('/signup', 'App\Http\Controllers\ClientController@signup');

Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@dashboard');
