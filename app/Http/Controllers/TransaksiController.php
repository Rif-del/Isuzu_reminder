<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Mail\PengingatEmail;
use Illuminate\Support\Facades\Mail;

class TransaksiController extends Controller
{
    // Tampilkan form input transaksi
    public function create()
    {
        return view('transaksi.form');
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_customer' => 'required',
            'tanggal_bayar' => 'required|date',
        ]);

        Transaksi::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_customer' => $request->nomor_customer,
            'tanggal_bayar' => $request->tanggal_bayar,
            'status' => 'Belum Bayar',
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.form', compact('transaksi'));
    }

    // Simpan hasil edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_customer' => 'required',
            'tanggal_bayar' => 'required|date',
            'status' => 'required|in:Belum Bayar,Sudah Bayar',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Cek apakah tanggal_bayar diubah
        if ($transaksi->tanggal_bayar != $request->tanggal_bayar) {
            $transaksi->pengingat_terkirim = 0; // reset agar bisa kirim ulang
        }

        $transaksi->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_customer' => $request->nomor_customer,
            'tanggal_bayar' => $request->tanggal_bayar,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil diupdate.');
    }

    // Hapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil dihapus.');
    }

    // Tes kirim email otomatis (satu transaksi saja)
    public function tesEmail()
    {
        $transaksi = Transaksi::where('status', 'Belum Bayar')
            ->whereDate('tanggal_bayar', now()->toDateString())
            ->first();

        if (!$transaksi) {
            return 'Tidak ada transaksi jatuh tempo hari ini.';
        }

        Mail::to($transaksi->email)->send(new PengingatEmail($transaksi));

        return 'Pengingat email dikirim ke ' . $transaksi->email;
    }

    // Tandai transaksi sebagai Sudah Bayar
    public function sudahBayar($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'Sudah Bayar';
        $transaksi->save();

        return redirect()->route('dashboard')->with('success', 'Status transaksi diperbarui menjadi Sudah Bayar.');
    }

    // Kirim ulang pengingat (manual, per transaksi)
    public function kirimPengingat($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status === 'Belum Bayar') {
            Mail::to($transaksi->email)->send(new PengingatEmail($transaksi));
            return redirect()->route('dashboard')->with('success', 'Pengingat berhasil dikirim.');
        }

        return redirect()->route('dashboard')->with('error', 'Status bukan Belum Bayar.');
    }
}
