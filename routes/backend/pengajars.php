<?php

use App\Http\Controllers\Backend\PengajarController;

use App\Models\Pengajar;

Route::bind('pengajar', function ($value) {
	$pengajar = new Pengajar;

	return Pengajar::withTrashed()->where($pengajar->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'pengajar'], function () {
	Route::get(	'', 		[PengajarController::class, 'index']		)->name('pengajars.index');
    Route::get(	'create', 	[PengajarController::class, 'create']	)->name('pengajars.create');
	Route::post('store', 	[PengajarController::class, 'store']		)->name('pengajars.store');
    Route::get(	'deleted', 	[PengajarController::class, 'deleted']	)->name('pengajars.deleted');
});

Route::group(['prefix' => 'pengajar/{pengajar}'], function () {
	// Pengajar
	Route::get('/', [PengajarController::class, 'show'])->name('pengajars.show');
	Route::get('edit', [PengajarController::class, 'edit'])->name('pengajars.edit');
	Route::patch('update', [PengajarController::class, 'update'])->name('pengajars.update');
	Route::delete('destroy', [PengajarController::class, 'destroy'])->name('pengajars.destroy');
	// Deleted
	Route::get('restore', [PengajarController::class, 'restore'])->name('pengajars.restore');
	Route::get('delete', [PengajarController::class, 'delete'])->name('pengajars.delete-permanently');
});
