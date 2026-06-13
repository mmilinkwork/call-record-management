@extends('layouts.app')

@section('title', 'Edit Confirmation Record #' . $confirmationRecord->id)

@section('container-class', 'container')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Confirmation Record <span class="text-muted fs-5">#{{ $confirmationRecord->id }}</span></h2>
    <a href="{{ route('confirmation-records.index') }}" class="btn btn-secondary">Back to List</a>
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
        <form method="POST" action="{{ route('confirmation-records.update', $confirmationRecord) }}">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">CRCE Operation</label>
                    <input type="text" name="crce_operation" class="form-control"
                           value="{{ old('crce_operation', $confirmationRecord->crce_operation) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Active Feature</label>
                    <input type="text" name="active_feature" class="form-control"
                           value="{{ old('active_feature', $confirmationRecord->active_feature) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sequence Total</label>
                    <input type="number" name="sequence_total" class="form-control"
                           value="{{ old('sequence_total', $confirmationRecord->sequence_total) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Bundle Code</label>
                    <input type="text" name="bundle_code" class="form-control"
                           value="{{ old('bundle_code', $confirmationRecord->bundle_code) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Opp ID</label>
                    <input type="number" name="oppId" class="form-control"
                           value="{{ old('oppId', $confirmationRecord->oppId) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Service Type</label>
                    <select name="service_type" class="form-select">
                        <option value="">— None —</option>
                        @foreach (['IVR_SELFCARE','CRM','USSD_SELFCARE','AUTOMATIC','EXTERNAL','PROVISIONING','CAMPAIGN','OTHER'] as $type)
                            <option value="{{ $type }}"
                                {{ old('service_type', $confirmationRecord->service_type) === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Customer Care User</label>
                    <input type="text" name="customer_care_user" class="form-control"
                           value="{{ old('customer_care_user', $confirmationRecord->customer_care_user) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Subscriber Language</label>
                    <input type="text" name="subscriber_language" class="form-control"
                           value="{{ old('subscriber_language', $confirmationRecord->subscriber_language) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Subscriber IMSI</label>
                    <input type="text" name="subscriber_imsi" class="form-control"
                           value="{{ old('subscriber_imsi', $confirmationRecord->subscriber_imsi) }}">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('confirmation-records.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
