@extends('layouts.nav')
<script src="../js/main.js"></script>
@section('main-contant')
    <!-- Hero -->
    <div class="hero">
        <h1>Your Health, Our Priority</h1>
        <p>Providing trusted healthcare with expert doctors & modern facilities</p>
    </div>

    <!-- About -->
    <section class="about_modern">
        <div class="about_glass">
            <div class="about_text">
                <span class="tagline">Who We Are</span>
                <h2>Committed to Exceptional Healthcare</h2>
                <p>
                    We combine advanced medical technology, experienced specialists, and compassionate care
                    to deliver a truly world-class healthcare experience. Every patient is treated with
                    precision, dedication, and respect.
                </p>
                <p>
                    Our facilities feature modern diagnostic systems and a team focused on ensuring safe
                    and personalized treatment—making your health our top priority.
                </p>
                <a href="#" class="btn_explore">Explore More</a>
            </div>
            <div class="about_visual">
                <div class="floating_circle"></div>
                <img src="assets/service1.jpeg" alt="Modern Healthcare Facility">
            </div>
        </div>
    </section>



    <!-- Doctors -->
    <section>
        <h2>Meet Our Doctors</h2>
        <div class="doctors">
            @foreach ($doctors as $dd)
                <div class="doctor-card">
                    <img src="{{ $dd->profile_image ? asset('assets/' . $dd->profile_image) : asset('assets/doctorimage.png') }}"
                        alt="">
                    <h4>{{ $dd->name }}</h4>
                    <p>( {{ $dd->specialization }} )</p>
                    <p>Experience : {{ $dd->experience }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Stats -->
    {{-- <section>
        <h2>Our Achievements</h2>
        <div class="stats">
            <div class="stat">
                <h3 class="counter" data-target="5000">0</h3>
                <p>Happy Patients</p>
            </div>
            <div class="stat">
                <h3 class="counter" data-target="20">0</h3>
                <p>Years Experience</p>
            </div>
            <div class="stat">
                <h3 class="counter" data-target="50">0</h3>
                <p>Qualified Doctors</p>
            </div>
            <div class="stat">
                <h3 class="counter" data-target="100">0</h3>
                <p>Medical Services</p>
            </div>
        </div>
    </section> --}}
    <section class="stats_section">
        <div class="stats">
            <div class="stat">
                <div class="stat_icon"><i class="fa-solid fa-user"></i></div>
                <h3 class="counter" data-target="5000">0</h3>
                <p>Happy Patients</p>
            </div>
            <div class="stat">
                <div class="stat_icon"><i class="fa-solid fa-calendar-check"></i></div>
                <h3 class="counter" data-target="20">0</h3>
                <p>Years Experience</p>
            </div>
            <div class="stat">
                <div class="stat_icon"><i class="fa-solid fa-user-doctor"></i></div>
                <h3 class="counter" data-target="50">0</h3>
                <p>Qualified Doctors</p>
            </div>
            <div class="stat">
                <div class="stat_icon"><i class="fa-solid fa-stethoscope"></i></div>
                <h3 class="counter" data-target="100">0</h3>
                <p>Medical Services</p>
            </div>
        </div>
    </section>


    <!-- Call to Action -->
    <section class="cta">
        <h2>Book Your Appointment Today</h2>
        <p>Get access to expert healthcare with a single click</p>
        <!-- <a href="{{ route('appointments.index') }}"><button>Book Now </button></a> -->
    </section>

    <style>
        .counter {
            font-size: 2rem;
            font-weight: 700;
        }

        .stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .stat {
            background: #fff;
            padding: 16px;
            border-radius: 8px;
            text-align: center;
            min-width: 140px;
        }
    </style>

    <!-- Robust counter script: put before </body> -->
    <script>
        (function() {
            // Run after DOM ready
            function domReady(fn) {
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', fn);
                } else {
                    fn();
                }
            }

            domReady(function() {
                const counters = Array.from(document.querySelectorAll('.counter'));
                if (!counters.length) return; // nothing to do

                // Normalize and parse target value safely
                function parseTarget(el) {
                    const raw = el.getAttribute('data-target') || '0';
                    // Remove commas, spaces and non-number chars except dot
                    const cleaned = String(raw).replace(/[^0-9.-]+/g, '');
                    const n = Number(cleaned);
                    return Number.isFinite(n) ? n : 0;
                }

                // Animation using requestAnimationFrame for smoothness
                function animateCounter(el, target, duration) {
                    const start = performance.now();
                    const initialText = el.innerText.trim();
                    const startValue = Number(initialText.replace(/[^0-9.-]+/g, '')) || 0;
                    const delta = target - startValue;
                    if (delta === 0) {
                        el.innerText = target;
                        return;
                    }

                    function step(now) {
                        const progress = Math.min((now - start) / duration, 1);
                        // easeOutCubic
                        const eased = 1 - Math.pow(1 - progress, 3);
                        const current = Math.round(startValue + delta * eased);
                        el.innerText = current;
                        if (progress < 1) {
                            requestAnimationFrame(step);
                        } else {
                            el.innerText = target; // ensure exact final value
                        }
                    }
                    requestAnimationFrame(step);
                }

                // Start all counters
                function startAllCounters() {
                    counters.forEach((el) => {
                        // guard: don't restart if already done
                        if (el.dataset.started === 'true') return;
                        const target = parseTarget(el);
                        const duration = Math.max(800, Math.min(3000, Math.floor(target / 1) *
                            10)); // adapt duration
                        animateCounter(el, target, duration);
                        el.dataset.started = 'true';
                    });
                }

                // If IntersectionObserver available, animate when visible; otherwise start immediately
                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver((entries, obs) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                startAllCounters();
                                obs.disconnect();
                            }
                        });
                    }, {
                        threshold: 0.3
                    });
                    // observe the stats section if present, otherwise observe first counter
                    const section = document.querySelector('.stats_section') || counters[0];
                    observer.observe(section);
                } else {
                    // fallback
                    startAllCounters();
                }
            });
        })();
    </script>
@endsection
