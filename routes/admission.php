<?php

use App\Http\Controllers\AdmissionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'admissions.',
    'prefix' => 'admissions',
], function () {
    Route::get('/', [AdmissionController::class, 'all'])->name('all');
    Route::get('/detail/{id}', [AdmissionController::class, 'detail'])->name('detail');

    Route::get('/add', [AdmissionController::class, 'add'])->name('add');
    Route::post('/store', [AdmissionController::class, 'store'])->name('store');
});
