@extends('layouts.app')

@section('title', 'New appointment')

@section('content')
    <div class="card">
        <div class="card-header">Add Appointment</div>
        <div class="card-body">
        @if ($patients->isEmpty())
            <div class="alert alert-info">Add a patient before scheduling an appointment.</div>
            <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Add Patient</a>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf
            @include('appointments._form')
            <button type="submit" class="btn btn-primary" @disabled($patients->isEmpty())>Save Appointment</button>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
        </div>
    </div>
@endsection
