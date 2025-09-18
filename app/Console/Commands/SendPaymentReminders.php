<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi; // Pastikan Anda sudah punya model Transaksi
use App\Mail\PengingatPembayaranMail;
use Illuminate\Support\Facades\Mail;

class SendPaymentReminders extends Command
{
    protected $signature = 'reminders:send'; // Nama perintah Anda
    protected $description = 'Kirim email pengingat untuk transaksi yang jatuh tempo.';

    public function handle()
    {
        // Ambil semua transaksi yang statusnya 'Belum Bayar' dan tanggal jatuh temponya hari ini
        $transaksi = Transaksi::where('status_bayar', 'belum_bayar')
                            ->where('tanggal_jatuh_tempo', now()->format('Y-m-d'))
                            ->get();

        $this->info("Menemukan " . $transaksi->count() . " transaksi yang jatuh tempo hari ini.");

        foreach ($transaksi as $item) {
            try {
                // Kirim email
                Mail::to($item->email_customer)->send(new PengingatPembayaranMail($item));

                $this->info("✅ Pengingat berhasil dikirim untuk transaksi ID: " . $item->id);
            } catch (\Exception $e) {
                $this->error("❌ Gagal mengirim pengingat untuk transaksi ID: " . $item->id . ". Error: " . $e->getMessage());
            }
        }
        $this->info("Proses pengiriman pengingat selesai.");
    }
}