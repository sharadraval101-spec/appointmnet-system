<form action="{{ route('appointments.store') }}" method="POST">
  @csrf

  {{-- Doctor --}}
  <div class="mb-3">
    <label class="form-label fw-bold">Doctor</label>
    <select name="doctor_id" class="form-control" required>
      <option value="">-- Select Doctor --</option>
      @foreach($doctors as $doctor)
        <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->specialization ?? '' }})</option>
      @endforeach
    </select>
  </div>

  {{-- Patient Details --}}
  <div class="mb-3">
    <label class="form-label fw-bold">Patient Name</label>
    <input type="text" class="form-control" name="name" placeholder="Enter patient name" required>
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Enter patient email">
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold">Phone</label>
    <input type="text" class="form-control" name="phone" placeholder="Enter patient phone" required>
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold">Gender</label>
    <select name="gender" class="form-control" required>
      <option value="">-- Select --</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold">Age</label>
    <input type="number" class="form-control" name="age" placeholder="Enter age" min="0" max="120">
  </div>

  {{-- Health Concern --}}
  <div class="mb-3">
    <label class="form-label fw-bold">Health Concern</label>
    <textarea class="form-control" name="health_concern" rows="2" placeholder="Enter symptoms or issue"></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold">Extra Notes</label>
    <textarea class="form-control" name="extra_notes" rows="2" placeholder="Optional notes"></textarea>
  </div>

  {{-- Appointment Info --}}
  <div class="mb-3">
    <label class="form-label fw-bold">Appointment Date</label>
    <input type="date" class="form-control" name="appointment_date" required>
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold">Appointment Time</label>
    <input type="time" class="form-control" name="appointment_time" required>
  </div>

  {{-- Default status hidden --}}
  <input type="hidden" name="status" value="pending">

  {{-- Submit --}}
  <div class="btn">
    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
    <button type="submit" class="btn btn-success">Book</button>
  </div>
</form>
