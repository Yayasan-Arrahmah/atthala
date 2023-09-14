<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Backend\Tahsin\AdministrasiController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\Tahsin\PembayaranController as PembayaranPeserta;


/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/tes-moota', function () {
    return 'tes ok';
});

Route::get('/peserta-tahsin', [HomeController::class, 'pesertaTahsin'])->name('pesertaTahsin');

Route::auto('/t', AdministrasiController::class);

//EKONOMI
Route::get('/ekonomi/sembako', [HomeController::class, 'sembako'])->name('sembako');
Route::post('/ekonomi/sembako/simpan', [HomeController::class, 'sembakosimpan'])->name('sembakosimpan');
Route::post('/ekonomi/sembako/data-pemesanan', [HomeController::class, 'sembakodata'])->name('sembakodata');

//PEMBAYARAN V2
Route::get('/pembayaran/moota', [PembayaranPeserta::class, 'moota'])->name('v2.pembayaran.moota');
Route::get('/pembayaran/spp/cari', [PembayaranPeserta::class, 'sppcari'])->name('v2.pembayaran.spp.cari');
Route::get('/pembayaran/spp/{uuid}', [PembayaranPeserta::class, 'spp'])->name('v2.pembayaran.spp');


/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        // User Dashboard Specific
        Route::get('dashboard',             [DashboardController::class, 'index'])->name('dashboard');

        // User Account Specific
        Route::get('account',               [AccountController::class, 'index'])->name('account');

        // User Profile Specific
        Route::patch('profile/update',      [ProfileController::class, 'update'])->name('profile.update');

        // User All
        Route::get('amal-yaumiah',          [DashboardController::class, 'amalyaumiah'])->name('amal-yaumiah');
        Route::get('amal-yaumiah/peserta',  [DashboardController::class, 'amalyaumiahpeserta'])->name('amal-yaumiah.peserta');

        // User Pengajar
        Route::get('absen/tahsin',                   [DashboardController::class, 'absentahsin'])->name('absentahsin');
        Route::get('absen/tahsin/kelas',             [DashboardController::class, 'absentahsinkelas'])->name('absentahsinkelas');
        Route::post('absen/tahsin/kelas/gantiabsen', [DashboardController::class, 'absentahsinkelasgantiabsen'])->name('absentahsinkelas.gantiabsen');
        Route::post('absen/tahsin/input',            [DashboardController::class, 'absentahsininput'])->name('absentahsininput');
        Route::post('absen/tahsin/inputlevel',       [DashboardController::class, 'absentahsininputlevel'])->name('absentahsininputlevel');
        Route::get('jadwal/tahsin',                  [DashboardController::class, 'jadwaltahsin'])->name('jadwaltahsin');

        Route::get('peserta/tahsin-baru',            [DashboardController::class, 'pesertatahsinbaru'])->name('pesertatahsinbaru');

        // Data Tahsin
        Route::get('tahsin/peserta',                  [DashboardController::class, 'tahsinpeserta'])->name('tahsinpeserta');
        Route::get('tahsin/peserta/kelas',            [DashboardController::class, 'tahsinpesertakelas'])->name('tahsinpesertakelas');

    });
});
