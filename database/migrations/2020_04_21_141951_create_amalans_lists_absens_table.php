<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmalansListsAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amalans_lists_absens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_amalan_list');
            $table->text('user_amalan_list');
            $table->text('waktu_hijriyah_amalan_list')->nullable();
            $table->text('tanggal_hijriyah_amalan_list')->nullable();
            $table->text('ket_hijriyah_amalan_list')->nullable();
            $table->text('waktu_amalan_list')->nullable();
            $table->text('tanggal_amalan_list')->nullable();
            $table->text('ket_amalan_list')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('amalans_lists_absens');
    }
}
