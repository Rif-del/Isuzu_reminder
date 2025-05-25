@php
    $transaksi = $transaksi ?? null;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($transaksi) ? 'Edit Transaksi' : 'Input Transaksi' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form method="POST" action="{{ isset($transaksi) ? route('transaksi.update', $transaksi->id) : route('transaksi.store') }}">
                @csrf
                @if(isset($transaksi))
                    @method('PUT')
                @endif

                {{-- Nama --}}
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                    <input type="text" name="nama" id="nama"
                        class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('nama', $transaksi->nama ?? '') }}" required>
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Pelanggan</label>
                    <input type="email" name="email" id="email"
                        class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('email', $transaksi->email ?? '') }}" required>
                </div>

                {{-- Barang --}}
                <div class="mb-4">
                    <label for="barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" name="barang" id="barang"
                        class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('barang', $transaksi->barang ?? '') }}" required>
                </div>

                {{-- Tanggal Bayar --}}
                <div class="mb-4">
                    <label for="tanggal_bayar" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Jatuh Tempo</label>
                    <input type="date" name="tanggal_bayar" id="tanggal_bayar"
                        class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('tanggal_bayar', isset($transaksi) ? \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('Y-m-d') : '') }}" required>
                </div>

                {{-- Status (hanya untuk edit) --}}
                @if($transaksi)
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status"
                            class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Belum Bayar" {{ $transaksi->status === 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="Sudah Bayar" {{ $transaksi->status === 'Sudah Bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                        </select>
                    </div>
                @endif

                {{-- Tombol --}}
                <div class="flex justify-start">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                        {{ isset($transaksi) ? 'Update' : 'Simpan' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
