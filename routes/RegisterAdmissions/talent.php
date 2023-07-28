<?php

use App\Http\Controllers\RegisterAdmission\TalentController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'register-admissions-talent.',
    'prefix' => 'register-admissions-talent',
], function () {
    Route::get('/upload-image', [TalentController::class, 'uploadImage'])->name('upload-image');
});
