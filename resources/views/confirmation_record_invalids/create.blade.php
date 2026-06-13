@extends('layouts.app')

@section('title', 'Create Invalid Confirmation Record')

@section('container-class', 'container')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Create Invalid Confirmation Record</h2>
    <a href="{{ route('confirmation-record-invalids.index') }}" class="btn btn-secondary">Back to List</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('confirmation-record-invalids.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Record <span class="text-danger">*</span></label>
                <textarea name="record" class="form-control" rows="5" required>{{ old('record') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Error Message</label>
                <textarea name="message" class="form-control" rows="3">{{ old('message') }}</textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Record</button>
                <a href="{{ route('confirmation-record-invalids.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
