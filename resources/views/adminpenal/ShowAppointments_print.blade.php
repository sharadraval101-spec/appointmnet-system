<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments Data</title>
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
    <h1>Appointments Data</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Patient Email</th>
                <th>Doctor</th>
                <th>Appointment Date</th>
                <th>Time Slot</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->patient_name ?? 'N/A' }}</td>
                    <td>{{ $appointment->email ?? 'N/A' }}</td>
                    <td>{{ $appointment->doctor->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>
                        @if ($appointment->status === 'approved')
                            <span>Approved</span>
                        @elseif($appointment->status === 'pending')
                            <span>Pending</span>
                        @else
                            <span>Cancelled</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
