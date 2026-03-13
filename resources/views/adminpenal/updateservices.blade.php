<link rel="stylesheet" href="{{ asset('css/adminpanal.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> --}}

<div class="update-container">
  <div class="card-update shadow-lg p-5 bg-white rounded-2xl w-75 mx-auto mt-4">
    <h2 class="fw-bold mb-4">Update Service</h2>

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

    <form action="{{route('services.update', $service->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
        @method('PUT')
      <div class="mb-3">
        <label class="form-label fw-bold">Service Name</label>
        <input type="text" class="form-control" name="service_name" value="{{ $service->service_name}}" placeholder="Enter service name" required>
        @error('service_name')
          <div class="text-danger small" style="color: red">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Service Description</label>
        <textarea class="form-control" name="description" value="{{ $service->description }}"  placeholder="Enter service description"></textarea>
        @error('description')
          <div class="text-danger small" style="color: red">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Image</label>
        <input type="file" class="form-control" value="{{$service->service_image}}" name="service_image" accept="image/*">
        @error('service_image')
          <div class="text-danger small" style="color: red">{{ $message }}</div>
        @enderror
        </div>


      <div class="btn">
        <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        <button type="submit" class="btn btn-success">Update Service</button>
      </div>
    </form>
  </div>
</div>
