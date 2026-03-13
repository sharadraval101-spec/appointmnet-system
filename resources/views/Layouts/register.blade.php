{{-- @extends('layouts.nav') --}}
@push('cdn')@endpush

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../css/style.css">

<script>
  document.addEventListener('DOMContentLoaded', function () {

    @if ($errors->has('name'))
        Swal.fire({
            icon: 'error',
            title: 'Invalid Name',
            text: '{{ $errors->first('name') }}',
            confirmButtonColor: '#3085d6',
        });
    @endif

    @if ($errors->has('email'))
        Swal.fire({
            icon: 'error',
            title: 'Invalid Email',
            text: '{{ $errors->first('email') }}',
            confirmButtonColor: '#3085d6',
        });
    @endif

    @if ($errors->has('password'))
        Swal.fire({
            icon: 'error',
            title: 'Invalid Password',
            text: '{{ $errors->first('password') }}',
            confirmButtonColor: '#3085d6',
        });
    @endif

    @if (session('register_failed'))
        Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: '{{ session('register_failed') }}',
            confirmButtonColor: '#d33'
        });
    @endif
      });
  
</script>

<div class="register-container">
    
<div class="container">
    <!-- Left Image Section -->
    <div class="left-register">
      <p>“Effort is like toothpaste; you can usually squeeze out just a little bit more.''</p>
      <h4>~ Dr Andre Jackson<br>Manager of Smile Pvt.Ltd</h4>
    </div>

    <!-- Right Login Form -->
    <div class="right">
      <h2>Create An Account</h2>
      <p>Discover a better way of spendings with Ulfry.</p>

      <button class="google-btn">
        <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google icon">
        Sign Up with Google
      </button>

      <div class="divider">Or</div>

      <form action="{{Route('Registration')}}" method="POST">
        @csrf
         <div class="form-group">
          <input type="text" placeholder="Enter your Name" name="name">
        </div>

        <div class="form-group">
          <input type="email" placeholder="Enter your Email" name="email" >
        </div>

        <div class="form-group">
          <input type="password" placeholder="Password" name="password" >
        </div>


        <button type="submit" class="login-btn">Sign in</button>
      </form>

      <div class="signup-text">
        You have all ready Account? <a href="{{Route('login')}}">Login</a>
      </div>
    </div>
</div>
</div>

{{-- @endsection --}}