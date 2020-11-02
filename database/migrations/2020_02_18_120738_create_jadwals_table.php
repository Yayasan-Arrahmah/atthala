<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('jadwals')) {
            Schema::create('jadwals', function (Blueprint $table) {
                $table->increments('id');
                $table->uuid('uuid_jadwal');
                $table->text('pengajar_jadwal', 30);
                $table->text('level_jadwal', 80);
                $table->text('hari_jadwal', 80);
                $table->text('waktu_jadwal', 80);
                $table->text('jenis_jadwal', 10);
                $table->text('angkatan_jadwal', 10);
                $table->integer('jumlah_peserta')->default(0);
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
        Schema::dropIfExists('jadwals');
    }
}
