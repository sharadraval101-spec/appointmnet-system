@extends('adminpenal.navbar')

@section('admin-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js" integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="card">
  <!-- Header with title + Add button + Search bar -->
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 style="font-size: 2.5rem; margin: 20px;">Dashboard</h2>
  </div>
   <div class="container-dashboard">
   
    <div class="dash-grid">

      <!-- Users card -->
      <div class="dash-card" role="article" aria-label="Users">
        <div class="icon-box" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M20 21c0-3.866-3.582-7-8-7s-8 3.134-8 7" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div>
          <div class="label">Users</div>
          <div class="count" data-target="{{ $users }}">{{ $users }}</div>
        </div>
        <div class="meta">Total</div>
      </div>

      <!-- Services card -->
      <div class="dash-card" role="article" aria-label="Services">
        <div class="icon-box" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
            <path d="M3 7h18M7 3v4M17 3v4M12 21v-6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div>
          <div class="label">Services</div>
          <div class="count" data-target="{{ $services }}">{{ $services }}</div>
        </div>
        <div class="meta">Total</div>
      </div>

      <!-- Schedules card -->
      <div class="dash-card" role="article" aria-label="Schedules">
        <div class="icon-box" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
            <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.2"/>
            <path d="M16 3v4M8 3v4M3 11h18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div>
          <div class="label">Schedules</div>
          <div class="count" data-target="{{ $schedules }}">{{ $schedules }}</div>
        </div>
        <div class="meta">total</div>
      </div>

      <!-- <div class="dash-card" role="article" aria-label="Appointments">
        <div class="icon-box" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
            <path d="M8 7h8M8 11h8M8 15h5M4 5h16v14H4z" stroke="currentColor" stroke-width="1.2"/>
          </svg>
        </div>
        <div>
          <div class="label">Appointments</div>
          <div class="count" data-target="192">192</div>
        </div>
        <div class="meta">Pending</div>
      </div> -->

      <!-- Doctors -->
      <div class="dash-card" role="article" aria-label="Doctors">
        <div class="icon-box" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="1.2"/>
            <path d="M5 21v-2a7 7 0 0 1 14 0v2" stroke="currentColor" stroke-width="1.2"/>
          </svg>
        </div>
        <div>
          <div class="label">Doctors</div>
          <div class="count" data-target="{{ $doctor }}">{{ $doctor }}</div>
        </div>
        <div class="meta">Available</div>
      </div>

      <!-- Patients -->
      <div class="dash-card" role="article" aria-label="Patients">
        <div class="icon-box" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
            <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10z" stroke="currentColor" stroke-width="1.2"/>
            <path d="M21 21c0-4.4-4.5-8-9-8s-9 3.6-9 8" stroke="currentColor" stroke-width="1.2"/>
          </svg>
        </div>
        <div>
          <div class="label">Patients</div>
          <div class="count" data-target="{{ $appointments }}">{{ $appointments }}</div>
        </div>
        <div class="meta">Registered</div>
      </div>

    </div>
  </div>
  <!-- <script>
    
document.querySelectorAll('.count').forEach(el => {
    const target = parseInt(el.dataset.target || el.textContent || 0, 10);
    let current = 0;
    const duration = 800;
    const stepTime = Math.max(12, Math.floor(duration / (target || 1)));
    const step = () => {
        current += Math.ceil(target / (duration / stepTime));
        if (current >= target) {
            el.textContent = target;
        } else {
            el.textContent = current;
            requestAnimationFrame(step);
        }
    };
    requestAnimationFrame(step);
});
  </script> -->
  
@endsection