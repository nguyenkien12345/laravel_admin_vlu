<?php

use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'programs.',
    'prefix' => 'programs',
], function () {
    Route::post('/add', [ProgramController::class, 'add'])->name('add');
});
