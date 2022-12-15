<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

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

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::middleware(['guest'])->group(function () {
    Route::prefix('/login')->group(function () {
        Route::get('', [LoginController::class, 'index']);
        Route::post('', [LoginController::class, 'authhenticate'])->name('login');
    });
    Route::prefix('/register')->group(function () {
        Route::get('', [RegisterController::class, 'index']);
        Route::post('', [RegisterController::class, 'store'])->name('register');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::middleware('admin')->group(function () {
        Route::get('/Dashboard', [AdminController::class, 'index'])->name('admin');
    });
    Route::middleware('user')->group(function () {
        Route::get('/profile', [UserController::class, 'profile'])->name('profile.show');
        Route::put('/profile', [UserController::class, 'EditProfile'])->name('profile.edit');
        Route::post('/detail/{product:ProductID}', [CartController::class, 'AddToCart'])->name('add');
        Route::prefix('/MyCart')->group(function () {
            Route::get('', [CartController::class, 'MyCart'])->name('MyCart');
            Route::post('/{total_price}', [CartController::class, 'Checkout'])->name('checkout');
            Route::post('/{cart:CardID}', [CartController::class, 'RemoveFromCart'])->name('remove');
            Route::get('/{cart:CardID}', [CartController::class, 'EditItemCart'])->name('editCart');
            Route::post('/edit/{cart:CardID}', [CartController::class, 'UpdateItemCart'])->name('updateCart');
        });
    });
});
Route::get('/detail/{product:ProductID}', [ProductController::class, 'show'])->name('product');
