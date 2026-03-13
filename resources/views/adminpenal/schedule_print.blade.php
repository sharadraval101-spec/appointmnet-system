<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedules Data</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body onload="window.print()">
    <h1>Schedules Data</h1>
    <table>
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Doctor</th>
                <th>Available From</th>
                <th>Available To</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Slots</th>
                <th>Availability</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $schedule)
            <tr>
                <td>{{ $schedule->id }}</td>
                <td>{{ $schedule->doctor->name ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->available_from)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->available_to)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                <td>{{ $schedule->total_slots }}</td>
                <td>
                    @if($schedule->is_available)
                        <span>Available</span>
                    @else
                        <span>Unavailable</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-3">No schedules found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
