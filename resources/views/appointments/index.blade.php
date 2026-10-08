@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Schedule</p>
            <h1>Appointments</h1>
            <p class="subtitle">Create and manage patient visits.</p>
        </div>
        <a class="button" href="{{ route('appointments.create') }}">+ New appointment</a>
    </div>

    <section class="panel">
        <div class="panel-heading">
            <h2>Appointment list</h2>
            <span class="muted">{{ $appointments->total() }} total</span>
        </div>
        @if ($appointments->isEmpty())
            <div class="empty">
                <h2>No appointments yet</h2>
                <p>Schedule a visit for one of your patients.</p>
                <a class="button" href="{{ route('appointments.create') }}">Schedule appointment</a>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Patient</th><th>Date</th><th>Time</th><th>Reason</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td class="primary-cell">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                            <td>{{ $appointment->appointment_date->format('M j, Y') }}</td>
                            <td>{{ substr((string) $appointment->appointment_time, 0, 5) }}</td>
                            <td>{{ $appointment->reason ?: '—' }}</td>
                            <td><span class="badge status-{{ $appointment->status }}">{{ $appointment->status }}</span></td>
                            <td>
                                <div class="actions">
                                    <a class="button button-secondary button-small" href="{{ route('appointments.show', $appointment) }}">View</a>
                                    <a class="button button-secondary button-small" href="{{ route('appointments.edit', $appointment) }}">Edit</a>
                                    <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" onsubmit="return confirm('Delete this appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-danger button-small" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($appointments->hasPages())
                <div class="pagination">{{ $appointments->links() }}</div>
            @endif
        @endif
    </section>
@endsection
