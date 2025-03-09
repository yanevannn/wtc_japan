<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('dologin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('doregister');
});


Route::middleware('auth')->group(function () {

    Route::get(
        '/dashboard',
        function () {
            return view('main.admin.dashboard');
        }
    )->name('dashboard');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
