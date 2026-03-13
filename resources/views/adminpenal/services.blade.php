@extends('adminpenal.navbar')

@section('admin-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card">
  <!-- Header with title + Add button + Search bar -->
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2>Service Management</h2>
    <a href="{{ route('services.print') }}" target="_blank" class="btn" style="background-color: #011632 ; color: #ffffff; border: 1px solid #ccc;">Download as PDF</a>
    <div class="user-searchbar d-flex gap-2">
      <!-- Search Bar -->
      <input type="text" id="userearch" placeholder="Search Service..."
             class="search-bar form-control"
             style="padding: 6px 10px; border-radius: 6px; border: 1px solid #ccc;">
      <a href="{{route('addService')}}" class="btn add-user">+ Add Service </a>
    </div>
  </div>

  <table class="user-table table table-bordered mt-3" id="userTable">
    <thead class="table-light">
      <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Services Name</th>
        <th>Description</th>
        {{-- <th></th> --}}
        <th style="text-align: center;" >Update</th>
        <th>Delete</th>

      </tr>
    </thead>
    <tbody>
      @foreach($services as $service)
      <tr>
        <td>{{ $service->id }}</td>
      <td> <img src="{{ $service->service_image ? asset('assets/' . $service->service_image) : asset('assets/default.png') }}"
     alt="Service Image" width="40" class="rounded-circle">
</td>
        <td>{{ $service->service_name }}</td>
        <td>{{ $service->description}}</td>
        {{-- <td>{{ $service->service_image }}</td> --}}
        <td>
          <a href="{{route('services.edit', $service->id)}}" class="btn btn-primary btn-sm">Update</a>
        </td>
        <td>
          <form action="{{route('services.destroy', $service->id)}}" method="POST"
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
  let matchFound = false; // flag to track matches

  rows.forEach(row => {
    let text = row.innerText.toLowerCase();
    if (text.includes(filter)) {
      row.style.display = "";
      matchFound = true;
    } else {
      row.style.display = "none";
    }
  });

  // If no rows match, show SweetAlert
  if (!matchFound && filter.trim() !== "") {
    Swal.fire({
      icon: "warning",
      title: "No Data Found",
      text: "No matching record found for your search.",
      showConfirmButton: false,
      timer: 1000
    });
  }
});
</script>
@endsection
