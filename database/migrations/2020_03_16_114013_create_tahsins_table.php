<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTahsinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tahsins')) {
            Schema::create('tahsins', function (Blueprint $table) {
                $table->increments('id');

                $table->uuid('uuid');
                // ALTER TABLE `tahsins` ADD `uuid` VARCHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `id`;
                $table->text('no_tahsin', 180)->nullable();
                $table->text('nama_peserta', 180)->nullable();
                $table->text('nohp_peserta', 180)->nullable();
                $table->text('level_peserta', 180)->nullable();
                $table->text('nama_pengajar', 180)->nullable();
                $table->text('jadwal_tahsin', 180)->nullable();
                $table->text('sudah_daftar_tahsin', 180)->nullable();
                $table->text('belum_daftar_tahsin', 180)->nullable();
                $table->text('keterangan_tahsin', 180)->nullable();
                $table->text('pindahan_tahsin', 180)->nullable();
                $table->text('pindahan_tahsin_2', 180)->nullable();
                $table->text('jenis_peserta', 180)->nullable();
                $table->text('angkatan_peserta', 180)->nullable();
                $table->text('pilih_jadwal_peserta', 180)->nullable();
                $table->text('pilih_jadwal_cadangan_1_peserta', 180)->nullable();
                $table->text('pilih_jadwal_cadangan_2_peserta', 180)->nullable();
                $table->text('alamat_peserta', 180)->nullable();
                $table->text('pekerjaan_peserta', 180)->nullable();
                $table->text('tempat_lahir_peserta', 180)->nullable();
                $table->text('waktu_lahir_peserta', 180)->nullable();
                $table->text('fotoktp_peserta', 180)->nullable();
                $table->text('rekaman_peserta', 180)->nullable();
                $table->text('status_peserta', 180)->nullable();
                $table->string('jenis_pembelajaran', 180)->nullable()->default('OFFLINE');
                $table->text('status_pembayaran', 180)->nullable();
                $table->text('status_kelulusan', 180)->nullable();
                $table->string('status_keaktifan', 180)->nullable()->default('AKTIF');
                $table->text('kenaikan_level_peserta', 180)->nullable();

                $table->integer('notif_daftar_ulang', 3)->nullable();
                // ALTER TABLE `tahsins` ADD `notif_daftar_ulang` SMALLINT NULL DEFAULT NULL AFTER `status_keaktifan`;

                $table->integer('notif_pilih_jadwal', 3)->nullable();
                // ALTER TABLE `tahsins` ADD `notif_pilih_jadwal` SMALLINT NULL DEFAULT NULL AFTER `status_keaktifan`;

                $table->string('kode_unik', 10)->nullable();
                // ALTER TABLE `tahsins` ADD `kode_unik` VARCHAR(5) NULL DEFAULT NULL AFTER `no_tahsin`;

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
        Schema::dropIfExists('tahsins');
    }


    //UPDATE NAMA PENGAJAR
    // UPDATE `tahsins` SET `nama_pengajar` = REPLACE(`nama_pengajar`,'UST.','USTADZ') WHERE `nama_pengajar` LIKE '%UST.%';
    // UPDATE `tahsins` SET `nama_pengajar` = CONCAT('USTADZAH ',`nama_pengajar`) WHERE `nama_pengajar` NOT LIKE '%USTADZ%';


    // UPDATE `users` SET `user_pengajar` = REPLACE(`user_pengajar`,'UST.','USTADZ') WHERE `user_pengajar` LIKE '%UST.%';
    // UPDATE `users` SET `user_pengajar` = CONCAT('USTADZAH ',`user_pengajar`) WHERE `user_pengajar` NOT LIKE '%USTADZ%' AND `user_pengajar` IS NOT NULL;

    // UPDATE `jadwals` SET `pengajar_jadwal` = REPLACE(`pengajar_jadwal`,'UST.','USTADZ') WHERE `pengajar_jadwal` LIKE '%UST.%';
    // UPDATE `jadwals` SET `pengajar_jadwal` = CONCAT('USTADZAH ',`pengajar_jadwal`) WHERE `pengajar_jadwal` NOT LIKE '%USTADZ%';


    //UPDATE KODE UNIK
    // ALTER TABLE `tahsins` ADD `kode_unik` VARCHAR(5) NULL DEFAULT NULL AFTER `no_tahsin`;


    //data DELETE
    // DELETE FROM `tahsins` WHERE `tahsins`.`id` = 8032;
    // DELETE FROM `tahsins` WHERE `tahsins`.`id` = 8229;
    // DELETE FROM `tahsins` WHERE `tahsins`.`id` = 8281;
    // DELETE FROM `tahsins` WHERE `tahsins`.`id` = 8335;
    // DELETE FROM `tahsins` WHERE `tahsins`.`id` = 8378;
    // DELETE FROM `tahsins` WHERE `tahsins`.`id` = 8393;
    // DELETE FROM `tahsins` WHERE `tahsins`.`id` = 8454;
    // DELETE FROM `tahsins` WHERE `tahsins`.`id` = 8508;
}
