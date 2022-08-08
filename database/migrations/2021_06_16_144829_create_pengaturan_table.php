<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengaturanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_pengaturan'); // TAHSIN - TLA - RTQ
            $table->string('kode_pengaturan');
            $table->string('nama_pengaturan');
            $table->integer('status_pengaturan'); // 1 DIBUKA - 2 DITUTUP - 3 PERBAIKAN
            $table->integer('angkatan_pengaturan'); // ANGKATAN
            $table->string('fungsi_pengaturan')->nullable(); // PESERTA - PENGAJAR - ADMIN
            $table->string('link_pengaturan')->nullable();
            $table->text('keterangan_pengaturan')->nullable();
            $table->text('user_pengaturan')->nullable();
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
        Schema::dropIfExists('pengaturan');
    }
}
