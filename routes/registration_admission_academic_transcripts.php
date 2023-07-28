<?php

use App\Http\Controllers\RegistrationAdmissionAcademicTranscriptsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'registration-admission-academic-transcripts.',
    'prefix' => 'registration-admission-academic-transcripts',
], function () {
    Route::get('/', [RegistrationAdmissionAcademicTranscriptsController::class, 'index']);
    Route::get('/preview_info_register_academic_transcripts', [RegistrationAdmissionAcademicTranscriptsController::class, 'previewInfoRegisterAcademicTranscripts']);
});
