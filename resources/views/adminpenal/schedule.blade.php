@extends('adminpenal.navbar')

@section('admin-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <link rel="stylesheet" href="{{ asset('css/adminpanal.css') }}"> -->
<div class="card">

  <div class="card-header d-flex justify-content-between align-items-center">
    <h2>Shedule Management</h2>
    <a href="{{ route('sheduleData.print') }}" target="_blank" class="btn" style="background-color: #011632 ; color: #ffffff; border: 1px solid #ccc;">Download Shedule</a>
    <div class="user-searchbar d-flex gap-2">
      <!-- Search Bar -->
      <input type="text" id="userearch" placeholder="Search user..."
             class="search-bar form-control"
             style="padding: 6px 10px; border-radius: 6px; border: 1px solid #ccc;">
      <a href="{{route('addshedule')}}" class="btn add-user">+ Add Shedule</a>
    </div>
  </div>

  <!-- Table -->
    <table class="user-table table table-bordered table-hover mt-3" id="userTable">
      <thead class="table-light">
        <tr class="text-center">
          <th>ID</th>
          <th>Doctor</th>
          <th>Available From</th>
          <th>Available To</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Total Slots</th>
          <th>Availability</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @forelse($schedules as $schedule)
        <tr>
          <td>{{ $schedule->id }}</td>
          <td>{{ $schedule->doctor->name ?? 'N/A' }}</td>
          <td>{{ \Carbon\Carbon::parse($schedule->available_from)->format('d M Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($schedule->available_to)->format('d M Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
          <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
          <td>{{ $schedule->total_slots }}</td>
          <td>
            @if($schedule->is_available)
              <span class="badge bg-success">Available</span>
            @else
              <span class="badge bg-danger">Unavailable</span>
            @endif
          </td>
          <td>

              <a href="{{ route('schedule.edit' ,$schedule->id ) }}" class="btn btn-primary btn-sm">Edit</a>
              </td>
              <td>
              <form action="{{ route('schedule.delete',$schedule->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="9" class="text-center text-muted py-3">No schedules found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- SweetAlert Success Message -->
@if(session('success'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: "{{ session('success') }}",
      showConfirmButton: false,
      timer: 2000
    });
  });
</script>
@endif

<!-- Search Filter -->
<script>
  document.getElementById("userearch").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#userTable tbody tr");
    let matchFound = false;

    rows.forEach(row => {
      let text = row.innerText.toLowerCase();
      if (text.includes(filter)) {
        row.style.display = "";
        matchFound = true;
      } else {
        row.style.display = "none";
      }
    });

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
