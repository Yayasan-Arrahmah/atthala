<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenPertemuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_pertemuan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_jadwal');
            $table->string('pertemuan');
            $table->string('tilawah_pertemuan_surah')->nullable();
            $table->string('tilawah_pertemuan_ayat')->nullable();
            $table->string('tanggal_pertemuan')->nullable();
            $table->string('keterangan_pertemuan')->nullable();
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
        Schema::dropIfExists('absen_pertemuan');
    }
}
