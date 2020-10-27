<?php

use App\Http\Controllers\Backend\TahsinController;

use App\Models\Tahsin;

Route::bind('tahsin', function ($value) {
    $tahsin = new Tahsin;

    return Tahsin::withTrashed()->where($tahsin->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'tahsin'], function () {
    Route::get('',                      [TahsinController::class, 'index'])->name('tahsins.index');
    Route::get('create',                [TahsinController::class, 'create'])->name('tahsins.create');
    Route::post('store',                [TahsinController::class, 'store'])->name('tahsins.store');
    Route::get('deleted',               [TahsinController::class, 'deleted'])->name('tahsins.deleted');
    Route::get('upload',                [TahsinController::class, 'upload'])->name('tahsins.upload');
    Route::post('import',               [TahsinController::class, 'import'])->name('tahsins.import');
    Route::post('importPembayaran',     [TahsinController::class, 'importPembayaran'])->name('tahsins.importPembayaran');
    Route::post('updatelevel',          [TahsinController::class, 'updatelevel'])->name('tahsins.updatelevel');
    Route::get('jadwal',                [TahsinController::class, 'jadwal'])->name('tahsins.jadwal');
    Route::get('pengajar',              [TahsinController::class, 'pengajar'])->name('tahsins.pengajar');
    Route::get('pembayaran',            [TahsinController::class, 'pembayaran'])->name('tahsins.pembayaran');
    Route::post('createbayar',          [TahsinController::class, 'createbayar'])->name('tahsins.createbayar');
    Route::get('absen',                 [TahsinController::class, 'absen'])->name('tahsins.absen');
    Route::get('absen/kelas',           [TahsinController::class, 'absenkelas'])->name('tahsins.absenkelas');
    Route::get('pengaturan',            [TahsinController::class, 'pengaturan'])->name('tahsins.pengaturan');
    Route::get('ujian',                 [TahsinController::class, 'ujian'])->name('tahsins.ujian');
    Route::get('ujian/daftar-ulang',    [TahsinController::class, 'daftarpesertaujian'])->name('tahsins.ujian.daftarulang');
});

Route::group(['prefix' => 'tahsins/{tahsin}'], function () {
    // Tahsin
    Route::get('/', [TahsinController::class, 'show'])->name('tahsins.show');
    Route::get('edit', [TahsinController::class, 'edit'])->name('tahsins.edit');
    Route::patch('update', [TahsinController::class, 'update'])->name('tahsins.update');
    Route::delete('destroy', [TahsinController::class, 'destroy'])->name('tahsins.destroy');
    // Deleted
    Route::get('restore', [TahsinController::class, 'restore'])->name('tahsins.restore');
    Route::get('delete', [TahsinController::class, 'delete'])->name('tahsins.delete-permanently');
});
