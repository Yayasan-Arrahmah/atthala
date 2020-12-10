<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtqPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtq_penilaians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_rapor');
            $table->integer('id_santri');
            $table->integer('id_sub_kategori');
            $table->text('nilai_santri', 10)->nullable();
            $table->text('keterangan_nilai_santri')->nullable();
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
        Schema::dropIfExists('rtq_penilaians');
    }
}
