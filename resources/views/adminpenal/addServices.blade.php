<link rel="stylesheet" href="{{ asset('css/adminpanal.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> --}}

<div class="update-container">
  <div class="card-update shadow-lg p-5 bg-white rounded-2xl w-75 mx-auto mt-4">
    <h2 class="fw-bold mb-4">Add Service</h2>

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
            window.location.href = "{{ route('services') }}";
          });
        });
      </script>
    @endif

    <form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-bold">Service Name</label>
        <input type="text" class="form-control" name="service_name" placeholder="Enter service name" required>
        @error('service_name')
          <div class="text-danger small" style="color: red">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Service Description</label>
        <textarea class="form-control" name="description" placeholder="Enter service description"></textarea>
        @error('description')
          <div class="text-danger small" style="color: red">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Image</label>
        <input type="file" class="form-control" name="service_image" accept="image/*">
        @error('service_image')
          <div class="text-danger small" style="color: red">{{ $message }}</div>
        @enderror
        {{-- <small class="form-text text-muted">Allowed: JPG, PNG | Max size: 2MB</small> --}}
      </div>


      <div class="btn">
        <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        <button type="submit" class="btn btn-success">Add Service</button>
      </div>
    </form>
  </div>
</div>