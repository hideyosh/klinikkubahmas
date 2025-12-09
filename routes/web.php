<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
Route::resource('pasien', \App\Http\Controllers\PasienController::class);

    return view('welcome');
});
