@extends('layouts.app')

@section('title', 'Confirmation Records')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Confirmation Records</h2>
    <a href="{{ route('confirmation-records.create') }}" class="btn btn-primary">Upload File</a>
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
        <form method="GET" action="{{ route('confirmation-records.index') }}" id="filter-form">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="subscriber_imsi" class="form-label">Subscriber IMSI</label>
                    <input type="text" class="form-control" id="subscriber_imsi" name="subscriber_imsi"
                           value="{{ $filters['subscriber_imsi'] ?? '' }}" placeholder="Search IMSI…">
                </div>
                <div class="col-md-3">
                    <label for="crce_operation" class="form-label">CRCE Operation</label>
                    <input type="text" class="form-control" id="crce_operation" name="crce_operation"
                           value="{{ $filters['crce_operation'] ?? '' }}" placeholder="Search operation…">
                </div>
                <div class="col-md-2">
                    <label for="service_type" class="form-label">Service Type</label>
                    <select class="form-select" id="service_type" name="service_type">
                        <option value="">— All —</option>
                        @foreach (['IVR_SELFCARE','CRM','USSD_SELFCARE','AUTOMATIC','EXTERNAL','PROVISIONING','CAMPAIGN','OTHER'] as $type)
                            <option value="{{ $type }}" {{ ($filters['service_type'] ?? '') === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-secondary">Apply Filters</button>
                    <a href="{{ route('confirmation-records.index') }}" class="btn btn-outline-secondary">Reset</a>
                    <a href="{{ route('confirmation-records.export-pdf', array_filter($filters)) }}"
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
                        <th>CRCE Operation</th>
                        <th>Subscriber IMSI</th>
                        <th>Bundle Code</th>
                        <th>Service Type</th>
                        <th>Subscriber Language</th>
                        <th>Customer Care User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->crce_operation }}</td>
                            <td>{{ $record->subscriber_imsi }}</td>
                            <td>{{ $record->bundle_code ?? '—' }}</td>
                            <td>{{ $record->service_type ?? '—' }}</td>
                            <td>{{ $record->subscriber_language }}</td>
                            <td>{{ $record->customer_care_user ?? '—' }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('confirmation-records.show', $record) }}" class="btn btn-sm btn-info">Show</a>
                                <a href="{{ route('confirmation-records.edit', $record) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button"
                                        class="btn btn-sm btn-danger btn-delete"
                                        data-action="{{ route('confirmation-records.destroy', $record) }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No records found.</td>
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
