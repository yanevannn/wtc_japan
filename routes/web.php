<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngkatanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StatusPendaftaranController;
use App\Http\Controllers\StatusSiswaController;
use App\Models\StatusPendaftaran;

Route::get('/', function () {
    return view('main');
})->name('home');

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

    // ===================== GELOMBANG =====================
    Route::prefix('gelombang')->name('gelombang.')->group(function () {
        Route::get('/', [GelombangController::class, 'index'])->name('index');
        Route::get('/add', [GelombangController::class, 'create'])->name('create');
        Route::post('/', [GelombangController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GelombangController::class, 'edit'])->name('edit');
        Route::put('/{id}', [GelombangController::class, 'update'])->name('update');
        Route::delete('/{id}', [GelombangController::class, 'destroy'])->name('destroy');
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
        Route::put('/personal/add/', [SiswaController::class, 'store'])->name('personal.store');
        Route::get('/personal/edit', [SiswaController::class, 'edit'])->name('personal.edit');
        Route::put('/personal/{id}', [SiswaController::class, 'update'])->name('personal.update');
        Route::get('/orang-tua', [OrangTuaController::class, 'create'])->name('orang-tua.create');
        Route::post('/orang-tua', [OrangTuaController::class, 'store'])->name('orang-tua.store');
        Route::get('/orang-tua/edit', [OrangTuaController::class, 'edit'])->name('orang-tua.edit');
        Route::put('/orang-tua/{id}', [OrangTuaController::class, 'update'])->name('orang-tua.update');
    });

    // ===================== ORANG TUA =====================
    Route::prefix('orang-tua')->name('orang-tua.')->group(function () {
        Route::get('/', [OrangTuaController::class, 'index'])->name('index');
    });

    // ===================== STATUS PENDAFTARAN =====================
    Route::prefix('status-pendaftaran')->name('status-pendaftaran.')->group(function () {
        Route::get('/', [StatusPendaftaranController::class, 'index'])->name('index');
        Route::get('/add', [StatusPendaftaranController::class, 'create'])->name('create');
        Route::post('/', [StatusPendaftaranController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StatusPendaftaranController::class, 'edit'])->name('edit');
        Route::put('/{id}', [StatusPendaftaranController::class, 'update'])->name('update');
        Route::delete('/{id}', [StatusPendaftaranController::class, 'destroy'])->name('destroy');
    });

    // ===================== STATUS PENDAFTARAN  =====================
    Route::get('/status-siswa', [StatusSiswaController::class, 'index'])->name('status-siswa.index');

    // ===================== Pengumuman =====================
    Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('index');
        Route::get('/add', [PengumumanController::class, 'create'])->name('create');
        Route::post('/', [PengumumanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PengumumanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PengumumanController::class, 'update'])->name('update');
        Route::delete('/{id}', [PengumumanController::class, 'destroy'])->name('destroy');
    });
});
