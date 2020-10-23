<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pengajars')) {
            Schema::create('pengajars', function (Blueprint $table) {
                $table->increments('id');
                $table->text('id_pengajar', 100)->nullable();
                $table->text('nama_pengajar', 80);
                $table->text('namasingkat_pengajar', 40)->nullable();
                $table->text('nohp_pengajar', 80)->nullable();
                $table->text('status_pengajar', 80)->nullable();
                $table->text('tempat_lahir_pengajar', 180)->nullable();
                $table->text('waktu_lahir_pengajar', 80)->nullable();
                $table->text('jenis_pengajar', 10)->nullable();
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
        Schema::dropIfExists('pengajars');
    }
}
