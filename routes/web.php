<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/patients')->name('home');

Route::resource('patients', PatientController::class);
Route::resource('appointments', AppointmentController::class);
