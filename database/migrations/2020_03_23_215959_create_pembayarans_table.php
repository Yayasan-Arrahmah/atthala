<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pembayarans')) {
            Schema::create('pembayarans', function (Blueprint $table) {
                $table->increments('id');
                $table->text('id_peserta', 20);
                $table->integer('nominal_pembayaran');
                $table->text('keterangan_pembayaran')->nullable();
                $table->text('jenis_pembayaran', 100);
                $table->text('bukti_transfer_pembayaran')->nullable();
                $table->text('admin_pembayaran', 100);
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
        Schema::dropIfExists('pembayarans');
    }
}