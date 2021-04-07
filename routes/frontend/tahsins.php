<?php

use App\Http\Controllers\Frontend\TahsinController;
use App\Models\Tahsin;

Route::bind('tahsin', function ($value) {
    $tahsin = new Tahsin;

    return Tahsin::withTrashed()->where($tahsin->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'tahsin'], function () {
    Route::get('',                                               [TahsinController::class, 'index'])->name('tahsin.index');
    Route::post('uploadktp',                                     [TahsinController::class, 'uploadktp'])->name('tahsin.uploadktp');
    Route::post('uploadrekaman',                                 [TahsinController::class, 'uploadrekaman'])->name('tahsin.uploadrekaman');
    Route::post('uploadbuktitransfer',                           [TahsinController::class, 'uploadbuktitransfer'])->name('tahsin.uploadbuktitransfer');
    Route::post('simpan',                                        [TahsinController::class, 'simpan'])->name('tahsin.simpan');
    Route::get('pendaftaran',                                    [TahsinController::class, 'pendaftaran'])->name('tahsin.pendaftaran');
    Route::get('selesai',                                        [TahsinController::class, 'selesai'])->name('tahsin.selesai');
    Route::get('pdf',                                            [TahsinController::class, 'pdf'])->name('tahsin.print.daftar');
    Route::get('calon-peserta-ujian/daftar',                     [TahsinController::class, 'calonpesertaujian'])->name('tahsin.calonpesertaujian');
    Route::post('calon-peserta-ujian/simpan',                    [TahsinController::class, 'simpancalonpesertaujian'])->name('tahsin.simpancalonpesertaujian');
    Route::get('calon-peserta-ujian/cari',                       [TahsinController::class, 'caricalonpesertaujian'])->name('tahsin.caricalonpesertaujian');
    Route::post('calon-peserta-ujian/uploadbuktitransfer',       [TahsinController::class, 'uploadbuktitransferpesertaujian'])->name('tahsin.uploadbuktitransferpesertaujian');
    Route::get('calon-peserta-ujian/print',                      [TahsinController::class, 'printcalonpesertaujian'])->name('tahsin.printcalonpesertaujian');
    Route::get('daftar-ulang-peserta-2021/cari',                 [TahsinController::class, 'caridaftarulangpeserta'])->name('tahsin.caridaftarulangpeserta');
    Route::get('daftar-ulang-peserta-2021/daftar',               [TahsinController::class, 'daftarulangpeserta'])->name('tahsin.daftarulangpeserta');
    Route::get('daftar-ulang-peserta-2021/daftar/datawaktu',     [TahsinController::class, 'daftarulangpesertadatawaktu'])->name('tahsin.daftarulangpesertadatawaktu');
    Route::get('daftar-ulang-peserta-2021/print',                [TahsinController::class, 'printdaftarulangpeserta'])->name('tahsin.printdaftarulangpeserta');
    Route::post('daftar-ulang-peserta-2021/simpan',              [TahsinController::class, 'simpandaftarulangpeserta'])->name('tahsin.simpandaftarulangpeserta');
    Route::get('pendaftaran/peserta',                            [TahsinController::class, 'daftarcalonpeserta'])->name('tahsin.daftarcalonpeserta');
    Route::get('pendaftaran/peserta/waktu',                      [TahsinController::class, 'daftarcalonpesertawaktu'])->name('tahsin.daftarcalonpesertawaktu');
    Route::post('pendaftaran/simpan',                            [TahsinController::class, 'simpandaftarcalonpeserta'])->name('tahsin.simpandaftarcalonpeserta');
    Route::get('pendaftaran/print',                              [TahsinController::class, 'printdaftarpeserta'])->name('tahsin.printdaftarpeserta');


    // Route::post('store', 	[TahsinController::class, 'store']		)->name('tahsins.store');
    // Route::get(	'deleted', 	[TahsinController::class, 'deleted']	)->name('tahsins.deleted');
});

Route::group(['prefix' => 'tahsin/{tahsin}'], function () {
    // // Tahsin
    // Route::get('/', [TahsinController::class, 'show'])->name('tahsins.show');
    // Route::get('edit', [TahsinController::class, 'edit'])->name('tahsins.edit');
    // Route::patch('update', [TahsinController::class, 'update'])->name('tahsins.update');
    // Route::delete('destroy', [TahsinController::class, 'destroy'])->name('tahsins.destroy');
    // // Deleted
    // Route::get('restore', [TahsinController::class, 'restore'])->name('tahsins.restore');
    // Route::get('delete', [TahsinController::class, 'delete'])->name('tahsins.delete-permanently');
});
