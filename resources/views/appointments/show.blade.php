@extends('layouts.app')

@section('title', 'Appointment details')

@section('content')
    <div class="card">
        <div class="card-header">Appointment Details</div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Patient</dt>
                <dd class="col-sm-9">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</dd>
                <dt class="col-sm-3">Date</dt>
                <dd class="col-sm-9">{{ $appointment->appointment_date->format('M j, Y') }}</dd>
                <dt class="col-sm-3">Time</dt>
                <dd class="col-sm-9">{{ substr((string) $appointment->appointment_time, 0, 5) }}</dd>
                <dt class="col-sm-3">Reason</dt>
                <dd class="col-sm-9">{{ $appointment->reason ?: '—' }}</dd>
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ ucfirst($appointment->status) }}</dd>
            </dl>
            <a class="btn btn-warning" href="{{ route('appointments.edit', $appointment) }}">Edit</a>
            <a class="btn btn-secondary" href="{{ route('appointments.index') }}">Back</a>
        </div>
    </div>
@endsection
