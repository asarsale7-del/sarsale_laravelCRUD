@extends('layouts.app')

@section('title', 'Add patient')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Patient directory</p>
            <h1>Add patient</h1>
            <p class="subtitle">Enter the patient's contact information.</p>
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
        <form method="POST" action="{{ route('patients.store') }}">
            @csrf
            @include('patients._form')
            <div class="form-actions">
                <button class="button" type="submit">Save patient</button>
                <a class="button button-secondary" href="{{ route('patients.index') }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
