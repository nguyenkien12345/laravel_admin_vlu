<?php

use App\Helpers\Common;
use App\Helpers\Address;

use App\Http\Controllers\FacultyController;

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\HomeController@index')->name('Home.index');
