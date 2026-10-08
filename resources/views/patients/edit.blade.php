@extends('layouts.app')

@section('title', 'Edit patient')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Patient directory</p>
            <h1>Edit patient</h1>
            <p class="subtitle">Update {{ $patient->first_name }} {{ $patient->last_name }}'s details.</p>
        </div>
    </div>
    <section class="panel form-panel">
        <form method="POST" action="{{ route('patients.update', $patient) }}">
            @csrf
            @method('PUT')
            @include('patients._form')
            <div class="form-actions">
                <button class="button" type="submit">Save changes</button>
                <a class="button button-secondary" href="{{ route('patients.show', $patient) }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
