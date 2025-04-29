<?php

use App\Http\Controllers\AdminController;
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

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/add', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::get('/angkatan', [AngkatanController::class, 'index'])->name('angkatan.index');
Route::get('/angkatan/add', [AngkatanController::class, 'create'])->name('angkatan.create');
Route::post('/angkatan', [AngkatanController::class, 'store'])->name('angkatan.store');
Route::get('/angkatan/edit/{id}', [AngkatanController::class, 'edit'])->name('angkatan.edit');
Route::put('/angkatan/{id}', [AngkatanController::class, 'update'])->name('angkatan.update');
Route::delete('/angkatan/{id}', [AngkatanController::class, 'destroy'])->name('angkatan.destroy');


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