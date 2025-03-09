<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'doLogin'])->name('dologin');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'doRegister'])->name('doregister');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    $name = Auth::user()->name;
    return view('main.admin.dashboard', compact('name'));}
    )->name('dashboard');
