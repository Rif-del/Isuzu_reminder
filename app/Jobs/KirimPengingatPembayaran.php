<?php

namespace App\Jobs;

use App\Models\Transaksi;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PengingatPembayaranMail;

class KirimPengingatPembayaran implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $hariIni = now()->format('Y-m-d');

        $transaksis = Transaksi::whereDate('tanggal_bayar', $hariIni)
            ->where('status', 'Belum Bayar')
            ->get();

        foreach ($transaksis as $transaksi) {
            if (!empty($transaksi->email)) {
                Mail::to($transaksi->email)->send(new PengingatPembayaranMail($transaksi));
            }
        }
    }
}
