<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detail_transaksi', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('id_transaksi', 100);
          $table->string('id_jadwal', 100);
          $table->string('subtotal', 100);
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
