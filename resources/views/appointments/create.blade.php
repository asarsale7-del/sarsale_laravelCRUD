@extends('layouts.app')

@section('title', 'New appointment')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Schedule</p>
            <h1>New appointment</h1>
            <p class="subtitle">Choose a patient, date, and time for the visit.</p>
        </div>
    </div>
    <section class="panel form-panel">
        @if ($patients->isEmpty())
            <div class="alert">There are no patients yet. <a href="{{ route('patients.create') }}"><strong>Add a patient</strong></a> before scheduling.</div>
        @endif
        @if ($errors->any())
            <div class="alert" role="alert">
                <ul style="margin: 0; padding-left: 20px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf
            @include('appointments._form')
            <div class="form-actions">
                <button class="button" type="submit" @disabled($patients->isEmpty())>Save appointment</button>
                <a class="button button-secondary" href="{{ route('appointments.index') }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
