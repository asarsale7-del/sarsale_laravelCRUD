@extends('layouts.app')

@section('title', $patient->first_name.' '.$patient->last_name)

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Patient profile</p>
            <h1>{{ $patient->first_name }} {{ $patient->last_name }}</h1>
            <p class="subtitle">Patient details and appointment history.</p>
        </div>
        <div class="actions">
            <a class="button button-secondary" href="{{ route('patients.index') }}">Back to patients</a>
            <a class="button" href="{{ route('patients.edit', $patient) }}">Edit patient</a>
        </div>
    </div>

    <section class="panel" style="margin-bottom: 24px">
        <div class="panel-heading"><h2>Contact information</h2></div>
        <div class="detail-grid">
            <div class="detail"><span class="detail-label">Email</span><span class="detail-value">{{ $patient->email ?: 'Not provided' }}</span></div>
            <div class="detail"><span class="detail-label">Phone</span><span class="detail-value">{{ $patient->phone ?: 'Not provided' }}</span></div>
            <div class="detail"><span class="detail-label">Address</span><span class="detail-value">{{ $patient->address ?: 'Not provided' }}</span></div>
            <div class="detail"><span class="detail-label">Appointments</span><span class="detail-value">{{ $patient->appointments->count() }}</span></div>
        </div>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <h2>Appointment history</h2>
            <a class="button button-secondary button-small" href="{{ route('appointments.create', ['patient_id' => $patient->id]) }}">+ New appointment</a>
        </div>
        @if ($patient->appointments->isEmpty())
            <div class="empty"><p>No appointments for this patient yet.</p></div>
        @else
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Date</th><th>Time</th><th>Reason</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                    @foreach ($patient->appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_date->format('M j, Y') }}</td>
                            <td>{{ substr((string) $appointment->appointment_time, 0, 5) }}</td>
                            <td>{{ $appointment->reason ?: '—' }}</td>
                            <td><span class="badge status-{{ $appointment->status }}">{{ $appointment->status }}</span></td>
                            <td><a class="button button-secondary button-small" href="{{ route('appointments.show', $appointment) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
