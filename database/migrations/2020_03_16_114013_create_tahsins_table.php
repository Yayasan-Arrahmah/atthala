<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTahsinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tahsins')) {
            Schema::create('tahsins', function (Blueprint $table) {
                $table->increments('id');
                $table->text('uuid_tahsin', 180);
                $table->text('no_tahsin', 180)->nullable();
                $table->text('nama_peserta', 180)->nullable();
                $table->text('nohp_peserta', 180)->nullable();
                $table->text('level_peserta', 180)->nullable();
                $table->text('nama_pengajar', 180)->nullable();
                $table->text('jadwal_tahsin', 180)->nullable();
                $table->text('sudah_daftar_tahsin', 180)->nullable();
                $table->text('belum_daftar_tahsin', 180)->nullable();
                $table->text('keterangan_tahsin', 180)->nullable();
                $table->text('pindahan_tahsin', 180)->nullable();
                $table->text('pindahan_tahsin_2', 180)->nullable();
                $table->text('jenis_peserta', 180)->nullable();
                $table->text('angkatan_peserta', 180)->nullable();
                $table->text('status_peserta', 180)->nullable();
                $table->text('status_pembayaran', 180)->nullable();
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
        Schema::dropIfExists('tahsins');
    }
}
