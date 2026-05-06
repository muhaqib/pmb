<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPendaftarController;

/*
|--------------------------------------------------------------------------
| Web Routes - PMB STIT Mambaul Hikmah
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard Routes (Calon Mahasiswa)
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/formulir', [DashboardController::class, 'formulir'])->name('dashboard.formulir');
    Route::post('/formulir', [DashboardController::class, 'updateFormulir'])->name('dashboard.formulir.update');
    
    Route::get('/dokumen', [DashboardController::class, 'dokumen'])->name('dashboard.dokumen');
    Route::post('/dokumen', [DashboardController::class, 'uploadDokumen'])->name('dashboard.dokumen.upload');
    
    Route::get('/pembayaran', [DashboardController::class, 'pembayaran'])->name('dashboard.pembayaran');
    Route::post('/pembayaran', [DashboardController::class, 'uploadPembayaran'])->name('dashboard.pembayaran.upload');
    
    Route::get('/pengumuman', [DashboardController::class, 'pengumuman'])->name('dashboard.pengumuman');
    Route::get('/jadwal', [DashboardController::class, 'jadwal'])->name('dashboard.jadwal');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/pendaftar', [AdminPendaftarController::class, 'index'])->name('pendaftar.index');
    Route::get('/pendaftar/export', [AdminPendaftarController::class, 'export'])->name('pendaftar.export');
    Route::get('/pendaftar/{id}', [AdminPendaftarController::class, 'show'])->name('pendaftar.show');
    Route::post('/pendaftar/{id}/kelulusan', [AdminPendaftarController::class, 'setKelulusan'])->name('pendaftar.kelulusan');
    
    Route::post('/dokumen/{id}/verifikasi', [AdminPendaftarController::class, 'verifikasiDokumen'])->name('dokumen.verifikasi');
    Route::post('/pembayaran/{id}/verifikasi', [AdminPendaftarController::class, 'verifikasiPembayaran'])->name('pembayaran.verifikasi');
});
