<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'nama',
        'email',
        'nomor_customer', // sudah diganti dari 'barang'
        'tanggal_bayar',
        'status'
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    // Opsional: accessor untuk format tanggal
    public function getTanggalBayarFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_bayar)->translatedFormat('d F Y');
    }
}
