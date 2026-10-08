@extends('layouts.app')

@section('title', $patient->first_name.' '.$patient->last_name)

@section('content')
    <div class="card mb-4">
        <div class="card-header">Patient Details</div>
        <div class="card-body">
            <h2>{{ $patient->first_name }} {{ $patient->last_name }}</h2>
            <dl class="row mt-3">
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $patient->email ?: '—' }}</dd>
                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9">{{ $patient->phone ?: '—' }}</dd>
                <dt class="col-sm-3">Address</dt>
                <dd class="col-sm-9">{{ $patient->address ?: '—' }}</dd>
            </dl>
            <a class="btn btn-warning" href="{{ route('patients.edit', $patient) }}">Edit</a>
            <a class="btn btn-secondary" href="{{ route('patients.index') }}">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Appointment History</span>
            <a class="btn btn-primary btn-sm" href="{{ route('appointments.create', ['patient_id' => $patient->id]) }}">Add Appointment</a>
        </div>
        @if ($patient->appointments->isEmpty())
            <div class="card-body">No appointments found.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead><tr><th>Date</th><th>Time</th><th>Reason</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                    @foreach ($patient->appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_date->format('M j, Y') }}</td>
                            <td>{{ substr((string) $appointment->appointment_time, 0, 5) }}</td>
                            <td>{{ $appointment->reason ?: '—' }}</td>
                            <td>{{ ucfirst($appointment->status) }}</td>
                            <td><a class="btn btn-warning btn-sm" href="{{ route('appointments.edit', $appointment) }}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
