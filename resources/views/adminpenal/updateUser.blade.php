{{-- @extends('adminpenal.navbar') --}}


{{-- @section('admin-content') --}}
{{-- {{{ dd($user) }} --}}
<link rel="stylesheet" href="{{ asset('css/adminpanal.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="update-container">

  <div class="card-update shadow-lg p-5 bg-white rounded-2xl w-75 mx-auto mt-4">
    <h2 class="fw-bold mb-4">Update User</h2>
    @if(session('success'))
    <script>
      document.addEventListener("DOMContentLoaded", function () {
      Swal.fire({
        icon: 'success',
        title: 'Updated!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
      }).then(() => {
        // Redirect after success
        window.location.href = "{{ route('userdata') }}";
      });
      });
    </script>
  @endif
    <form action="{{ route('update', $user->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label fw-bold">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
      </div>
      {{--
      Uncomment if you add profile image later
      <div class="mb-3">
        <label class="form-label fw-bold">Profile Image</label>
        <input type="file" class="form-control" name="image">
        @if($user->image)
        <img src="{{ asset('uploads/'.$user->image) }}" class="mt-3 rounded-circle" width="100">
        @endif
      </div> --}}


      <div class="btn">
        <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>
  </div>
</div>
{{-- @endsection --}}