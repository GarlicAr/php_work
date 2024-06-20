<?php

use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ControllerProducts;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/login', [ControllerAuth::class, 'showLoginForm'])->name('login');
Route::post('/login', [ControllerAuth::class, 'login']);
Route::post('/logout', [ControllerAuth::class, 'logout'])->name('logout');
Route::get('/register', [ControllerAuth::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [ControllerAuth::class, 'register']);

// For users
Route::middleware(['auth'])->group(function () {

    Route::get('/', [ControllerHome::class, 'index'])->name('home');
    Route::get('/product/{id}', [ControllerProducts::class, 'show'])->name('product.show');


});

// For Admins
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    Route::get('product/create', [ControllerProducts::class, 'create'])->name('product.create');
    Route::post('product/store', [ControllerProducts::class, 'store'])->name('product.store');
    Route::resource('product', ControllerProducts::class);

});
