<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);
Route::get('thank-you-page', function(){
    return 'Terima Kasih';
});
Route::get('cancel-page', function(){
    return 'Pembayaran DIbatalkan';
});
Route::get('callback-url', function(){
    return 'Pembayaran Selesai';
});
Route::get('pembayaran', function(){
    // SAMPLE HIT API iPaymu v2 PHP //

        $va           = '0000008125144744'; //get on iPaymu dashboard
        $apiKey       = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; //get on iPaymu dashboard

        $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; // for development mode
        // $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode

        $method       = 'POST'; //method

        //Request Body//
        $body['product']    = array('Pembayaran SPP Peserta Tahsin Angkatan 25');
        $body['qty']        = array('1');
        $body['price']      = array('100000');
        $body['returnUrl']  = 'https://atthala.arrahmahbalikpapan.or.id/thank-you-page';
        $body['cancelUrl']  = 'https://atthala.arrahmahbalikpapan.or.id/cancel-page';
        $body['notifyUrl']  = 'https://atthala.arrahmahbalikpapan.or.id/callback-url';
        $body['referenceId'] = '1234'; //your reference id
        //End Request Body//

        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $apiKey);
        $timestamp    = Date('YmdHis');
        //End Generate Signature


        $ch = curl_init($url);

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);

        if($err) {
            return response()->json($err);
        } else {

            //Response
            $ret = json_decode($ret);
            if($ret->Status == 200) {
                $sessionId  = $ret->Data->SessionID;
                $url        =  $ret->Data->Url;
                header('Location:' . $url);
            } else {
                return response()->json($ret);
            }
            //End Response
        }
});

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
