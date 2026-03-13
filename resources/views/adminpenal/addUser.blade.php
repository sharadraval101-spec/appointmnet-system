{{-- @extends('adminpenal.navbar') --}}
{{-- @section('admin-content') --}}
<link rel="stylesheet" href="{{ asset('css/adminpanal.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="update-container">
  <div class="card-update shadow-lg p-5 bg-white rounded-2xl w-75 mx-auto mt-4">
    <h2 class="fw-bold mb-4">Add User</h2>

    {{-- SweetAlert Success --}}
   @if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            // redirect after alert (example: back to user list)
            window.location.href = "{{ route('userdata') }}";
        });
    });
</script>
@endif

    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-bold">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter user name" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter user email" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter Your Password" required>
      </div>



      <div class="btn">
        <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        <button type="submit" class="btn btn-success">Add</button>
      </div>
    </form>
  </div>
</div>
{{-- @endsection --}}
