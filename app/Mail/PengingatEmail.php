<?php

use Illuminate\Support\Facades\Route;   // <- ini penting
use Illuminate\Support\Facades\Mail;
use App\Mail\PengingatEmail;
use App\Models\Transaksi;

Route::get('/test-email', function () {
    $transaksi = Transaksi::first();

    if (!$transaksi) {
        $transaksi = new Transaksi([
            'nama' => 'Rusdi',
            'barang' => 'Laptop Asus',
            'tanggal_bayar' => now()->addDays(3),
            'status' => 'Belum Lunas',
            'email' => 'tes@example.com'
        ]);
    }

    Mail::to($transaksi->email ?? 'tes@example.com')->send(new PengingatEmail($transaksi));

    return "Email pengingat sudah dikirim!";
});
