<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksis', 'nama')) {
                $table->string('nama')->nullable();
            }

            if (!Schema::hasColumn('transaksis', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('transaksis', 'barang')) {
                $table->string('barang')->nullable();
            }

            if (!Schema::hasColumn('transaksis', 'tanggal_bayar')) {
                $table->date('tanggal_bayar')->nullable();
            }

            if (!Schema::hasColumn('transaksis', 'status')) {
                $table->string('status')->default('Belum Bayar');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (Schema::hasColumn('transaksis', 'nama')) {
                $table->dropColumn('nama');
            }
            if (Schema::hasColumn('transaksis', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('transaksis', 'barang')) {
                $table->dropColumn('barang');
            }
            if (Schema::hasColumn('transaksis', 'tanggal_bayar')) {
                $table->dropColumn('tanggal_bayar');
            }
            if (Schema::hasColumn('transaksis', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
