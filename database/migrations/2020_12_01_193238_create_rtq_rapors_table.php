<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtqRaporsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtq_rapors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->integer('id_periode_rapor');
            $table->integer('id_santri');
            $table->text('hafalan_santri', 100)->nullable();
            $table->text('level_tahsin_santri', 100)->nullable();
            $table->text('jumlah_hari_sakit', 10)->nullable();
            $table->text('jumlah_hari_izin', 10)->nullable();
            $table->text('jumlah_hari_tanpa_ket', 10)->nullable();
            $table->text('catatan_pembimbing_santri')->nullable();
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
        Schema::dropIfExists('rtq_rapors');
    }
}
