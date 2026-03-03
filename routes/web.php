<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderController as OrderControllerAlias;
use App\Http\Controllers\UserController;
use App\Models\Technic;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $technics = Technic::all();

    return view('index', compact('technics'));
})->name('index');

Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('auth.profile');
    Route::patch('/profile/{profile}/change', [AuthController::class, 'changeProfile'])->name('auth.profile.change');
    Route::patch('/profile/{profile}/changePassword', [AuthController::class, 'changeProfilePassword'])->name('auth.profile.changePassword');

    Route::resource('/orders', OrderController::class);
    Route::post('/orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay'); // TODO: payment system!?)

    Route::middleware('admin')->group(function () {
        Route::patch('/orders/{order}/start', [OrderController::class, 'start'])->name('orders.start');
        Route::patch('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
        Route::patch('/orders/{order}/rate', [OrderController::class, 'rate'])->name('orders.rate');
        Route::patch('/orders/{order}/revoke', [OrderController::class, 'revoke'])->name('orders.revoke');

        Route::resource('/users', UserController::class);
        Route::patch('/users/{user}/confirm', [UserController::class, 'confirm'])->name('users.confirm');
    });
});
