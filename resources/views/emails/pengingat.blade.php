<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pengingat Pembayaran</title>
</head>
<body>
    <h2>Halo, {{ $transaksi->nama }}</h2>
    <p>
        Ini adalah pengingat bahwa ada transaksi perlu kamu follow up 
        <strong>{{ $transaksi->barang ?? '-' }}</strong> 
        yang akan jatuh tempo pada 
        <strong>{{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('d M Y') }}</strong>.
    </p>
    <p>Status saat ini: <strong>{{ $transaksi->status }}</strong></p>
    <p>Segera lakukan Follow up ke customer. Terima kasih.</p>
</body>
</html>
