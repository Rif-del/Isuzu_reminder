<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Astra Isuzu') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard Pengingat Pembayaran</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 font-sans leading-normal tracking-normal">
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 bg-blue-900 min-h-screen text-white p-6 space-y-6">
                <h2 class="text-2xl font-bold">Invent Reminder</h2>
                <nav class="space-y-2">
                    <a href="#" class="block py-2 px-3 rounded hover:bg-blue-700">Dashboard</a>
                    <a href="#" class="block py-2 px-3 rounded hover:bg-blue-700">Input Transaksi</a>
                    <a href="#" class="block py-2 px-3 rounded hover:bg-blue-700">Riwayat</a>
                    <a href="#" class="block py-2 px-3 rounded hover:bg-blue-700">Notifikasi</a>
                    <a href="#" class="block py-2 px-3 rounded hover:bg-blue-700">Pengaturan</a>
                </nav>
            </div>

            <!-- Main content -->
            <div class="flex-1 p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-semibold text-blue-900">Dashboard</h1>
                    <p class="text-gray-500">Astra Isuzu</p>
                </div>

                <!-- Summary cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h3 class="text-sm text-gray-600">Total Transaksi</h3>
                        <p class="text-2xl font-bold text-blue-800">{{ $total }}</p>
                    </div>

                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h3 class="text-sm text-gray-600">Belum Bayar</h3>
                        <p class="text-2xl font-bold text-red-600">{{ $belum }}</p>
                    </div>

                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h3 class="text-sm text-gray-600">Pengingat Terkirim</h3>
                        <p class="text-2xl font-bold text-yellow-500">{{ $terkirim }}</p>
                    </div>

                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h3 class="text-sm text-gray-600">Sudah Bayar</h3>
                        <p class="text-2xl font-bold text-green-600">{{ $sudah }}</p>
                    </div>
                </div>

                <!-- Table Transaksi -->
                <div class="bg-white shadow rounded-lg overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-800 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Nomor Customer</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Tanggal Bayar</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transaksis as $t)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $t->nama }}</td>
                                <td class="px-6 py-4">{{ $t->nomor_customer }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($t->tanggal_bayar)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">
                                    @if($t->status == 'Belum Bayar')
                                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">Belum Bayar</span>
                                    @else
                                        <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Sudah Bayar</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('transaksi.edit', $t->id) }}"
                                       class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Edit</a>

                                    <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    </html>
</x-app-layout>
