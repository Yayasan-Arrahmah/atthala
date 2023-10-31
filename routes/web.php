<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    include_route_files(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
    include_route_files(__DIR__.'/backend/');

    Route::auto('/tahsin/peserta', App\Http\Controllers\Backend\Tahsin\AdministrasiController::class);
    // Route::auto('/tahsin/pengajar', App\Http\Controllers\Backend\Tahsin\PengajarController::class);
    Route::auto('/tahsin/jadwal', App\Http\Controllers\Backend\Tahsin\JadwalController::class);
    Route::auto('/tahsin/pembayaran', App\Http\Controllers\Backend\Tahsin\PembayaranController::class);
    Route::auto('/tahsin/pengaturan', App\Http\Controllers\Backend\Tahsin\PengaturanController::class);
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
