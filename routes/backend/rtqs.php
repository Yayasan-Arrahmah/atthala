<?php

use App\Http\Controllers\Backend\RtqController;
use App\Http\Controllers\Backend\RtqRaporController;

use App\Models\Rtq;

Route::bind('rtq', function ($value) {
	$rtq = new Rtq;

	return Rtq::withTrashed()->where($rtq->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'rtq'], function () {
	Route::get(	'', 		[RtqController::class, 'index']		)->name('rtqs.index');
    Route::get(	'create', 	[RtqController::class, 'create']	)->name('rtqs.create');
	Route::post('store', 	[RtqController::class, 'store']		)->name('rtqs.store');
    Route::get(	'deleted', 	[RtqController::class, 'deleted']	)->name('rtqs.deleted');
	Route::post('upload', 	[RtqController::class, 'upload']	)->name('rtqs.upload');


    // Nilai & Rapor
    Route::get('prosesrapor', 	        [RtqRaporController::class, 'prosesrapor']	        )->name('rtqs.prosesrapor');
    Route::get('rapor', 	            [RtqRaporController::class, 'rapor']	            )->name('rtqs.rapor');
    Route::post('rapor/update', 	    [RtqRaporController::class, 'raporupdate']	        )->name('rtqs.raporupdate');
    Route::get('rapor/nilai', 	        [RtqRaporController::class, 'rapornilai']	        )->name('rtqs.rapornilai');
    Route::get('rapor/cetak', 	        [RtqRaporController::class, 'raporcetak']	        )->name('rtqs.raporcetak');

    Route::get('nilai-pelajaran', 	    [RtqRaporController::class, 'nilaipelajaran']	    )->name('rtqs.nilaipelajaran');

});

Route::group(['prefix' => 'rtq/{rtq}'], function () {
	// Rtq
	Route::get('/', [RtqController::class, 'show'])->name('rtqs.show');
	Route::get('edit', [RtqController::class, 'edit'])->name('rtqs.edit');
	Route::patch('update', [RtqController::class, 'update'])->name('rtqs.update');
	Route::delete('destroy', [RtqController::class, 'destroy'])->name('rtqs.destroy');
	// Deleted
	Route::get('restore', [RtqController::class, 'restore'])->name('rtqs.restore');
	Route::get('delete', [RtqController::class, 'delete'])->name('rtqs.delete-permanently');
});
