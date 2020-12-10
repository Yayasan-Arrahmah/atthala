<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtqKategoriPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtq_kategori_penilaians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama_kategori', 180);
            $table->text('keterangan_kategori')->nullable();
            $table->text('status_kategori', 180)->nullable();
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
        Schema::dropIfExists('rtq_kategori_penilaians');
    }
}
