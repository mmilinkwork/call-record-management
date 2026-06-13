<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invalid Call Charge Records Export</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; color: #212529; margin: 0; padding: 10px; }
        h1 { font-size: 14px; margin: 0 0 4px; }
        .meta { font-size: 8px; color: #6c757d; margin-bottom: 10px; }
        .filters { font-size: 8px; color: #495057; margin-bottom: 8px; }
        .filters span { display: inline-block; margin-right: 12px; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background-color: #343a40; color: #fff; }
        thead th { padding: 5px 4px; text-align: left; font-size: 8px; }
        tbody tr:nth-child(even) { background-color: #f8f9fa; }
        tbody td { padding: 4px; border-bottom: 1px solid #dee2e6; font-size: 8px; word-break: break-all; }
        .no-records { text-align: center; padding: 20px; color: #6c757d; }
    </style>
</head>
<body>
    <h1>Invalid Call Charge Records</h1>
    <div class="meta">Generated: {{ now()->format('Y-m-d H:i:s') }} UTC &nbsp;|&nbsp; Total records: {{ $records->count() }}</div>

    @php $activeFilters = array_filter($filters); @endphp

    @if (!empty($activeFilters))
        <div class="filters">
            <strong>Active Filters:</strong>
            @if (!empty($filters['record']))
                <span>Record: <em>{{ $filters['record'] }}</em></span>
            @endif
            @if (!empty($filters['message']))
                <span>Message: <em>{{ $filters['message'] }}</em></span>
            @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Record</th>
                <th>Error Message</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->record }}</td>
                    <td>{{ $record->message ?? '—' }}</td>
                    <td>{{ $record->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="no-records">No records found for the selected filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
