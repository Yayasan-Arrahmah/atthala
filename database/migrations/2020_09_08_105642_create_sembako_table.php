<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSembakoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sembako', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama', 180)->nullable();
            $table->text('notelp', 180)->nullable();
            $table->text('status'); // KARYAWAN - ASATIDZ - NON KARYAWAN/ASATIDZ
            $table->json('pesanan');
            $table->text('total');
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
        Schema::dropIfExists('sembako');
    }
}
