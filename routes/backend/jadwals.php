<?php

use App\Http\Controllers\Backend\JadwalController;

use App\Models\Jadwal;

Route::bind('jadwal', function ($value) {
	$jadwal = new Jadwal;

	return Jadwal::withTrashed()->where($jadwal->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'jadwal'], function () {
	Route::get(	'', 		[JadwalController::class, 'index']		)->name('jadwals.index');
    Route::get(	'create', 	[JadwalController::class, 'create']	)->name('jadwals.create');
	Route::post('store', 	[JadwalController::class, 'store']		)->name('jadwals.store');
    Route::get(	'deleted', 	[JadwalController::class, 'deleted']	)->name('jadwals.deleted');
    Route::get(	'upload', 	[JadwalController::class, 'upload']	)->name('jadwals.upload');
    Route::post(	'import', 	[JadwalController::class, 'import']	)->name('jadwals.import');
});

Route::group(['prefix' => 'jadwal/{jadwal}'], function () {
	// Jadwal
	Route::get('/', [JadwalController::class, 'show'])->name('jadwals.show');
	Route::get('edit', [JadwalController::class, 'edit'])->name('jadwals.edit');
	Route::patch('update', [JadwalController::class, 'update'])->name('jadwals.update');
	Route::delete('destroy', [JadwalController::class, 'destroy'])->name('jadwals.destroy');
	// Deleted
	Route::get('restore', [JadwalController::class, 'restore'])->name('jadwals.restore');
	Route::get('delete', [JadwalController::class, 'delete'])->name('jadwals.delete-permanently');
});
