@extends('Layouts.nav')
@section('main-contant')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.75);
        }

        .heading_text {
            text-align: center;
        }

        .main_container {
            padding-top: 100px;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 py-12 px-4 main_container">
        <div class="max-w-7xl mx-auto">

            <!-- Header Greeting -->
            <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="heading_text">
                    <h1 class="text-4xl font-extrabold text-slate-800">
                        Hello, <span
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="text-slate-600 mt-3 text-lg ">Here's what's happening with your appointments today.</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <div class="px-6 py-3 bg-white/80 glass border border-white/50 rounded-2xl shadow-lg shadow-indigo-100">
                        <p class="text-sm font-semibold text-slate-700">{{ now()->format('l, F j, Y') }}</p>
                        <p class="text-xs text-slate-500">{{ now()->format('g:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Profile Sidebar -->
                <div class="lg:col-span-4">
                    <div
                        class="bg-white/80 glass border border-white/60 rounded-3xl shadow-xl overflow-hidden sticky top-8 backdrop-blur-xl">
                        <div class="h-40 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                        <div class="relative px-8 pb-10 -mt-16">
                            <div class="flex justify-center">
                                <div class="relative">
                                    <img class="w-36 h-36 rounded-full border-8 border-white shadow-2xl object-cover ring-4 ring-indigo-100"
                                        src="{{ Auth::user()->profile_image ?? asset('assets/SHARAD.jpg') }}"
                                        alt="Profile">
                                    <div
                                        class="absolute bottom-2 right-2 w-10 h-10 bg-green-500 rounded-full border-4 border-white">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-6">
                                <h2 class="text-2xl font-bold text-slate-800">{{ Auth::user()->name }}</h2>
                                <p class="text-slate-500">{{ Auth::user()->email }}</p>
                                <span
                                    class="inline-block mt-3 px-4 py-1 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full">
                                    Patient Account
                                </span>
                            </div>

                            <div class="mt-10 grid grid-cols-1 gap-4">
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-2xl hover:shadow-xl hover:shadow-purple-200 transform hover:-translate-y-1 transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5m-1.414-9.414a2 2 0 1 1 2.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Profile
                                </a>

                                <a href="{{ route('forgotpassword') }}"
                                    class="flex items-center justify-center gap-3 px-6 py-4 bg-white border-2 border-slate-200 text-slate-700 font-medium rounded-2xl hover:bg-slate-50 hover:border-indigo-300 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2zm10-10V7a4 4 0 0 0-8 0v4h8z" />
                                    </svg>
                                    Reset Password
                                </a>

                                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-3 px-6 py-4 text-red-600 hover:bg-red-50 font-medium rounded-2xl border border-red-200 hover:border-red-300 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1" />
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-8 space-y-8">



                    <!-- Upcoming Appointments -->
                    {{-- <div class="bg-white/70 glass backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-8 mb-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-8 flex items-center gap-4">
                            <div class="w-3 h-12 bg-slate-400 rounded-full"></div>
                            Upcoming Appointments
                        </h3>

                        @php
                            $upcoming = collect($appointments)->where('status', 'upcoming');
                        @endphp

                        @if ($upcoming->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold text-slate-500 uppercase tracking-wider border-b-2 border-slate-200">
                                            <th class="pb-4 px-2">Doctor</th>
                                            <th class="pb-4 px-2">Date & Time</th>
                                            <th class="pb-4 px-2 text-right">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach ($upcoming as $appt)
                                            <tr class="hover:bg-slate-50/70 transition">
                                                <td class="py-5 px-2 font-medium text-slate-800">{{ $appt['doctor_name'] }}
                                                </td>
                                                <td class="py-5 px-2 text-slate-600">{{ $appt['date'] }} at
                                                    {{ $appt['time'] }}</td>
                                                <td class="py-5 px-2 text-right">
                                                    <span
                                                        class="px-4 py-1.5 text-xs font-bold text-blue-600 bg-blue-100 rounded-full">
                                                        Upcoming
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-slate-500 py-12 italic text-lg">No upcoming appointments.</p>
                        @endif
                    </div> --}}

                    <!-- Completed Appointments -->
                    <div class="bg-white/70 glass backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-8 flex items-center gap-4">
                            <div class="w-3 h-12 bg-slate-400 rounded-full"></div>
                            Appointment History
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold text-slate-500 uppercase tracking-wider border-b-2 border-slate-200">
                                        <th class="pb-4 px-2">Doctor</th>
                                        <th class="pb-4 px-2">Date & Time</th>
                                        <th class="pb-4 px-2">Email</th>
                                        <th class="pb-4 px-2">Contact</th>
                                        <th class="pb-4 px-2 text-right">Status</th>
                                        <th class="pb-4 px-2 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @if ($appointments->count() > 0)

                                        @foreach ($appointments as $appt)
                                            <tr class="hover:bg-slate-50/70 transition">
                                                <td class="py-5 px-2 font-medium text-slate-800">
                                                    {{ $appt->doctor->name ?? 'N/A' }}
                                                </td>
                                                <td class="py-5 px-2 text-slate-600">
                                                    {{ $appt->appointment_date->format('d-m-y') }} at
                                                    {{ $appt->appointment_time}}
                                                </td>
                                                <td class="py-5 px-2 text-slate-600">
                                                    {{-- {{ $appt->appointment_date->format('Y-m-d') }} at --}}
                                                    {{ $appt->email }}
                                                </td>
                                                <td class="py-5 px-2 text-slate-600">
                                                    {{-- {{ $appt->appointment_date->format('Y-m-d') }} at --}}
                                                    {{ $appt->phone }}
                                                </td>
                                                <td class="py-5 px-2 text-right">
                                                    <span
                                                        class="px-4 py-1.5 text-xs font-bold text-slate-600 bg-slate-100 rounded-full">
                                                        {{ ucfirst($appt->status) }}
                                                    </span>
                                                </td>
                                                <td class="py-5 px-2 text-right">
                                                    <form action="{{ route('appointments.destroy', $appt->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center text-gray-500 py-5">
                                                No appointments found.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>

                        <p class="text-center text-slate-500 py-12 italic text-lg">No past appointments yet.</p>

                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
