<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePelatih extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pelatih', function (Blueprint $table) {
          $table->bigIncrements('id_pelatih');
          $table->string('nama_pelatih', 100);
          $table->string('telp', 100);
          $table->string('no_ktp', 100);
          $table->string('alamat', 100);
          $table->string('mobil',100);
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
        Schema::dropIfExists('table_pelatih');
    }
}
