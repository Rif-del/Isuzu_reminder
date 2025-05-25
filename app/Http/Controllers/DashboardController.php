<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();

        return view('dashboard', [
            'total' => $transaksis->count(),
            'belum' => $transaksis->where('status', 'Belum Bayar')->count(),
            'sudah' => $transaksis->where('status', 'Sudah Bayar')->count(),
            'terkirim' => $transaksis->where('pengingat_terkirim', true)->count(),
            'transaksis' => $transaksis,
        ]);
    }
}
