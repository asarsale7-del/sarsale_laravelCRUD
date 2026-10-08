@extends('layouts.app')

@section('title', 'Appointment details')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Appointment details</p>
            <h1>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</h1>
            <p class="subtitle">{{ $appointment->appointment_date->format('l, F j, Y') }} at {{ substr((string) $appointment->appointment_time, 0, 5) }}</p>
        </div>
        <div class="actions">
            <a class="button button-secondary" href="{{ route('appointments.index') }}">Back to appointments</a>
            <a class="button" href="{{ route('appointments.edit', $appointment) }}">Edit appointment</a>
        </div>
    </div>
    <section class="panel">
        <div class="panel-heading"><h2>Visit information</h2></div>
        <div class="detail-grid">
            <div class="detail"><span class="detail-label">Patient</span><span class="detail-value"><a href="{{ route('patients.show', $appointment->patient) }}">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</a></span></div>
            <div class="detail"><span class="detail-label">Status</span><span class="detail-value"><span class="badge status-{{ $appointment->status }}">{{ $appointment->status }}</span></span></div>
            <div class="detail"><span class="detail-label">Date</span><span class="detail-value">{{ $appointment->appointment_date->format('M j, Y') }}</span></div>
            <div class="detail"><span class="detail-label">Time</span><span class="detail-value">{{ substr((string) $appointment->appointment_time, 0, 5) }}</span></div>
            <div class="detail" style="grid-column: 1 / -1"><span class="detail-label">Reason or notes</span><span class="detail-value">{{ $appointment->reason ?: 'No notes provided' }}</span></div>
        </div>
    </section>
@endsection
