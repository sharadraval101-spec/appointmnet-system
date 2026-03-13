<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.7; color: #333; max-width: 650px; margin: auto;">

    <h2 style="color: #1b76d1;">Your Appointment Has Been Approved ✔</h2>

    <p>Dear <strong>{{ $appointment->patient_name }}</strong>,</p>

    <p>
        We are pleased to inform you that your appointment request has been
        <strong style="color: green;">successfully approved</strong> at our Dental Hospital.
        Please review your confirmed appointment details below.
    </p>

    <p><strong>Status:</strong> {{ $messageText }}</p>

    <hr style="border: 0; border-top: 1px solid #ccc;">

    <h3 style="color: #1b76d1;">Confirmed Appointment Details</h3>
    <p>
        <strong>Doctor:</strong> {{ $appointment->doctor->name ?? 'N/A' }}<br>
        <strong>Specialization:</strong> {{ $appointment->doctor->specialization ?? 'General Dentistry' }}<br>
        <strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}<br>
        <strong>Appointment Time:</strong> {{ $appointment->appointment_time ?? $appointment->time_slot ?? 'N/A' }}
    </p>

    <p>
        Kindly ensure that you arrive on time and bring any previous dental reports or prescriptions if available.
        Our team is fully prepared to provide you with the best dental care experience.
    </p>

    <hr style="border: 0; border-top: 1px solid #ccc; margin-top: 25px;">

    <h3 style="color: #1b76d1;">Before You Visit</h3>
    <ul>
        <li>Please reach the hospital at least <strong>10–15 minutes</strong> before your scheduled time.</li>
        <li>Carry any relevant medical history or previous dental records.</li>
        <li>Follow any pre-appointment instructions provided by your doctor.</li>
        <li>Bring a valid ID proof for verification.</li>
    </ul>

    <h3 style="color: #1b76d1;">Need Assistance?</h3>
    <p>
        For any questions regarding your appointment, feel free to contact us:
    </p>
    <p>
        📞 <strong>+91 8758443566</strong><br>
        ✉️ <strong>support@dentalhospital.com</strong><br>
        🌐 <strong>www.dentalhospital.com</strong>
    </p>

    <br>

    <p>
        Thank you for choosing our Dental Hospital.
        We look forward to serving you with excellent care.
    </p>

    <p>
        Warm Regards,<br>
        <strong>Dental Hospital Appointment Team</strong>
    </p>

</body>
</html>
