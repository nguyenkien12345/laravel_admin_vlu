<?php

use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'faqs.',
    'prefix' => 'faqs',
], function () {
    Route::get('/', [FaqController::class, 'index'])->name('index');
});
