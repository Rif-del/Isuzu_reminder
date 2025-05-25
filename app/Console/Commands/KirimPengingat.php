<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\PengingatEmail;
use Carbon\Carbon;

class KirimPengingat extends Command
{
    protected $signature = 'pengingat:kirim';
    protected $description = 'Kirim email pengingat untuk transaksi yang jatuh tempo hari ini';

    public function handle()
    {
        Log::info('⏰ Jadwal pengingat:kirim sedang dijalankan...');

        $transaksis = Transaksi::whereDate('tanggal_bayar', Carbon::today())
            ->where('status', 'Belum Bayar')
            ->where('pengingat_terkirim', false)
            ->get();

        foreach ($transaksis as $transaksi) {
            Mail::to($transaksi->email)->send(new PengingatEmail($transaksi));
            $transaksi->pengingat_terkirim = true;
            $transaksi->save();

            Log::info('📧 Email terkirim ke: ' . $transaksi->email);
        }

        $this->info('Email pengingat dikirim.');
    }
}
