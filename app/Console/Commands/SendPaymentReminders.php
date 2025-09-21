<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengingatEmail;
use App\Models\Transaksi;

class SendPaymentReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Kirim email pengingat pembayaran';

    public function handle()
    {
        $transaksis = Transaksi::where('status', 'Belum Lunas')
                                ->whereDate('tanggal_bayar', now())
                                ->get();

        foreach ($transaksis as $transaksi) {
            Mail::to($transaksi->email)->send(new PengingatEmail($transaksi));
        }

        $this->info('Pengingat email terkirim!');
    }
}
