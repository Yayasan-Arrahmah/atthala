<?php

use App\Http\Controllers\Backend\PembayaranController;

use App\Models\Pembayaran;

Route::bind('pembayaran', function ($value) {
	$pembayaran = new Pembayaran;

	return Pembayaran::withTrashed()->where($pembayaran->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'pembayarans'], function () {
	Route::get(	'', 		[PembayaranController::class, 'index']		)->name('pembayarans.index');
    Route::get(	'create', 	[PembayaranController::class, 'create']	)->name('pembayarans.create');
	Route::post('store', 	[PembayaranController::class, 'store']		)->name('pembayarans.store');
    Route::get(	'deleted', 	[PembayaranController::class, 'deleted']	)->name('pembayarans.deleted');
});

Route::group(['prefix' => 'pembayarans/{pembayaran}'], function () {
	// Pembayaran
	Route::get('/', [PembayaranController::class, 'show'])->name('pembayarans.show');
	Route::get('edit', [PembayaranController::class, 'edit'])->name('pembayarans.edit');
	Route::patch('update', [PembayaranController::class, 'update'])->name('pembayarans.update');
	Route::delete('destroy', [PembayaranController::class, 'destroy'])->name('pembayarans.destroy');
	// Deleted
	Route::get('restore', [PembayaranController::class, 'restore'])->name('pembayarans.restore');
	Route::get('delete', [PembayaranController::class, 'delete'])->name('pembayarans.delete-permanently');
});