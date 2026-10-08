@extends('layouts.app')

@section('title', 'Edit appointment')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Schedule</p>
            <h1>Edit appointment</h1>
            <p class="subtitle">Update the visit details and status.</p>
        </div>
    </div>
    <section class="panel form-panel">
        @if ($errors->any())
            <div class="alert" role="alert">
                <ul style="margin: 0; padding-left: 20px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('appointments.update', $appointment) }}">
            @csrf
            @method('PUT')
            @include('appointments._form')
            <div class="form-actions">
                <button class="button" type="submit">Save changes</button>
                <a class="button button-secondary" href="{{ route('appointments.show', $appointment) }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
