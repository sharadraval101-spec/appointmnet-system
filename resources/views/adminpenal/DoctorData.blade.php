{{-- @extends('adminpanal.navbar') --}}
{{-- @extends('adminpenal.navbar') --}}
@extends('adminpenal.navbar')

@section('admin-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card">
  <!-- Header with title + Add button + Search bar -->
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2>Doctor Management</h2>
    <a href="{{ route('doctordata.print') }}" target="_blank" class="btn" style="background-color: #011632 ; color: #ffffff;  border: 1px solid #ccc;">Download as PDF</a>
    <div class="user-searchbar d-flex gap-2">
      <!-- Search Bar -->
      <input type="text" id="userearch" placeholder="Search user..."
             class="search-bar form-control"
             style="padding: 6px 10px; border-radius: 6px; border: 1px solid #ccc;">
      <a href="{{route('adddoctor')}}" class="btn add-user">+ Add Doctor</a>
    </div>
  </div>

  <table class="user-table table table-bordered mt-3" id="userTable">
    <thead class="table-light">
      <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>qualification</th>
        <th>specialization	</th>
        <th>experience</th>
        <th>description</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach($doctors as $doctor)
      <tr>
        <td>{{ $doctor->id }}</td>
        <td>
          <img src="{{ $doctor->profile_image ? asset('assets/' . $doctor->profile_image) : asset('assets/doctorimage.png') }}"
     alt="Doctor" width="40" class="rounded-circle">
        </td>
        <td>{{ $doctor->name }}</td>
        <td>{{ $doctor->email }}</td>
        <td>{{ $doctor->qualification }}</td>
        <td>{{ $doctor->specialization }}</td>
        <td>{{ $doctor->experience }}</td>
        <td>{{ $doctor->description }}</td>

        <td>
          <a href="{{ route('doctor.edit',$doctor->id) }}" class="btn btn-primary btn-sm">Update</a>
        </td>
        <td>
          <form action="{{ route('doctor.destroy',$doctor->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this user?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- JavaScript for search filter -->
<script>
  document.getElementById("userearch").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#userTable tbody tr");

    rows.forEach(row => {
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(filter) ? "" : "none";
    });
  });
</script>
@endsection
