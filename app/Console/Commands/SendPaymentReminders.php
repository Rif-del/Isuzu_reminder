<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengingatPembayaranMail;
use App\Models\Transaksi;

class SendPaymentReminders extends Command
{
    // Signature harus sama dengan Kernel
    protected $signature = 'reminders:send';

    protected $description = 'Kirim email pengingat pembayaran ke customer sesuai tanggal jatuh tempo';

    public function handle()
    {
        // Ambil transaksi yang jatuh tempo hari ini
        $transaksis = Transaksi::whereDate('tanggal_bayar', now()->toDateString())
            ->where('status', 'Belum Lunas')
            ->get();

        if ($transaksis->isEmpty()) {
            $this->info('Tidak ada transaksi jatuh tempo hari ini.');
            return 0;
        }

        foreach ($transaksis as $transaksi) {
            if ($transaksi->email) {
                Mail::to($transaksi->email)->send(new PengingatPembayaranMail([
                    'nama'          => $transaksi->nama,
                    'barang'        => $transaksi->barang,
                    'tanggal_bayar' => $transaksi->tanggal_bayar,
                    'status'        => $transaksi->status,
                ]));

                $this->info("Email pengingat terkirim ke {$transaksi->email}");
            } else {
                $this->warn("Transaksi ID {$transaksi->id} tidak punya email.");
            }
        }

        return 0;
    }
}
