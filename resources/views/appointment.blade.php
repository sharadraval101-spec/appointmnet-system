<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Appointment Booked!',
        text: '{{ session("success") }}',
        timer: 2000,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "{{ route('home') }}"; // redirect to home
    });
</script>
@endif

<style>
  /* Custom styles for the form layout and responsiveness */
  body {
    font-family: 'Inter', sans-serif;
    background-color: #eef2ff;
    /* Lightest indigo for a fresh background */
  }

  /* Custom focus styles - adding a subtle glow */
  input:focus,
  select:focus,
  textarea:focus {
    border-color: #4f46e5;
    /* Indigo-600 */
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
    /* Indigo glow */
    outline: none;
  }

  .form-group label {
    font-weight: 600;
    color: #1f2937;
    /* Darker gray for better contrast */
  }

  .modern-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .modern-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  }
</style>
<div class="max-w-4xl mx-auto p-4 sm:p-8">
  <header class="text-center mb-8 sm:mb-10 p-4">
    <div class="flex items-center justify-center space-x-3 mb-2">
      <!-- Modern Icon (SVG) -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">Book Your Appointment</h1>
    </div>
    <p class="mt-3 text-lg text-gray-600">A quick and secure way to book your appointment online.</p>
  </header>
  <div class="modern-card bg-white p-6 sm:p-10 rounded-3xl shadow-2xl border border-indigo-100">
    <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm">Preferred Doctor</label>
            <select id="doctor" name="doctor" required class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50">
              <option value="" selected disabled>Select a Specialist</option>
              @foreach($doctors as $d)
              <option value="{{ $d->id }}">{{ $d->name }} {{ $d->specialization ? "({$d->specialization})" : '' }}</option>
              @endforeach
            </select>
            @error('doctor') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
          </div>

          <div>
            <label class="block text-sm">Patient Name</label>
            <input type="text" name="patientName" value="{{ old('patientName') }}" required class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50" placeholder="Full name">
            @error('patientName') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50">
            @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
          </div>
          <div>
            <label class="block text-sm">Phone</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" required class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50">
            @error('phone') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
          <div>
            <label class="block text-sm">Gender</label>
            <select name="gender" class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50">
              <option value="" disabled selected>Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div>
            <label class="block text-sm">Age</label>
            <input type="number" name="age" min="0" max="120" class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50">
          </div>
          <div class="hidden sm:block p-4 bg-indigo-50 rounded-xl border border-indigo-200">
            <p class="text-xs font-semibold text-indigo-700">Confidentiality Notice</p>
            <p class="text-xs text-indigo-600 mt-1">All patient data is encrypted and kept secure.</p>
          </div>
        </div>

        <div>
          <label class="block text-sm">Concern / Reason</label>
          <textarea name="concern" rows="3" class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50">{{ old('concern') }}</textarea>
        </div>

        <div>
          <label class="block text-sm">Attach Documents (optional)</label>
          <input type="file" name="documents[]" multiple class="mt-2 block w-full">
          <p class="text-xs text-gray-500">PDF, JPG, PNG — max 5MB per file</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
          <div>
            <label class="block text-sm">Appointment Date</label>
            <input id="appointmentDate" type="date" name="appointmentDate" required class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50">
            @error('appointmentDate') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
          </div>

          <div>
            <label class="block text-sm">Appointment Time</label>
            <select id="appointmentTime" name="appointmentTime" required class="mt-2 block w-full px-4 py-3 border rounded-xl bg-gray-50">
              <option value="" selected disabled>Select a Time Slot</option>
            </select>
            @error('appointmentTime') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
          </div>
        </div>

        <div>
          <button type="submit" class="w-full py-3 rounded-xl bg-indigo-600 text-white font-bold">Confirm Appointment</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const doctor = document.getElementById('doctor');
    const dateInput = document.getElementById('appointmentDate');
    const timeSelect = document.getElementById('appointmentTime');

    // Set min date to today
    const today = new Date();
    const y = today.getFullYear();
    const m = String(today.getMonth() + 1).padStart(2, '0');
    const d = String(today.getDate()).padStart(2, '0');
    dateInput.min = `${y}-${m}-${d}`;

    async function fetchDoctorSchedule() {
      if (!doctor.value) return;
      try {
        const res = await fetch(`/doctors/${doctor.value}/schedule`);
        const json = await res.json();

        if (json.status === 'ok') {
          // Set min/max for date picker
          dateInput.min = json.available_from;
          dateInput.max = json.available_to;

          Swal.fire({
            icon: 'info',
            title: 'Doctor Schedule',
            html: `
            <p>Available from <b>${json.available_from}</b> to <b>${json.available_to}</b></p>
          `,
            timer: 2500,
            showConfirmButton: false
          });
        } else {
          dateInput.min = `${y}-${m}-${d}`;
          dateInput.removeAttribute('max');
          Swal.fire({
            icon: 'warning',
            title: 'No Schedule Found',
            text: 'This doctor has no active schedule.'
          });
        }
      } catch (err) {
        console.error(err);
      }
    }

    async function fetchSlots() {
      timeSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';
      if (!doctor.value || !dateInput.value) {
        timeSelect.innerHTML = '<option value="" disabled selected>Select a Time Slot</option>';
        return;
      }

      try {
        const res = await fetch(`/doctors/${doctor.value}/slots?date=${encodeURIComponent(dateInput.value)}`);
        const json = await res.json();

        timeSelect.innerHTML = '<option value="" disabled selected>Select a Time Slot</option>';

        if (json.status === 'no_schedule') {
          Swal.fire({
            icon: 'info',
            title: 'Doctor Not Available',
            text: 'This doctor is not available on the selected date.'
          });
          return;
        }
        if (json.status === 'no_slots') {
          Swal.fire({
            icon: 'info',
            title: 'No Slots',
            text: 'No slots available for this doctor on the chosen date.'
          });
          return;
        }
        if (json.status === 'ok' && Array.isArray(json.slots)) {
          json.slots.forEach(s => {
            const opt = document.createElement('option');
            opt.value = s;
            opt.text = formatTime(s);
            timeSelect.appendChild(opt);
          });
        }
      } catch (err) {
        console.error(err);
        timeSelect.innerHTML = '<option value="" disabled selected>Select a Time Slot</option>';
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Could not fetch slots. Try again later.'
        });
      }
    }

    function formatTime(t) {
      const [hh, mm] = t.split(':').map(Number);
      const suffix = hh >= 12 ? 'PM' : 'AM';
      const h12 = ((hh + 11) % 12) + 1;
      return `${String(h12).padStart(2, '0')}:${String(mm).padStart(2, '0')} ${suffix}`;
    }

    doctor.addEventListener('change', () => {
      fetchDoctorSchedule(); // 🔹 new
      fetchSlots();
    });

    dateInput.addEventListener('change', fetchSlots);
  });
</script>
