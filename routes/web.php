<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngkatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\NilaiSeleksiController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StatusPendaftaranController;
use App\Http\Controllers\StatusSiswaController;
use App\Http\Controllers\VerifikasiDokumenController;
use App\Http\Controllers\VerifikasiPembayaranController;

// ===================== GUEST ROUTES =====================
Route::middleware('guest')->group(function () {
    Route::get('/', function () {return redirect('/login');});
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

    // ===================== ROUTE UNTUK ROLE ADMIN =====================
    Route::middleware('role:admin')->group(function () {
        // ADMIN
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::get('/add', [AdminController::class, 'create'])->name('create');
            Route::post('/', [AdminController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
        });
        //  STATUS PENDAFTARAN 
        Route::prefix('status-pendaftaran')->name('status-pendaftaran.')->group(function () {
            Route::get('/', [StatusPendaftaranController::class, 'index'])->name('index');
            Route::get('/add', [StatusPendaftaranController::class, 'create'])->name('create');
            Route::post('/', [StatusPendaftaranController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StatusPendaftaranController::class, 'edit'])->name('edit');
            Route::put('/{id}', [StatusPendaftaranController::class, 'update'])->name('update');
            Route::delete('/{id}', [StatusPendaftaranController::class, 'destroy'])->name('destroy');
        });
        //  STATUS PENDAFTARAN  
        Route::get('/status-siswa', [StatusSiswaController::class, 'index'])->name('status-siswa.index');
        //  GELOMBANG 
        Route::prefix('gelombang')->name('gelombang.')->group(function () {
            Route::get('/', [GelombangController::class, 'index'])->name('index');
            Route::get('/add', [GelombangController::class, 'create'])->name('create');
            Route::post('/', [GelombangController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [GelombangController::class, 'edit'])->name('edit');
            Route::put('/{id}', [GelombangController::class, 'update'])->name('update');
            Route::delete('/{id}', [GelombangController::class, 'destroy'])->name('destroy');
            //Data Siswa Seleksi Gelombang
            Route::prefix('data-siswa')->name('data-siswa.')->group(function () {
                Route::get('/{id}', [NilaiSeleksiController::class, 'index'])->name('index');
                Route::get('/gelombang/{id}/download-template', [NilaiSeleksiController::class, 'downloadTemplate'])->name('download-template');
                Route::post('/gelombang/{id}/upload-nilai', [NilaiSeleksiController::class, 'uploadNilai'])->name('upload-nilai');
            });
        });
        //  VERIFIKASI
        Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
            //Verfikasi Dokumen
            Route::get('/dokumen', [VerifikasiDokumenController::class, 'index'])->name('dokumen.index');
            Route::get('/dokumen/edit/{id}', [VerifikasiDokumenController::class, 'edit'])->name('dokumen.edit');
            Route::put('/dokumen/{id}', [VerifikasiDokumenController::class, 'update'])->name('dokumen.update');
            //Verfikasi Pembayaran
            Route::get('/pembayaran-pendaftaran', [VerifikasiPembayaranController::class, 'indexPendaftaran'])->name('pembayaran-pendaftaran.index');
            Route::get('/pembayaran-pendaftaran/edit/{id}', [VerifikasiPembayaranController::class, 'editPendaftaran'])->name('pembayaran-pendaftaran.edit');
            Route::put('/pembayaran-pendaftaran/{id}', [VerifikasiPembayaranController::class, 'updatePendaftaran'])->name('pembayaran-pendaftaran.update');
            //Verfikasi Pembayaran Pelatihan
            Route::get('/pembayaran-pelatihan', [VerifikasiPembayaranController::class, 'indexPelatihan'])->name('pembayaran-pelatihan.index');
            Route::get('/pembayaran-pelatihan/edit/{id}', [VerifikasiPembayaranController::class, 'editPelatihan'])->name('pembayaran-pelatihan.edit');
            Route::put('/pembayaran-pelatihan/{id}', [VerifikasiPembayaranController::class, 'updatePelatihan'])->name('pembayaran-pelatihan.update');
        });
        //  ANGKATAN 
        Route::prefix('angkatan')->name('angkatan.')->group(function () {
            Route::get('/', [AngkatanController::class, 'index'])->name('index');
            Route::get('/add', [AngkatanController::class, 'create'])->name('create');
            Route::post('/', [AngkatanController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AngkatanController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AngkatanController::class, 'update'])->name('update');
            Route::delete('/{id}', [AngkatanController::class, 'destroy'])->name('destroy');
        });
        //  PENGUMUMAN 
        Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
            Route::get('/', [PengumumanController::class, 'index'])->name('index');
            Route::get('/add', [PengumumanController::class, 'create'])->name('create');
            Route::post('/', [PengumumanController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PengumumanController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PengumumanController::class, 'update'])->name('update');
            Route::delete('/{id}', [PengumumanController::class, 'destroy'])->name('destroy');
        });
    });

    // ===================== ROUTE UNTUK ROLE USER (SISWA) =====================
    Route::middleware('role:user')->group(function () {
        //  FORM SISWA
        Route::prefix('form')->name('form.')->group(function () {
            //siswa controller
            Route::get('/personal', [SiswaController::class, 'index'])->name('personal.index');
            Route::put('/personal/add/', [SiswaController::class, 'store'])->name('personal.store');
            Route::get('/personal/edit', [SiswaController::class, 'edit'])->name('personal.edit');
            Route::put('/personal/{id}', [SiswaController::class, 'update'])->name('personal.update');
            //orang0tua controller
            Route::get('/orang-tua', [OrangTuaController::class, 'create'])->name('orang-tua.create');
            Route::post('/orang-tua', [OrangTuaController::class, 'store'])->name('orang-tua.store');
            Route::get('/orang-tua/edit', [OrangTuaController::class, 'edit'])->name('orang-tua.edit');
            Route::put('/orang-tua/{id}', [OrangTuaController::class, 'update'])->name('orang-tua.update');
            //dokumen controller
            Route::get('/dokumen', [DokumenController::class, 'create'])->name('dokumen.create');
            Route::post('/dokumen', [DokumenController::class, 'store'])->name('dokumen.store');
            Route::get('/dokumen/edit/{jenisDokumen}', [DokumenController::class, 'edit'])->name('dokumen.edit');
            Route::put('/dokumen/{id}', [DokumenController::class, 'update'])->name('dokumen.update');
        });
        //  ORANG TUA 
        Route::prefix('orang-tua')->name('orang-tua.')->group(function () {
            Route::get('/', [OrangTuaController::class, 'index'])->name('index');
        });
        //  Dokumen 
        Route::prefix('dokumen')->name('dokumen.')->group(function () {
            Route::get('/', [DokumenController::class, 'index'])->name('index');
        });
        // PEMBAYARAN PENDAFTARAN & PELATIHAN
        Route::prefix('pembayaran/')->name('pembayaran')->group(function () {
            //Pembayran Pendaftaran (Seleksi)
            Route::get('pendaftaran', [PembayaranController::class, 'indexPendaftaran'])->name('pendaftaran');
            Route::get('pendaftaran/add', [PembayaranController::class, 'createPendaftaran'])->name('pendaftaran.create');
            Route::post('pendaftaran/', [PembayaranController::class, 'storePendaftaran'])->name('pendaftaran.store');
            Route::get('pendaftaran/edit', [PembayaranController::class, 'editPendaftaran'])->name('pendaftaran.edit');
            Route::put('pendaftaran/{id}', [PembayaranController::class, 'updatePendaftaran'])->name('pendaftaran.update');
            //Pembayran Pelatihan
            Route::get('pelatihan', [PembayaranController::class, 'indexPelatihan'])->name('pelatihan.index');
            Route::get('pelatihan/add', [PembayaranController::class, 'createPelatihan'])->name('pelatihan.create');
            Route::post('pelatihan/', [PembayaranController::class, 'storePelatihan'])->name('pelatihan.store');
            Route::get('pelatihan/edit', [PembayaranController::class, 'editPelatihan'])->name('pelatihan.edit');
            Route::put('pelatihan/{id}', [PembayaranController::class, 'updatePelatihan'])->name('pelatihan.update');
        });
        // NILAI SELEKSI & PELATIHAN
        Route::prefix('nilai')->name('nilai')->group(function () {
            Route::get('/seleksi', [NilaiSeleksiController::class, 'indexSeleksiSiswa'])->name('seleksi.index');
            Route::get('/seleksi/pdf', [NilaiSeleksiController::class, 'showNilaiSeleksiPdf'])->name('seleksi.pdf');
            // Route::get('/pelatihan', [NilaiSeleksiController::class, 'indexPelatihanSiswa'])->name('seleksi.index');
            // Route::get('/pelatihan/pdf', [NilaiSeleksiController::class, 'showNilaiSeleksiPdf'])->name('seleksi.pdf');
        });
    });
});
