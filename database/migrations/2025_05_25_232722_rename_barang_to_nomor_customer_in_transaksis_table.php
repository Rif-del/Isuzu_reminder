<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (Schema::hasColumn('transaksis', 'barang')) {
            Schema::table('transaksis', function (Blueprint $table) {
                $table->renameColumn('barang', 'nomor_customer');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('transaksis', 'nomor_customer')) {
            Schema::table('transaksis', function (Blueprint $table) {
                $table->renameColumn('nomor_customer', 'barang');
            });
        }
    }
};
