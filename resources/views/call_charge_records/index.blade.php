<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Call Charge Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Call Charge Records</h2>
        <a href="{{ route('call-records.create') }}" class="btn btn-primary">Upload CDR File</a>
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
            <form method="GET" action="{{ route('call-records.index') }}" id="filter-form">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="imsi" class="form-label">IMSI</label>
                        <input type="text" class="form-control" id="imsi" name="imsi"
                               value="{{ $filters['imsi'] ?? '' }}" placeholder="Search IMSI…">
                    </div>
                    <div class="col-md-2">
                        <label for="charge_amount_from" class="form-label">Charge Amount From</label>
                        <input type="number" step="0.000001" class="form-control" id="charge_amount_from"
                               name="charge_amount_from" value="{{ $filters['charge_amount_from'] ?? '' }}"
                               placeholder="0.00">
                    </div>
                    <div class="col-md-2">
                        <label for="charge_amount_to" class="form-label">Charge Amount To</label>
                        <input type="number" step="0.000001" class="form-control" id="charge_amount_to"
                               name="charge_amount_to" value="{{ $filters['charge_amount_to'] ?? '' }}"
                               placeholder="0.00">
                    </div>
                    <div class="col-md-2">
                        <label for="currency" class="form-label">Currency</label>
                        <select class="form-select" id="currency" name="currency">
                            <option value="">— All Currencies —</option>
                            @foreach ($currencies as $code => $label)
                                <option value="{{ $code }}" {{ ($filters['currency'] ?? '') === $code ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-secondary">Apply Filters</button>
                        <a href="{{ route('call-records.index') }}" class="btn btn-outline-secondary">Reset</a>
                        <a href="{{ route('call-records.export-pdf', array_filter($filters)) }}"
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
                            <th>IMSI</th>
                            <th>Calling MSISDN</th>
                            <th>Called MSISDN</th>
                            <th>Traffic Type</th>
                            <th>Answer Time</th>
                            <th>Charge Amount</th>
                            <th>Currency</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($records as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->imsi }}</td>
                                <td>{{ $record->calling_msisdn }}</td>
                                <td>{{ $record->called_msisdn }}</td>
                                <td>{{ $record->traffic_type }}</td>
                                <td>{{ $record->answer_time }}</td>
                                <td>{{ $record->charge_amount }}</td>
                                <td>{{ $record->currency }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('call-records.show', $record) }}" class="btn btn-sm btn-info">Show</a>
                                    <a href="{{ route('call-records.edit', $record) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger btn-delete"
                                            data-action="{{ route('call-records.destroy', $record) }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No records found.</td>
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

</div>

<!-- Delete confirmation form (hidden) -->
<form id="delete-form" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(function () {
        $('.btn-delete').on('click', function () {
            if (confirm('Are you sure you want to delete this record?')) {
                var action = $(this).data('action');
                $('#delete-form').attr('action', action).submit();
            }
        });
    });
</script>

</body>
</html>
