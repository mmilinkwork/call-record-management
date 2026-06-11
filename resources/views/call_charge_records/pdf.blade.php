<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Call Charge Records Export</title>
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
        tbody td { padding: 4px; border-bottom: 1px solid #dee2e6; font-size: 8px; }
        .no-records { text-align: center; padding: 20px; color: #6c757d; }
    </style>
</head>
<body>
    <h1>Call Charge Records</h1>
    <div class="meta">Generated: {{ now()->format('Y-m-d H:i:s') }} UTC &nbsp;|&nbsp; Total records: {{ $records->count() }}</div>

    @php
        $activeFilters = array_filter($filters);
    @endphp

    @if (!empty($activeFilters))
        <div class="filters">
            <strong>Active Filters:</strong>
            @if (!empty($filters['imsi']))
                <span>IMSI: <em>{{ $filters['imsi'] }}</em></span>
            @endif
            @if (!empty($filters['currency']))
                <span>Currency: <em>{{ $filters['currency'] }}</em></span>
            @endif
            @if (!empty($filters['charge_amount_from']))
                <span>Charge Amount ≥ <em>{{ $filters['charge_amount_from'] }}</em></span>
            @endif
            @if (!empty($filters['charge_amount_to']))
                <span>Charge Amount ≤ <em>{{ $filters['charge_amount_to'] }}</em></span>
            @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>IMSI</th>
                <th>Calling MSISDN</th>
                <th>Called MSISDN</th>
                <th>Traffic Type</th>
                <th>Answer Time</th>
                <th>Charge Amount</th>
                <th>Currency</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->imsi ?? '—' }}</td>
                    <td>{{ $record->calling_msisdn ?? '—' }}</td>
                    <td>{{ $record->called_msisdn ?? '—' }}</td>
                    <td>{{ $record->traffic_type ?? '—' }}</td>
                    <td>{{ $record->answer_time ? $record->answer_time->format('Y-m-d H:i:s') : '—' }}</td>
                    <td>{{ $record->charge_amount ?? '—' }}</td>
                    <td>{{ $record->currency ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="no-records">No records found for the selected filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
