<?php

use App\Http\Controllers\Backend\PengaturanTahsinController;

use App\Models\PengaturanTahsin;

Route::bind('pengaturan-tahsin', function ($value) {
	$pengaturantahsin = new PengaturanTahsin;

	return PengaturanTahsin::withTrashed()->where($pengaturantahsin->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'pengaturan-tahsin'], function () {
	Route::get(	'', 		[PengaturanTahsinController::class, 'index']	)->name('pengaturan-tahsin.index');
    Route::get(	'create', 	[PengaturanTahsinController::class, 'create']	)->name('pengaturan-tahsin.create');
	Route::post('store', 	[PengaturanTahsinController::class, 'store']	)->name('pengaturan-tahsin.store');
    Route::get(	'deleted', 	[PengaturanTahsinController::class, 'deleted']	)->name('pengaturan-tahsin.deleted');
});

// Route::group(['prefix' => 'pengaturan-tahsin/{absen}'], function () {
// 	// Absen
// 	Route::get('/', [PengaturanTahsinController::class, 'show'])->name('pengaturan-tahsin.show');
// 	Route::get('edit', [PengaturanTahsinController::class, 'edit'])->name('pengaturan-tahsin.edit');
// 	Route::patch('update', [PengaturanTahsinController::class, 'update'])->name('pengaturan-tahsin.update');
// 	Route::delete('destroy', [PengaturanTahsinController::class, 'destroy'])->name('pengaturan-tahsin.destroy');
// 	// Deleted
// 	Route::get('restore', [PengaturanTahsinController::class, 'restore'])->name('pengaturan-tahsin.restore');
// 	Route::get('delete', [PengaturanTahsinController::class, 'delete'])->name('pengaturan-tahsin.delete-permanently');
// });