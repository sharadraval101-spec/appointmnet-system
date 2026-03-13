<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Doctor</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Custom CSS -->
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f0f4ff;
    }

    .update-container {
      min-height: 100vh; /* full height */
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .card-update {
      width: 100%;
      max-width: 1100px;
      border-radius: 18px; /* rounded corners */
      background: linear-gradient(135deg, #E6F6FE, #ffffff);
      padding: 2.5rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.12);
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
      box-shadow: 0 0 6px rgba(0,123,255,0.25);
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
      <h2>Add Doctor</h2>

      {{-- SweetAlert Success --}}
      @if(session('success'))
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          Swal.fire({
            icon: 'success',
            title: 'Doctor Added!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
          }).then(() => {
            window.location.href = "";
          });
        });
      </script>
      @endif

      <form action="{{ route('adddoctor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
          {{-- Name --}}
          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter doctor name" required>
          </div>

          {{-- Email --}}
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
          </div>

          {{-- Password --}}
          <div class="col-md-6">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
          </div>

          {{-- Specialization --}}
          <div class="col-md-6">
            <label class="form-label">Specialization</label>
            <input type="text" class="form-control" name="specialization" placeholder="e.g. Dentist, Cardiologist">
          </div>

          {{-- Qualification --}}
          <div class="col-md-6">
            <label class="form-label">Qualification</label>
            <input type="text" class="form-control" name="qualification" placeholder="e.g. MBBS, MD">
          </div>

          {{-- Experience --}}
          <div class="col-md-6">
            <label class="form-label">Experience (Years)</label>
            <input type="number" class="form-control" name="experience" min="0">
          </div>

           <!-- Description field -->
          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" placeholder="Write about the doctor..."></textarea>
          </div>


          {{-- Phone --}}
          <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" placeholder="Enter phone number">
          </div>

          {{-- Status --}}
          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
              <option value="active" selected>Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>

          {{-- Profile Image --}}
          <div class="col-12">
            <label class="form-label">Profile Image</label>
            <input type="file" class="form-control" name="profile_image" accept="image/*">
          </div>
        </div>

        {{-- Buttons --}}
        <div class="d-flex justify-content-between mt-4">
          <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
          <button type="submit" class="btn btn-success">Add Doctor</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
