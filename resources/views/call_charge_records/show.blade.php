@extends('layouts.app')

@section('title', 'Call Charge Record #' . $callRecord->id)

@section('container-class', 'container')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Call Charge Record <span class="text-muted fs-5">#{{ $callRecord->id }}</span></h2>
    <div>
        <a href="{{ route('call-records.edit', $callRecord) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('call-records.index') }}" class="btn btn-secondary ms-1">Back to List</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-sm mb-0">
            <tbody>
                @foreach ($callRecord->getFillable() as $field)
                    <tr>
                        <th class="w-25 text-capitalize bg-light">{{ str_replace('_', ' ', $field) }}</th>
                        <td>
                            @php $value = $callRecord->$field; @endphp
                            @if (is_bool($value))
                                {{ $value ? 'Yes' : 'No' }}
                            @elseif ($value instanceof \Illuminate\Support\Carbon)
                                {{ $value->format('Y-m-d H:i:s') }}
                            @else
                                {{ $value ?? '—' }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th class="bg-light">Created At</th>
                    <td>{{ $callRecord->created_at }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Updated At</th>
                    <td>{{ $callRecord->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

