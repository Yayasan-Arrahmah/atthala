<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use Utils\Twilio;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/wa', function () {
    $from = 'whatsapp:+14155238886';
    $to   = 'whatsapp:+628125144744';
    $body = 'Service Tinggal beberapa hari lagi!';
    $twilio = new Twilio;
    try {
        return $twilio->sendSMS($from, $body, $to);
    } catch (\Throwable $th) {
        dd($th);
    }
});

Route::get('/tes-moota', function () {
    return 'tes';
});

Route::get('/peserta-tahsin', [HomeController::class, 'pesertaTahsin'])->name('pesertaTahsin');

//EKONOMI
Route::get('/ekonomi/sembako', [HomeController::class, 'sembako'])->name('sembako');
Route::post('/ekonomi/sembako/simpan', [HomeController::class, 'sembakosimpan'])->name('sembakosimpan');
Route::post('/ekonomi/sembako/data-pemesanan', [HomeController::class, 'sembakodata'])->name('sembakodata');


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
        Route::get('jadwal/tahsin',                  [DashboardController::class, 'jadwaltahsin'])->name('jadwaltahsin');

        Route::get('peserta/tahsin-baru',                  [DashboardController::class, 'pesertatahsinbaru'])->name('pesertatahsinbaru');

    });
});
