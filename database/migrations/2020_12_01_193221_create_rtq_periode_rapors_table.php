<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtqPeriodeRaporsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtq_periode_rapors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama_periode', 180)->nullable();
            $table->text('waktu_periode', 100)->nullable();
            $table->text('status_periode', 100)->nullable();
            $table->text('tahun_ajaran', 180)->nullable();
            $table->text('keterangan_periode')->nullable();
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
        Schema::dropIfExists('rtq_periode_rapors');
    }
}
