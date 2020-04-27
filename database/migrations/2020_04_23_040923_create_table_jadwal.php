<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('jadwal', function (Blueprint $table) {
          $table->bigIncrements('id_jadwal');
          $table->string('hari_1', 100);
          $table->string('hari_2', 100);
          $table->string('hari_3', 100);
          $table->string('tarif', 100);
          $table->string('pukul',100);
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
