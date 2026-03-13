<link rel="stylesheet" href="{{ asset('css/adminpanal.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="update-container">
  <div class="card-update shadow-lg p-5 bg-white rounded-2xl w-75 mx-auto mt-4">
    <h2 class="fw-bold mb-4">Update Doctor Schedule</h2>

    @if(session('success'))
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: "{{ session('success') }}",
          showConfirmButton: false,
          timer: 2000
        }).then(() => {
          window.location.href = "{{ route('sheduleData') }}";
        });
      });
    </script>
    @endif

    <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Doctor --}}
      <div class="mb-3">
        <label class="form-label fw-bold">Doctor</label>
        <select name="doctor_id" class="form-control" required>
          <option value="">-- Select Doctor --</option>
          @foreach($doctors as $doctor)
            <option value="{{ $doctor->id }}"
              {{ $schedule->doctor_id == $doctor->id ? 'selected' : '' }}>
              {{ $doctor->name }}
            </option>
          @endforeach
        </select>
        @error('doctor_id')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      {{-- Dates --}}
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label fw-bold">Available From</label>
          <input type="date" name="available_from" class="form-control" value="{{ $schedule->available_from }}" required>
          @error('available_from')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label fw-bold">Available To</label>
          <input type="date" name="available_to" class="form-control" value="{{ $schedule->available_to }}" required>
          @error('available_to')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>
      </div>

      {{-- Times --}}
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label fw-bold">Start Time</label>
          <input type="time" name="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
          @error('start_time')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label fw-bold">End Time</label>
          <input type="time" name="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
          @error('end_time')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>
      </div>

      {{-- Slots --}}
      <div class="mb-3">
        <label class="form-label fw-bold">Total Slots</label>
        <input type="number" name="total_slots" class="form-control" min="1" value="{{ $schedule->total_slots }}" required>
        @error('total_slots')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      {{-- Availability --}}
      <div class="mb-3">
        <label class="form-label fw-bold">Is Available?</label>
        <select name="is_available" class="form-control" required>
          <option value="1" {{ $schedule->is_available == 1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $schedule->is_available == 0 ? 'selected' : '' }}>No</option>
        </select>
      </div>

      <div class="mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        <button type="submit" class="btn btn-success">Update Schedule</button>
      </div>
    </form>
  </div>
</div>
