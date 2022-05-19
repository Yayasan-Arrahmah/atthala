<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_ujians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->int('id_tahsin')->nullable();
            $table->text('no_tahsin', 180)->nullable();
            $table->text('status_pelunasan', 180)->nullable();
            $table->text('bukti_transfer', 180)->nullable();
            $table->text('angkatan_ujian', 10)->nullable();
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
        Schema::dropIfExists('peserta_ujians');
    }
}
