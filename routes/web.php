<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ShoppingController;
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

Route::get('/',[
    'uses' => 'FrontEndController@index',
    'as' => 'index'
]);
Route::get('/product/{id}', [FrontEndController::class, 'singleProduct'])->name('product.single');
Route::post('/cart/add', [ShoppingController::class,'add_to_cart'])->name('cart.add');
Route::get('/cart', [ShoppingController::class,'cart'])->name('cart');
Route::get('/cart/delete/{id}', [ShoppingController::class,'cartDelete'])->name('cart.delete');
Route::get('/cart/decr/{id}/{qty}', [ShoppingController::class,'cartDecr'])->name('cart.decr');
Route::get('/cart/incr/{id}/{qty}', [ShoppingController::class,'cartIncr'])->name('cart.incr');
Route::get('/cart/rapid/add/{id}', [ShoppingController::class,'rapid_add'])->name('cart.rapid.add');
Route::get('/cart/checkout', [CheckoutController::class,'index'])->name('cart.checkout');
Route::post('/cart/checkout', [CheckoutController::class,'pay'])->name('cart.checkout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('products', 'ProductsController');
