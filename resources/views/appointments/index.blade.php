@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
    <h2>List of Appointments</h2>
    <a class="btn btn-primary mb-3" href="{{ route('appointments.create') }}">Add Appointment</a>
        @if ($appointments->isEmpty())
            <div class="alert alert-info">
                No appointments found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                            <td>{{ $appointment->appointment_date->format('M j, Y') }}</td>
                            <td>{{ substr((string) $appointment->appointment_time, 0, 5) }}</td>
                            <td>{{ $appointment->reason ?: '—' }}</td>
                            <td>{{ ucfirst($appointment->status) }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('appointments.edit', $appointment) }}">Edit</a>
                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
@endsection
