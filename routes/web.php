<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::get('/', function () {
//    return Inertia::render('Home');
//});


Route::get('/', fn() => redirect(route('products.index')))->name('products'); //same as below
Route::inertia('/about', 'About')->name('about');

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::resource('cart', CartItemController::class);
    Route::post('/cart/clear', [CartItemController::class, 'clear'])->name('cart.clear');

    //orders
});

Route::resource('products', ProductController::class);


//require __DIR__.'/auth.php';
