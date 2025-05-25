<form action="{{ route('transaksi.store') }}" method="POST" class="max-w-md mx-auto space-y-4">
    @csrf

    <div>
        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
        <input type="text" name="nama" id="nama" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" id="email" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div>
    <label for="nomor_customer" class="block text-sm font-medium text-gray-700 mb-1">Nomor Customer</label>
    <input type="text" name="nomor_customer" id="nomor_customer"
        class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        required>
</div>


    <div>
        <label for="tanggal_bayar" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Bayar</label>
        <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div class="pt-2">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
            Simpan
        </button>
    </div>
</form>
