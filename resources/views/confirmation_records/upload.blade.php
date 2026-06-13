@extends('layouts.app')

@section('title', 'Upload Confirmation Records File')

@section('container-class', 'container')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Upload Confirmation Records File</h2>
    <a href="{{ route('confirmation-records.index') }}" class="btn btn-secondary">Back to List</a>
</div>

<div class="card">
    <div class="card-header">Upload File</div>
    <div class="card-body">
        <form action="{{ route('confirmation-records.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Select file</label>
                <input type="file" name="file" class="form-control" required>
            </div>

            <button class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

@endsection

