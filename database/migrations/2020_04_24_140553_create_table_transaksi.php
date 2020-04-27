<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transaksi', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('id_pelanggan', 100);
          $table->string('id_petugas', 100);
          $table->string('tgl_transaksi', 100);
          $table->string('tgl_mulai', 100);
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
        Schema::dropIfExists('table_petugas');
    }
}
