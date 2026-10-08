@extends('layouts.app')

@section('title', 'Patients')

@section('content')
    <h2>List of Patients</h2>
    <a class="btn btn-primary mb-3" href="{{ route('patients.create') }}">Add Patient</a>
        @if ($patients->isEmpty())
            <div class="alert alert-info">
                No patients found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                            <td>{{ $patient->email ?: '—' }}</td>
                            <td>{{ $patient->phone ?: '—' }}</td>
                            <td>{{ $patient->address ?: '—' }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('patients.edit', $patient) }}">Edit</a>
                                <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this patient?')">
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
