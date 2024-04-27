<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('wahana_id');
            $table->foreignId('jadwal_id');
            $table->foreignId('user_id');
            $table->foreignId('payment_id');
            $table->decimal('total_bayar', 10, 2);
            $table->dateTime('tanggal_pesan');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('jumlah_tiket');
            $table->string('kode_tiket');
            $table->string('status');
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
        Schema::dropIfExists('transaksis');
    }
}
