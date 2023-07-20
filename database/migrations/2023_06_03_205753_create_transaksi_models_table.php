<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_models', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('nama');
            $table->string('nota')->default('-');
            $table->string('kategori')->default('-')->nullable();
            $table->char('pemasukan')->default('-')->nullable();
            $table->char('pengeluaran')->default('-')->nullable();
            $table->text('catatan')->nullable();
            $table->string('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_models');
    }
}
