<?php

use App\Http\Controllers\RDController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'theme.',
    'prefix' => 'theme',
], function () {
    Route::get('/cookie/read', [RDController::class, 'readCookie'])->name('cookie.read');
    Route::post('/cookie/create/update', [RDController::class, 'createAndUpdateCookie'])->name('cookie.create-update');
    Route::get('/cookie/delete', [RDController::class, 'deleteCookie'])->name('cookie.delete');
});
