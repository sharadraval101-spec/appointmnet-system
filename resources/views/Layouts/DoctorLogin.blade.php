@push('cdn')
@endpush

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../css/style.css">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('error'))
            Swal.fire({
                icon: 'warning',
                title: 'Oops!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#3085d6',
            });
        @endif


        @if (session('register_success'))
            Swal.fire({
                icon: 'success',
                title: 'Registered Successfully!',
                text: '{{ session('register_success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        @if (session('login_failed'))
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: '{{ session('login_failed') }}',
                confirmButtonColor: '#d33'
            });
        @endif

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Login Successful!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        @if (session('validation_error'))
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: '{{ session('validation_error') }}',
                confirmButtonColor: '#ffc107'
            });
        @endif
    });
</script>
<div class="login-container">

    <div class="container">
        <!-- Left Image Section -->
        <div class="left">
            <p>“For There Was Never Yet Philosopher, That Could Endure The Toothache Patiently.”</p>
            <h4>~ Dr Dre Andre Romelle<br>Founder of Smile Pvt. Ltd</h4>
        </div>

        <!-- Right Login Form -->
        <div class="right">
            <h2>Welcome Back Doctor</h2>
            <p>Discover a better way of spendings with Ulfry.</p>

            <button class="google-btn">
                <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google icon">
                Log in with Google
            </button>

            <div class="divider">Or</div>

            <form action="{{ route('doctor.login.post') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="email" placeholder="Enter your Email" name="email">
                </div>

                <div class="form-group">
                    <input type="password" placeholder="Password" name="password">
                </div>

                <div class="form-options">
                    {{-- <label><input type="checkbox"> Remember Me</label> --}}
                    {{-- <a href="#">Forgot Password?</a> --}}
                </div>

                <button type="submit" class="login-btn">Log in</button>
            </form>

            <div class="signup-text">
                {{-- Not member yet? <a href="{{route('register')}}">Create an account</a> --}}
            </div>
        </div>
    </div>
</div>
