<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaUjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_ujian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('no_tahsin', 180)->nullable();
            $table->text('nama_peserta', 180)->nullable();
            $table->text('nohp_peserta', 180)->nullable();
            $table->text('level_peserta', 180)->nullable();
            $table->text('nama_pengajar', 180)->nullable();
            $table->text('jadwal_tahsin', 180)->nullable();
            $table->text('sudah_daftar_tahsin', 180)->nullable();
            $table->text('jenis_peserta', 180)->nullable();
            $table->text('angkatan_peserta', 180)->nullable();
            $table->text('pilih_jadwal_peserta', 180)->nullable();
            $table->text('tempat_lahir_peserta', 180)->nullable();
            $table->text('status_peserta', 180)->nullable();
            $table->text('status_pembayaran', 180)->nullable();
            $table->text('status_kelulusan', 180)->nullable();
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
        Schema::dropIfExists('peserta_ujian');
    }
}
