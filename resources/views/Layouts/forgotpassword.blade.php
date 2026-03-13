<link rel="stylesheet" href="{{ asset('css/adminpanal.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="update-container">
    <div class="card-update shadow-lg p-5 bg-white rounded-2xl w-75 mx-auto mt-4">
        <h2 class="fw-bold mb-4">Update Password</h2>

        {{-- SweetAlert Success --}}
        @if (session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        // redirect after alert
                        window.location.href = "{{ route('login') }}";
                    });
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{{ session('error') }}',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        // Redirect after error
                        window.location.href = "{{ route('forgotpassword') }}";
                    });
                });
            </script>
        @endif


        <form action="{{ route('updatepassword') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter user name"  required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">New Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation"
                    placeholder="Enter confirm Password" required>
            </div>

            <div class="btn">
                <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-success">Update Password</button>
            </div>
        </form>
    </div>
</div>
