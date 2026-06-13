@extends('layouts.app')

@section('title', 'Invalid Confirmation Record #' . $confirmationRecordInvalid->id)

@section('container-class', 'container')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Invalid Confirmation Record <span class="text-muted fs-5">#{{ $confirmationRecordInvalid->id }}</span></h2>
    <div>
        <a href="{{ route('confirmation-record-invalids.edit', $confirmationRecordInvalid) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('confirmation-record-invalids.index') }}" class="btn btn-secondary ms-1">Back to List</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-sm mb-0">
            <tbody>
                <tr>
                    <th class="w-25 bg-light">Record</th>
                    <td><pre class="mb-0" style="white-space:pre-wrap;word-break:break-all;">{{ $confirmationRecordInvalid->record }}</pre></td>
                </tr>
                <tr>
                    <th class="bg-light">Error Message</th>
                    <td>{{ $confirmationRecordInvalid->message ?? '—' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Created At</th>
                    <td>{{ $confirmationRecordInvalid->created_at }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Updated At</th>
                    <td>{{ $confirmationRecordInvalid->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
