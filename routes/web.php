<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'patientCount' => Patient::query()->count(),
        'appointmentCount' => Appointment::query()->count(),
        'upcomingAppointments' => Appointment::query()
            ->with('patient')
            ->where('status', 'scheduled')
            ->whereDate('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->limit(5)
            ->get(),
    ]);
})->name('home');

Route::resource('patients', PatientController::class);
Route::resource('appointments', AppointmentController::class);
