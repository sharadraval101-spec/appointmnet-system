@extends('adminpenal.navbar')

@section('admin-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card">
  <!-- Header with title + Add button + Search bar -->
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2>User Management</h2>
    <a href="{{ route('userdata.print') }}" target="_blank" class="btn" style="background-color: #011632 ; color: #ffffff; border: 1px solid #ccc;">Download UserInfo</a>
    <div class="user-searchbar d-flex gap-2">
      <!-- Search Bar -->
      <input type="text" id="userearch" placeholder="Search user..."
             class="search-bar form-control"
             style="padding: 6px 10px; border-radius: 6px; border: 1px solid #ccc;">
      <a href="{{route('adduser')}}" class="btn add-user">+ Add User</a>
    </div>
  </div>

  <table class="user-table table table-bordered mt-3" id="userTable">
    <thead class="table-light">
      <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>
          <img src="{{ asset('assets/SHARAD.jpg') }}" alt="User" width="40" class="rounded-circle">
        </td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Update</a>
        </td>
        <td>
          <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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
