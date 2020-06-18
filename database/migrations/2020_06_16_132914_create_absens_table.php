<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('absens')) {
            Schema::create('absens', function (Blueprint $table) {
                $table->increments('id');
                $table->text('id_peserta', 80);
                $table->text('user_create_absen', 180)->nullable();
                $table->text('pertemuan_ke_absen', 180)->nullable();
                $table->text('keterangan_absen', 180)->nullable();
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
        Schema::dropIfExists('absens');
    }
}