<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.7; color: #333; max-width: 650px; margin: auto;">

    <h2 style="color: #d9534f;">Your Appointment Has Been Cancelled</h2>

    <p>Dear <strong>{{ $appointment->patient_name }}</strong>,</p>

    <p>
        We regret to inform you that your appointment request has been
        <strong style="color: #d9534f;">cancelled</strong> by the doctor.
        Please find the details below for your reference.
    </p>

    <p><strong>Status:</strong> {{ $messageText }}</p>

    <hr style="border: 0; border-top: 1px solid #ccc;">

    <h3 style="color: #d9534f;">Appointment Details</h3>
    <p>
        <strong>Doctor:</strong> {{ $appointment->doctor->name ?? 'N/A' }}<br>
        <strong>Specialization:</strong> {{ $appointment->doctor->specialization ?? 'General Dentistry' }}<br>
        <strong>Scheduled Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}<br>
        <strong>Scheduled Time:</strong> {{ $appointment->appointment_time ?? $appointment->time_slot ?? 'N/A' }}
    </p>

    <p>
        We sincerely apologize for the inconvenience this may have caused.
        Sometimes cancellations occur due to emergencies, scheduling conflicts,
        or unforeseen professional commitments.
    </p>

    <hr style="border: 0; border-top: 1px solid #ccc; margin-top: 25px;">

    <h3 style="color: #1b76d1;">What You Can Do Next</h3>
    <ul>
        <li>You may book a new appointment at your preferred date and time.</li>
        <li>If you require urgent assistance, please contact our helpline.</li>
        <li>Our team will be happy to guide you through rescheduling.</li>
    </ul>

    <h3 style="color: #1b76d1;">Need Assistance?</h3>
    <p>
        For help regarding your cancelled appointment, contact us:
    </p>
    <p>
        📞 <strong>+91 8758443566</strong><br>
        ✉️ <strong>support@dentalhospital.com</strong><br>
        🌐 <strong>www.dentalhospital.com</strong>
    </p>

    <br>

    <p>
        We appreciate your understanding and apologize once again for the inconvenience.
        We look forward to serving you soon.
    </p>

    <p>
        Warm Regards,<br>
        <strong>Dental Hospital Appointment Team</strong>
    </p>

</body>
</html>
