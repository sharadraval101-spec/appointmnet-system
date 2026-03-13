{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="min-vh-100 py-5" style="background: linear-gradient(135deg, #eef2ff, #f3e8ff, #ffe4f1);">
    <div class="container">
        <div class="mx-auto bg-white rounded-4 shadow-lg p-5 border border-light" style="max-width: 650px;">

            {{-- Header --}}
            <div class="text-center mb-4">
                <h1 class="fw-bold text-dark">Edit Your Profile</h1>
                <p class="text-muted">Update your personal information and profile picture</p>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success text-center fw-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Profile Image --}}
                <div class="text-center mb-4">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/guest.jpeg') }}"
                        class="rounded-circle shadow-sm border border-3 border-light"
                        style="width: 120px; height: 120px; object-fit: cover;" id="previewImage">
                        {{-- <img src="{{ asset('storage/' . (Auth::user()->profile_image ?? '')) }}"
                            onerror="this.src='{{ asset('assets/guest.jpeg') }}'"
                            class="rounded-circle shadow-sm border border-3 border-light"
                            style="width: 120px; height: 120px; object-fit: cover;"> --}}

                    <div class="mt-3">
                        <label class="form-label fw-semibold">Change Profile Picture</label>
                        <input type="file" name="profile_image" class="form-control" onchange="previewFile(event)">
                        @error('profile_image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>



                {{-- Full Name --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                        class="form-control p-3 shadow-sm" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                        class="form-control p-3 shadow-sm" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between align-items-center mt-4">

                    <a href="{{ url()->previous() }}" class="text-primary fw-semibold text-decoration-none">
                        ← Back to Profile
                    </a>

                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm"
                        style="background: linear-gradient(to right, #4f46e5, #7c3aed); border: none;">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function previewFile(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById("previewImage").src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

{{-- @endsection --}}
