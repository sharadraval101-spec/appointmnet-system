<link rel="stylesheet" href="{{ asset('css/adminpanel.css') }}">
{{-- Js File --}}
<!-- <script type="module" src="{{ asset('js/main.js') }}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"
    integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/main.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="top-navbar">
    <h1>Admin Panel</h1>
</div>

<!-- Layout -->
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">

        {{-- For Admin --}}
        @if (auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-line nav-icon"></i><span>
                    Dashboard</span></a>
            <a href="{{ route('userdata') }}"><i class="fa-solid fa-user nav-icon"></i><span> Users</span></a>
            <a href="{{ route('services') }}"><i class="fa-solid fa-hand-holding-heart nav-icon"></i><span>
                    Services</span></a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type-="submit" class="logout-button"
                    style="background: none; border: none; color: #ffff; cursor: pointer; padding-left: 20px; font: inherit; font-size: 1.3rem; font-weight: 600;">
                    <i class="fa-solid fa-lock"></i><span> logout</span>
                </button>
            </form>

            {{-- For Doctor --}}
        @elseif (auth('doctor')->check())
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-line nav-icon"></i><span>
                    Dashboard</span></a>
            <a href="{{ route('doctordata') }}"><i class="fa-solid fa-user-doctor nav-icon"></i><span>
                    Doctors</span></a>
            <a href="{{ route('sheduleData') }}"><i class="fa-solid fa-calendar nav-icon"></i><span> Schedule</span></a>
            <a href="{{ route('ShowAppointments') }}"><i
                    class="fa-solid fa-calendar-check nav-icon"></i><span>Appointment</span></a>
            <form action="{{ route('doctor.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type-="submit" class="logout-button"
                    style="background: none; border: none; color: #ffff; cursor: pointer; padding-left: 20px; font: inherit; font-size: 1.3rem; font-weight: 600;">
                    <i class="fa-solid fa-lock"></i><span> logout</span>
                </button>
            </form>
        @endif

    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('admin-content')
    </div>
</div>
