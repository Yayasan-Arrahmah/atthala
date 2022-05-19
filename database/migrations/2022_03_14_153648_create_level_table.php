<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_level'); // TAHSIN - TLA - RTQ
            $table->string('kode_level')->nullable();
            $table->string('nama_level');
            $table->text('keterangan_level')->nullable();
            $table->text('sort_level')->nullable();
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
        Schema::dropIfExists('level');
    }
}
