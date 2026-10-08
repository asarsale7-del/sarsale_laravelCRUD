@extends('layouts.app')

@section('title', 'Add patient')

@section('content')
    <div class="card">
        <div class="card-header">Add Patient</div>
        <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('patients.store') }}">
            @csrf
            @include('patients._form')
            <button type="submit" class="btn btn-primary">Save Patient</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
        </div>
    </div>
@endsection
