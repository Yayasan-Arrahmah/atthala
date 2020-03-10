<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('jadwals')) {
            Schema::create('jadwals', function (Blueprint $table) {
                $table->increments('id');
                $table->text('uuid_jadwal', 180);
                $table->text('no_jadwal', 180)->nullable();
                $table->text('nama_peserta', 180)->nullable();
                $table->text('nohp_peserta', 180)->nullable();
                $table->text('level_peserta', 180)->nullable();
                $table->text('nama_pengajar', 180)->nullable();
                $table->text('jadwal_tahsin', 180)->nullable();
                $table->text('sudah_daftar_jadwal', 180)->nullable();
                $table->text('belum_daftar_jadwal', 180)->nullable();
                $table->text('keterangan_jadwal', 180)->nullable();
                $table->text('pindahan_jadwal', 180)->nullable();
                $table->text('pindahan_jadwal_2', 180)->nullable();
                $table->text('jenis_peserta', 180)->nullable();
                $table->text('angkatan_peserta', 180)->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}
