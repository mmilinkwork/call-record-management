@extends('layouts.app')

@section('title', 'Confirmation Record #' . $confirmationRecord->id)

@section('container-class', 'container')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Confirmation Record <span class="text-muted fs-5">#{{ $confirmationRecord->id }}</span></h2>
    <div>
        <a href="{{ route('confirmation-records.edit', $confirmationRecord) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('confirmation-records.index') }}" class="btn btn-secondary ms-1">Back to List</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-sm mb-0">
            <tbody>
                @foreach ($confirmationRecord->getFillable() as $field)
                    <tr>
                        <th class="w-25 text-capitalize bg-light">{{ str_replace('_', ' ', $field) }}</th>
                        <td>{{ $confirmationRecord->$field ?? '—' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th class="bg-light">Created At</th>
                    <td>{{ $confirmationRecord->created_at }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Updated At</th>
                    <td>{{ $confirmationRecord->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
