<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pengingat Pembayaran</title>
</head>
<body>
    <h2>Halo, {{ $data['nama'] }}</h2>
    <p>
        Ini adalah pengingat bahwa ada transaksi
        <strong>{{ $data['barang'] }}</strong>
        yang akan jatuh tempo pada
        <strong>{{ $data['tanggal_bayar'] }}</strong>.
    </p>
    <p>Status: <strong>Belum Bayar</strong></p>
    <p>Segera lakukan follow up ke customer. Terima kasih.</p>
</body>
</html>
