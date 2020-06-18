<?php

use App\Http\Controllers\Backend\AbsenController;

use App\Models\Absen;

Route::bind('absen', function ($value) {
	$absen = new Absen;

	return Absen::withTrashed()->where($absen->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'absens'], function () {
	Route::get(	'', 		[AbsenController::class, 'index']		)->name('absens.index');
    Route::get(	'create', 	[AbsenController::class, 'create']	)->name('absens.create');
	Route::post('store', 	[AbsenController::class, 'store']		)->name('absens.store');
    Route::get(	'deleted', 	[AbsenController::class, 'deleted']	)->name('absens.deleted');
});

Route::group(['prefix' => 'absens/{absen}'], function () {
	// Absen
	Route::get('/', [AbsenController::class, 'show'])->name('absens.show');
	Route::get('edit', [AbsenController::class, 'edit'])->name('absens.edit');
	Route::patch('update', [AbsenController::class, 'update'])->name('absens.update');
	Route::delete('destroy', [AbsenController::class, 'destroy'])->name('absens.destroy');
	// Deleted
	Route::get('restore', [AbsenController::class, 'restore'])->name('absens.restore');
	Route::get('delete', [AbsenController::class, 'delete'])->name('absens.delete-permanently');
});