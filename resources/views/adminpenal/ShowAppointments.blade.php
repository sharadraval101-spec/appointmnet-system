@extends('adminpenal.navbar')

@section('admin-content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="card">
        <!-- Header with title + Search bar -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Appointment Management</h2>
            <a href="{{ route('ShowAppointments.print') }}" target="_blank" class="btn" style="background-color: #011632 ; color: #ffffff; border: 1px solid #ccc;">Download Appointmnets</a>
            <div class="user-searchbar d-flex gap-2">
                <input type="text" id="userearch" placeholder="Search appointment..." class="search-bar form-control"
                    style="padding: 6px 10px; border-radius: 6px; border: 1px solid #ccc;">
            </div>
        </div>

        <table class="user-table table table-bordered mt-3" id="userTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Patient Email</th>
                    <th>Doctor</th>
                    <th>Appointment Date</th>
                    <th>Time Slot</th>
                    <th>Status</th>
                    <th>Approved</th>
                    <th>Cancelled</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->patient_name ?? 'N/A' }}</td>
                        <td>{{ $appointment->email ?? 'N/A' }}</td>
                        <td>{{ $appointment->doctor->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                        <td>
                            @if ($appointment->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($appointment->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm approve-btn"
                                data-id="{{ $appointment->id }}">Approve</button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm cancel-btn"
                                data-id="{{ $appointment->id }}">Cancel</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-3">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- SweetAlert Success Message -->
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif

    <!-- Search Filter -->
    <script>
        document.getElementById("userearch").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#userTable tbody tr");
            let matchFound = false;

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.style.display = "";
                    matchFound = true;
                } else {
                    row.style.display = "none";
                }
            });

            if (!matchFound && filter.trim() !== "") {
                Swal.fire({
                    icon: "warning",
                    title: "No Data Found",
                    text: "No matching record found for your search.",
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        });

        // Approve Appointment
        document.querySelectorAll('.approve-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                let id = this.dataset.id;

                const confirm = await Swal.fire({
                    title: "Approve Appointment?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Approve"
                });

                if (!confirm.isConfirmed) return;

                Swal.fire({
                    title: "Processing...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                let res = await fetch(`/admin/appointments/${id}/approve`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                });

                let data = await res.json();

                Swal.fire("Success!", data.success, "success");

                setTimeout(() => location.reload(), 700);
            });
        });


        // Cancel Appointment
        document.querySelectorAll('.cancel-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                let id = this.dataset.id;

                const confirm = await Swal.fire({
                    title: "Cancel Appointment?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Cancel"
                });

                if (!confirm.isConfirmed) return;

                Swal.fire({
                    title: "Processing...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                let res = await fetch(`/admin/appointments/${id}/cancel`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                });

                let data = await res.json();

                Swal.fire("Cancelled!", data.success, "success");

                setTimeout(() => location.reload(), 700);
            });
        });
    </script>
@endsection
