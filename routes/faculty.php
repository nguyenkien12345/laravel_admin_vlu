<?php

use App\Http\Controllers\FacultyController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'faculties.',
    'prefix' => 'faculties',
], function () {
    Route::post('/add', [FacultyController::class, 'add'])->name('add');
});
