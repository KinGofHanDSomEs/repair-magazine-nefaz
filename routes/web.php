<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('index'))->name('index');
Route::get('/register', fn () => view('register'))->name('register');
Route::get('/login', fn () => view('login'))->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/profile', fn () => view('profile'))->name('profile');
});
