<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengingatPembayaranMail;

// ===========================
// Tes Kirim Email Sementara
// ===========================
Route::get('/tes-email', function () {
    $data = [
        'nama' => 'Randy',
        'barang' => 'Sparepart Mesin',
        'tanggal_bayar' => now()->addDays(2)->format('d-m-Y'),
    ];

    Mail::to('rifkhisiddo@gmail.com')->send(new PengingatPembayaranMail($data));

    return "✅ Email berhasil dikirim ke inbox!";
});

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
