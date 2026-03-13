<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Doctor</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f0f4ff;
    }

    .update-container {
      min-height: 100vh;
      /* full height */
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .card-update {
      width: 100%;
      max-width: 1100px;
      border-radius: 18px;
      /* rounded corners */
      background: linear-gradient(135deg, #E6F6FE, #ffffff);
      padding: 2.5rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .card-update h2 {
      font-size: 30px;
      text-align: center;
      font-weight: 700;
      color: #222;
      margin-bottom: 25px;
      border-bottom: 2px solid #007bff;
      padding-bottom: 10px;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 6px;
    }

    .form-control {
      border-radius: 10px;
      border: 1px solid #ccc;
      padding: 12px;
      font-size: 15px;
      transition: all 0.2s ease-in-out;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 6px rgba(0, 123, 255, 0.25);
    }

    .btn {
      border-radius: 10px;
      padding: 10px 22px;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-light:hover {
      background: #f0f0f0;
    }

    .btn-success {
      background: #28a745;
      border: none;
    }

    .btn-success:hover {
      background: #218838;
    }
  </style>
</head>

<body>

  <div class="update-container">
    <div class="card-update">
      <h2>Update Doctor</h2>

      {{-- SweetAlert Success --}}
      @if(session('success'))
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          Swal.fire({
            icon: 'success',
            title: 'Doctor Updated!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
          }).then(() => {
            window.location.href = "{{ route('doctordata') }}";
          });
        });
      </script>
      @endif

      <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
          {{-- Name --}}
          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $doctor->name) }}" required>
          </div>

          {{-- Email --}}
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $doctor->email) }}" required>
          </div>

          {{-- Password (optional) --}}
          <div class="col-md-6">
            <label class="form-label">Password <small>(leave blank to keep current)</small></label>
            <input type="password" class="form-control" name="password" placeholder="Enter new password">
          </div>

          {{-- Specialization --}}
          <div class="col-md-6">
            <label class="form-label">Specialization</label>
            <input type="text" class="form-control" name="specialization" value="{{ old('specialization', $doctor->specialization) }}">
          </div>

          {{-- Qualification --}}
          <div class="col-md-6">
            <label class="form-label">Qualification</label>
            <input type="text" class="form-control" name="qualification" value="{{ old('qualification', $doctor->qualification) }}">
          </div>

          {{-- Experience --}}
          <div class="col-md-6">
            <label class="form-label">Experience (Years)</label>
            <input type="number" class="form-control" name="experience" value="{{ old('experience', $doctor->experience) }}" min="0">
          </div>

          {{-- Description --}}
          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description', $doctor->description) }}</textarea>
          </div>

          {{-- Phone --}}
          <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $doctor->phone) }}">
          </div>

          {{-- Status --}}
          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
              <option value="active" {{ old('status', $doctor->status) == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ old('status', $doctor->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>

          {{-- Profile Image --}}
          <div class="col-12">
            <label class="form-label">Profile Image</label>
            <input type="file" class="form-control" value="" name="profile_image" accept="image/*">
            @if($doctor->profile_image)
            <small class="d-block mt-1">Current :<img src="{{ $doctor->profile_image ? asset('assets/' . $doctor->profile_image) : asset('assets/default.png') }}"
                alt="Service Image" width="100" height="100"></small>
            <!-- <small class="d-block mt-1">Current: <img src="{{ $doctor->profile_image }}" alt="Profile" width="100"></small> -->
            @endif
          </div>
        </div>

        {{-- Buttons --}}
        <div class="d-flex justify-content-between mt-4">
          <a href="{{ url()->previous() }} " class="btn btn-light">Cancel</a>
          <button type="submit" class="btn btn-success">Update Doctor</button>
        </div>
      </form>
    </div>
  </div>

</body>

</html>