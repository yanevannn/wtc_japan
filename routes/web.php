<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngkatanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StatusPendaftaranController;
use App\Http\Controllers\StatusSiswaController;
use App\Models\StatusSiswa;

// ===================== GUEST ROUTES =====================
Route::middleware('guest')->group(function () {
    // Auth Routes
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('dologin');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('doregister');

    Route::get('/verifyaccount/{token}', [AuthController::class, 'verifyAccount'])->name('verifyaccount');
});

// ===================== AUTH ROUTES =====================
Route::middleware('auth')->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // ===================== ADMIN =====================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/add', [AdminController::class, 'create'])->name('create');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
    });

    // ===================== ANGKATAN =====================
    Route::prefix('angkatan')->name('angkatan.')->group(function () {
        Route::get('/', [AngkatanController::class, 'index'])->name('index');
        Route::get('/add', [AngkatanController::class, 'create'])->name('create');
        Route::post('/', [AngkatanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AngkatanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AngkatanController::class, 'update'])->name('update');
        Route::delete('/{id}', [AngkatanController::class, 'destroy'])->name('destroy');
    });

    // ===================== SISWA =====================
    Route::prefix('form')->name('form.')->group(function () {
        Route::get('/personal', [SiswaController::class, 'index'])->name('personal.index');
        Route::post('/personal', [SiswaController::class, 'store'])->name('personal.store');
    });

    // ===================== STATUS =====================
    Route::get('/status-pendaftaran', [StatusPendaftaranController::class, 'index'])->name('status-pendaftaran.index');
    Route::get('/status-siswa', [StatusSiswaController::class, 'index'])->name('status-siswa.index');
});
