<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'addresses.',
    'prefix' => 'addresses',
], function () {
    Route::get('/provinces', [AddressController::class, 'getAllProvince'])->name('provinces');
    Route::get('/districts/{province_id}', [AddressController::class, 'getDistrictByProvinceId'])->name('districts');
    Route::get('/wards/{district_id}', [AddressController::class, 'getWardByDistrictId'])->name('wards');
});
