<?php

use App\Http\Controllers\Frontend\AmalanController;

use App\Models\Amalan;

Route::bind('amalan', function ($value) {
	$amalan = new Amalan;

	return Amalan::withTrashed()->where($amalan->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'amalans'], function () {
	Route::get(	'', 		[AmalanController::class, 'index']		)->name('amalans.index');
    Route::get(	'create', 	[AmalanController::class, 'create']	)->name('amalans.create');
	Route::post('store', 	[AmalanController::class, 'store']		)->name('amalans.store');
	Route::post('tambahabsen', 	[AmalanController::class, 'tambahabsen']		)->name('amalans.tambahabsen');
	Route::post('hapusabsen', 	[AmalanController::class, 'hapusabsen']		)->name('amalans.hapusabsen');
    Route::get(	'deleted', 	[AmalanController::class, 'deleted']	)->name('amalans.deleted');
});

Route::group(['prefix' => 'amalans/{amalan}'], function () {
	// Amalan
	Route::get('/', [AmalanController::class, 'show'])->name('amalans.show');
	Route::get('edit', [AmalanController::class, 'edit'])->name('amalans.edit');
	Route::patch('update', [AmalanController::class, 'update'])->name('amalans.update');
	Route::delete('destroy', [AmalanController::class, 'destroy'])->name('amalans.destroy');
	// Deleted
	Route::get('restore', [AmalanController::class, 'restore'])->name('amalans.restore');
	Route::get('delete', [AmalanController::class, 'delete'])->name('amalans.delete-permanently');
});
