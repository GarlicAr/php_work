<?php

use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ControllerProducts;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerActionLog;


Route::get('/login', [ControllerAuth::class, 'showLoginForm'])->name('login');
Route::post('/login', [ControllerAuth::class, 'login']);
Route::post('/logout', [ControllerAuth::class, 'logout'])->name('logout');
Route::get('/register', [ControllerAuth::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [ControllerAuth::class, 'register']);
Route::get('api/logs', [ControllerActionLog::class, 'getRecentLogs']);

// For users
Route::middleware(['auth'])->group(function () {

    Route::get('/', [ControllerHome::class, 'index'])->name('home');
    Route::get('/product/{id}/show', [ControllerProducts::class, 'show'])->name('product.show');


});

// For Admins
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    Route::resource('product', ControllerProducts::class);

});
