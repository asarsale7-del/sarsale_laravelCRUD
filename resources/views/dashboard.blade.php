@extends('layouts.app')

@section('title', 'Overview')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Clinic workspace</p>
            <h1>Overview</h1>
            <p class="subtitle">A clear view of your patients and appointments.</p>
        </div>
        <a class="button" href="{{ route('appointments.create') }}">+ New appointment</a>
    </div>

    <div class="cards">
        <section class="panel stat-card">
            <div class="stat-label">Registered patients</div>
            <div class="stat-value">{{ $patientCount }}</div>
            <a class="muted" href="{{ route('patients.index') }}">View patient list →</a>
        </section>
        <section class="panel stat-card">
            <div class="stat-label">All appointments</div>
            <div class="stat-value">{{ $appointmentCount }}</div>
            <a class="muted" href="{{ route('appointments.index') }}">View appointment list →</a>
        </section>
    </div>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>Upcoming appointments</h2>
                <p class="subtitle">Your next scheduled visits.</p>
            </div>
            <a class="button button-secondary button-small" href="{{ route('appointments.index') }}">All appointments</a>
        </div>
        @if ($upcomingAppointments->isEmpty())
            <div class="empty">
                <h2>Nothing scheduled yet</h2>
                <p>Create an appointment to see it here.</p>
                <a class="button" href="{{ route('appointments.create') }}">Schedule appointment</a>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($upcomingAppointments as $appointment)
                        <tr>
                            <td class="primary-cell">
                                <a href="{{ route('appointments.show', $appointment) }}">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</a>
                            </td>
                            <td>{{ $appointment->appointment_date->format('M j, Y') }}</td>
                            <td>{{ substr((string) $appointment->appointment_time, 0, 5) }}</td>
                            <td><span class="badge status-{{ $appointment->status }}">{{ $appointment->status }}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
