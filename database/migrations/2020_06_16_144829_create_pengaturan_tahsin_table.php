<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengaturanTahsinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan_tahsin', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nama_pengaturan', 180);
            $table->text('keterangan_pengaturan', 180)->nullable();
            $table->text('pilihan_pengaturan', 180)->nullable();
            $table->boolean('status_pengaturan');
            $table->text('user_pengaturan', 180);
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
        Schema::dropIfExists('pengaturan_tahsin');
    }
}