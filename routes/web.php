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

// Nodrosinam drosu autorizaciju
Route::middleware(['auth'])->group(function () {

    Route::get('/', [ControllerHome::class, 'index'])->name('home');
    Route::get('/product/{id}', [ControllerProducts::class, 'show'])->name('product.show');


});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    Route::resource('product', ControllerProducts::class);

});
