<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('rtqs')) {
            Schema::create('rtqs', function (Blueprint $table) {
                $table->increments('id');
                $table->text('nis_santri', 20);
                $table->text('nama_santri', 180);
                $table->text('foto_santri', 180)->nullable();
                $table->text('notelp_santri', 180)->nullable();
                $table->text('jenis_santri', 180)->nullable();
                $table->text('status_santri', 180)->nullable();
                $table->text('tempat_lahir', 180)->nullable();
                $table->text('tanggal_lahir', 180)->nullable();
                $table->text('alamat', 180)->nullable();
                $table->text('nama_ayah', 180)->nullable();
                $table->text('pekerjaan_ayah', 180)->nullable();
                $table->text('penghasilan_ayah', 180)->nullable();
                $table->text('nama_ibu', 180)->nullable();
                $table->text('pekerjaan_ibu', 180)->nullable();
                $table->text('penghasilan_ibu', 180)->nullable();
                $table->text('alamat_orangtua', 180)->nullable();
                $table->text('tanggal_masuk', 100)->nullable();
                $table->text('jumlah_hafalan', 100)->nullable();
                $table->text('pengalaman_pesantren', 180)->nullable();
                $table->text('riwayat_pendidikan', 180)->nullable();
                $table->text('spp_disanggupi', 180)->nullable();
                $table->text('angkatan_santri', 10)->nullable();
                $table->text('pengajar_santri', 180)->nullable();
                $table->text('domisili', 180)->nullable();
                $table->text('kriteria', 100)->nullable();
                $table->text('keterangan', 100)->nullable();
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
        Schema::dropIfExists('rtqs');
    }
}
