<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('amalans')) {
            Schema::create('amalans', function (Blueprint $table) {
                $table->increments('id');
                $table->text('nama_amalan')->nullable();
                $table->text('deskripsi_amalan')->nullable();
                $table->text('waktu_amalan')->nullable();
                $table->text('user_create_amalan');
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
        Schema::dropIfExists('amalans');
    }
}
