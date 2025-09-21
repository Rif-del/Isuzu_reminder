<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengingatPembayaranMail;
use Carbon\Carbon;

class KirimPengingatHarian extends Command
{
    protected $signature = 'pengingat:harian';
    protected $description = 'Kirim email pengingat untuk transaksi yang jatuh tempo';

    public function handle()
    {
        $today = Carbon::now()->toDateString();

        $transaksis = Transaksi::whereDate('tanggal_bayar', $today)->get();

        foreach ($transaksis as $trx) {
            $data = [
                'nama' => $trx->nama,
                'barang' => $trx->barang,
                'tanggal_bayar' => $trx->tanggal_bayar,
            ];

            Mail::to($trx->email)->send(new PengingatPembayaranMail($data));
        }

        $this->info("✅ Pengingat terkirim untuk transaksi tanggal {$today}");
    }
}
