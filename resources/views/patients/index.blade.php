@extends('layouts.app')

@section('title', 'Patients')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Directory</p>
            <h1>Patients</h1>
            <p class="subtitle">Manage patient details and visit history.</p>
        </div>
        <a class="button" href="{{ route('patients.create') }}">+ Add patient</a>
    </div>

    <section class="panel">
        <div class="panel-heading">
            <h2>Patient directory</h2>
            <span class="muted">{{ $patients->total() }} total</span>
        </div>
        @if ($patients->isEmpty())
            <div class="empty">
                <h2>No patients yet</h2>
                <p>Add your first patient to start managing appointments.</p>
                <a class="button" href="{{ route('patients.create') }}">Add patient</a>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Contact</th>
                        <th>Appointments</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td class="primary-cell">
                                <a href="{{ route('patients.show', $patient) }}">{{ $patient->first_name }} {{ $patient->last_name }}</a>
                            </td>
                            <td>{{ $patient->email ?: $patient->phone ?: '—' }}</td>
                            <td>{{ $patient->appointments_count }}</td>
                            <td>
                                <div class="actions">
                                    <a class="button button-secondary button-small" href="{{ route('patients.show', $patient) }}">View</a>
                                    <a class="button button-secondary button-small" href="{{ route('patients.edit', $patient) }}">Edit</a>
                                    <form method="POST" action="{{ route('patients.destroy', $patient) }}" onsubmit="return confirm('Delete this patient and their appointments?')">
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
            @if ($patients->hasPages())
                <div class="pagination">{{ $patients->links() }}</div>
            @endif
        @endif
    </section>
@endsection
