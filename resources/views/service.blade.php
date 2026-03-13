@extends('layouts.nav')
{{--
<link rel="stylesheet" href="{{ asset('css/service.css') }}"> --}}
@section('main-contant')
    <div class="main_service_container">
        <div class="service_top_container1">
            <div class="service_container_part_1">
                <div class="service_container_part1_heading_text">
                    <h2>Caring For Your Smile Today Tomorrow anf Forever</h2>
                </div>
                <div class="service_container_part1_small_text">
                    <p>"Our Experts team combines skill, technology and compassion to give you the best helth care
                        expriacnce possible.We provide world class helth care solution with passion and personal toch"</p>
                </div>
                <div class="book-appointment-contact">
                    <a href="{{ route('appointments.index') }}"><button>Book and Appointment</button></a>

                </div>
            </div>
            <div class="service_container_part_2">
                <img src="../assets/doctor_png.jpg" alt="">
            </div>
        </div>

        <div class="service_top_container2">
            <div class="service_container_part_3">
                <h2>Our Services</h2>
                <p>We provide a wide range of services to meet your health care needs.</p>
            </div>
            <div class="service_container_part_4">

                @foreach ($services as $service)
                    <div class="service_card">
                        <img src="{{ asset('assets/' . $service->service_image) }}" alt="{{ $service->service_name }}">
                        <h3>{{ $service->service_name }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                @endforeach

                @if ($services->isEmpty())
                    <p
                        style="text-align: center; font-size: 2rem; padding-top: 3rem; color: silver; font-weight: 800; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                        No services available
                    </p>
                @endif

            </div>
        </div>

        <div class="our_client_feedback">
            <h2>What Our Clients Say</h2>

            <div class="feedback_wrapper">
                <button class="scroll_btn left_btn"><i class="fa-solid fa-angle-left"></i></button>
                <div class="client_feedback_container">
                    @foreach ($feedback as $fd)
                        <div class="client_feedback_card">
                            <img src="../assets/thumb.png" alt="">
                            <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{ $fd->feedback }}</p>
                            <h4 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{ $fd->first_name }}</h4>
                        </div>
                    @endforeach
                </div>
                <button class="scroll_btn right_btn"><i class="fa-solid fa-angle-right"></i></button>
            </div>
        </div>
    </div>
    <script>
        const scrollBox = document.querySelector('.client_feedback_container');
        const leftBtn = document.querySelector('.left_btn');
        const rightBtn = document.querySelector('.right_btn');

        rightBtn.addEventListener('click', () => {
            scrollBox.scrollLeft += 300; // moves right
        });

        leftBtn.addEventListener('click', () => {
            scrollBox.scrollLeft -= 300; // moves left
        });
    </script>
@endsection
