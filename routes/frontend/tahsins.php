<?php

use App\Http\Controllers\Frontend\TahsinController;
use App\Models\Tahsin;

Route::bind('tahsin', function ($value) {
    $tahsin = new Tahsin;

    return Tahsin::withTrashed()->where($tahsin->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'tahsin'], function () {
    Route::get('',                     [TahsinController::class, 'index'])->name('tahsin.index');
    Route::post('uploadktp',           [TahsinController::class, 'uploadktp'])->name('tahsin.uploadktp');
    Route::post('uploadrekaman',       [TahsinController::class, 'uploadrekaman'])->name('tahsin.uploadrekaman');
    Route::post('uploadbuktitransfer', [TahsinController::class, 'uploadbuktitransfer'])->name('tahsin.uploadbuktitransfer');
    Route::post('simpan',              [TahsinController::class, 'simpan'])->name('tahsin.simpan');
    Route::get('pendaftaran',          [TahsinController::class, 'pendaftaran'])->name('tahsin.pendaftaran');
    Route::get('selesai',              [TahsinController::class, 'selesai'])->name('tahsin.selesai');
    Route::get('pdf',                  [TahsinController::class, 'pdf'])->name('tahsin.print.daftar');
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