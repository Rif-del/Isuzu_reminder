<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
// ===========================
// Halaman Awal (Tanpa Login)
// ===========================
Route::get('/', function () {
    return view('welcome');
});

// ===========================
// Rute yang Perlu Login
// ===========================
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Transaksi
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::put('/transaksi/{id}/sudah-bayar', [TransaksiController::class, 'sudahBayar'])->name('transaksi.sudahBayar');
    Route::post('/transaksi/{id}/kirim-pengingat', [TransaksiController::class, 'kirimPengingat'])->name('transaksi.kirimPengingat');
    

    // Dummy route (boleh dihapus kalau tidak perlu)
    Route::delete('/delete', function () {
        return 'Sementara route delete dummy.';
    })->name('delete');
});

// Otentikasi
require __DIR__.'/auth.php';

// Rute untuk Cron Job Eksternal
Route::get('/scheduler', function () {
    // Pastikan token rahasia dari .env cocok
    if (request('token') !== env('SCHEDULER_TOKEN')) {
        abort(403);
    }
    
    // Jalankan scheduler
    Artisan::call('schedule:run');
    return "Scheduler berhasil dijalankan!";
});
