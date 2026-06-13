@extends('layouts.app')

@section('title', 'Invalid Confirmation Records')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Invalid Confirmation Records</h2>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Filter Form --}}
<div class="card mb-3">
    <div class="card-header fw-semibold">Filters</div>
    <div class="card-body">
        <form method="GET" action="{{ route('confirmation-record-invalids.index') }}" id="filter-form">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="record" class="form-label">Record</label>
                    <input type="text" class="form-control" id="record" name="record"
                           value="{{ $filters['record'] ?? '' }}" placeholder="Search in record…">
                </div>
                <div class="col-md-4">
                    <label for="message" class="form-label">Error Message</label>
                    <input type="text" class="form-control" id="message" name="message"
                           value="{{ $filters['message'] ?? '' }}" placeholder="Search in message…">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-secondary">Apply Filters</button>
                    <a href="{{ route('confirmation-record-invalids.index') }}" class="btn btn-outline-secondary">Reset</a>
                    <a href="{{ route('confirmation-record-invalids.export-pdf', array_filter($filters)) }}"
                       class="btn btn-danger">Export PDF</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Record</th>
                        <th>Error Message</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td class="text-truncate" style="max-width:300px;" title="{{ $record->record }}">{{ $record->record }}</td>
                            <td class="text-truncate" style="max-width:300px;" title="{{ $record->message }}">{{ $record->message ?? '—' }}</td>
                            <td>{{ $record->created_at }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('confirmation-record-invalids.show', $record) }}" class="btn btn-sm btn-info">Show</a>
                                <a href="{{ route('confirmation-record-invalids.edit', $record) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button"
                                        class="btn btn-sm btn-danger btn-delete"
                                        data-action="{{ route('confirmation-record-invalids.destroy', $record) }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No invalid records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $records->links('pagination::bootstrap-5') }}
</div>

@endsection
