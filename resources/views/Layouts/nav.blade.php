<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>

    {{-- CSS File --}}

    {{-- Js File --}}
    <script type="module" src="{{ asset('js/main.js') }}"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    {{-- GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>

<header>
    <div class="navbar">
        <div class="logo-img">
            <div class="logo-dental-img">
                <img src="{{ asset('assets/dental-logo.png') }}" alt="Logo">
                {{-- <img src="{{ asset('assets/logobook.jpg') }}" alt="Logo"> --}}
            </div>
            {{-- <img src="public/asset/logobook.jpg" alt=""> --}}
            {{-- <h2>WellBook</h2> --}}
            <h2>Agilent</h2>
        </div>

        <div class="nav-items">
            <ul>
                <li><a href="{{ route('go.encrypted', ['token' => Crypt::encryptString('home')]) }}">
                        Home
                    </a></li>
                <li><a href="{{ route('go.encrypted', ['token' => Crypt::encryptString('service')]) }}">
                        Services
                    </a></li>
                </li>
                {{-- <li><a href="#">Blogs</a></li> --}}
                <li><a href="{{ route('go.encrypted', ['token' => Crypt::encryptString('about')]) }}">
                        About
                    </a></li>
                </li>
                <li><a href="{{ route('go.encrypted', ['token' => Crypt::encryptString('contactUs')]) }}">Contact</a></li>
            </ul>
        </div>

        <div class="img-button">
            {{-- Profile Section --}}
            @auth
            @if(Auth::user()->role === 'user')
            <div class="profile-container">
                <div class="man-img">
                    <img src="{{ Auth::user()->profile_image ?? asset('assets/SHARAD.jpg') }}" alt="User">
                </div>
                <div class="profile-popup">
                    <ul>
                        <li>
                            <a href="{{ route('go.encrypted', ['token' => Crypt::encryptString('profile')]) }}">
                                Profile
                            </a>
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @elseif(Auth::user()->role != 'user')
            {
            <script>
                window.location.href = "{{ route('login') }}";
            </script>
            }

            @endif
            @else
            <div class="profile-container">
                <div class="man-img">
                    {{-- <img src="{{ asset('assets/guest.jpeg') }}" alt="Guest"> --}}
                    <img src="{{ Auth::check() ? asset('storage/' . Auth::user()->profile_image) : asset('assets/guest.jpeg') }}"
     alt="Profile"
     class="profile-img">

                </div>
                <div class="profile-popup">
                    <ul>

                        <li>
                            <a href="{{ route('go.encrypted', ['token' => Crypt::encryptString('/login')]) }}">
                                User Login
                            </a>

                        </li>
                        <li>
                            <a href="{{ route('go.encrypted', ['token' => Crypt::encryptString('/register')]) }}">
                                Register
                            </a>

                        </li>
                        <li>
                            <a href="{{ route('DoctorLogin') }}">
                                Doctor Login
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endauth

            <!-- @if(Auth::check())
            <button class="book-btn">
                <a href="{{ route('appointments.index') }}">Book Now</a>
            </button>
            @else
             <script>
                window.location.href = "{{ route('login') }}";
            </script>
            @endif -->

            <button class="book-btn">
                <a href="{{route('appointments.index')}}"> Book Now</a>
            </button>
        </div>
    </div>
</header>

@yield('main-contant')
@extends('layouts.footer')
