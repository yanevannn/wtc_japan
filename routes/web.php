<?php

use App\Http\Controllers\AngkatanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('dologin');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('doregister');
    Route::get('/verifyaccount/{token}', [AuthController::class, 'verifyAccount'])->name('verifyaccount');
});

Route::get('/angkatan', [AngkatanController::class, 'index'])->name('angkatan.index');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard',
        function () {
            return view('main.main');
        }
    )->name('dashboard');
    Route::get('/profile',
        function () {
            return view('main.profile');
        }
    )->name('profile');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');