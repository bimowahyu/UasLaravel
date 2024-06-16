<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->string('pesanan_id');
            $table->dateTime('tanggal_pesan');
            $table->integer('nominal');
            $table->enum('status_pesanan', ['PESANAN' ,'MENUNGGU_PEMBAYARAN'
            , 'TERBAYAR', 'PEMBAYARAN_DITOLAK'])->default('PESANAN');
            $table->dateTime('tanggal_bayar');
            $table->string('token');
            $table->primary('pesanan_id');
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
        Schema::dropIfExists('pesanans');
    }
};
