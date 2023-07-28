<?php

use App\Http\Controllers\SearchProfilesController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'search-profiles.',
    'prefix' => 'search-profiles',
], function () {
    Route::get('/', [SearchProfilesController::class, 'searchProfiles'])->name('index');
    Route::post('/search', [SearchProfilesController::class, 'submitSearch'])->name('search');

    Route::get('/preview-info-register', [SearchProfilesController::class, 'previewInfoRegister'])->name('preview-info-register');
    Route::get('/download-pdf', [SearchProfilesController::class, 'downloadPDF'])->name('download-pdf');
});
