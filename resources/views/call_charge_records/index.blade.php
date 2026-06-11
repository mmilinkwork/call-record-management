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

    <div class="mt-3">
        {{ $records->links() }}
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
