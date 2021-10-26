<?php

use Illuminate\Support\Facades\Route;
use Uasoft\Badaso\Middleware\ApiRequest;
use Uasoft\Badaso\Middleware\BadasoCheckPermissions;

$api_route_prefix = \config('badaso.api_route_prefix');

Route::group(['prefix' => $api_route_prefix, 'namespace' => 'Uasoft\Badaso\Module\Midtrans\Controllers', 'as' => 'badaso.', 'middleware' => [ApiRequest::class]], function () {
    Route::group(['prefix' => 'module/midtrans/v1'], function () {
        Route::group(['prefix' => 'payment'], function () {
            Route::get('/configuration', 'ConfigurationController@browseConfiguration')->middleware(BadasoCheckPermissions::class.':browse_midtrans_configurations');
            Route::post('/configuration/save/payment', 'ConfigurationController@savePaymentConfiguration')->middleware(BadasoCheckPermissions::class.':edit_midtrans_configurations');
            Route::post('/configuration/save/option', 'ConfigurationController@saveOptionConfiguration')->middleware(BadasoCheckPermissions::class.':edit_midtrans_configurations');
        });

        Route::group(['prefix' => 'snap'], function () {
            Route::get('/configuration', 'SnapController@getConfig');
            Route::post('/get', 'SnapController@getSnapToken');
        });

        Route::post('notification', 'MidtransController@__invoke');
    });
});
