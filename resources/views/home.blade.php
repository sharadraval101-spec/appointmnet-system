@extends('layouts.nav')
@push('cdn')@endpush
@section('main-contant')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif

    <div class="main-contant">
        <div class="main-section-1">
            <div class="text-contant-main">
                <div class="main-text-heading">
                    <h1> Get ready for your best ever Dental Experience!</h1>
                </div>
                <div class="small-text">
                    We use only the best quality materials on the market in order to provide the best products to our
                    patients, So don’t worry about anything and book yourself.
                </div>
                <div class="book-appointment-contact">
                    <a href="{{route('appointments.index')}}"><button>Book and Appointment</button></a>
                    <div class="contact-icon">
                        <i class="fa-duotone fa-solid fa-phone"
                            style="--fa-primary-color: #1376F8; --fa-secondary-color: #1376F8;"></i>
                    </div>
                    <div class="contact-info">
                        <p>Dental 24H Emergency</p>
                        <span>0900-78601</span>
                    </div>
                </div>
                <div class="main-section-doctor-info">
                    <div class="doctor-info">
                        <div class="doct-info-img">
                            <img src="../assets/SHARAD.jpg" alt="">
                        </div>
                        <div class="doct-info-text">
                            <span>Sharad Raval</span>
                            <p>Sr Dental</p>
                        </div>
                        <div class="doct-info-linkdin">
                            <i class="fa-brands fa-linkedin"></i>
                        </div>
                    </div>
                    <p>Top Quailty dental treatment done by field experts, Highly Recommended for everyone</p>

                </div>
            </div>
            <div class="contant-img-main">
                <div class="round-for-img">
                    <img src="../assets/dental-doc.png" alt="">
                </div>
            </div>
        </div>

        {{-- part 2 --}}


        <div class="our-dental-info">
            <div class="dental_info">
                <div class="info-page">
                    <div class="teeth-icon">
                        <i class="fa-solid fa-tooth"></i>
                    </div>
                    <h2>Root Canal Treatment</h2>
                    <p>Root canal treatment (endodontics) is a dental procedure used to treat infection at the centre of a
                        tooth.</p>
                    <a href="">Learn More </a>
                </div>

                <div class="info-page">
                    <div class="teeth-icon">
                        <i class="fa-solid fa-tooth"></i>
                    </div>
                    <h2>Cosmetic Dentist</h2>
                    <p>Cosmetic dentistry is the branch of dentistry that focuses on improving the appearance of your smile.
                    </p>
                    <a href="">Learn More </a>
                </div>

                <div class="info-page">
                    <div class="teeth-icon">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <h2>Dental Implants</h2>
                    <p>A dental implant is an artificial tooth root that’s placed into your jaw to hold a prosthetic tooth
                        or bridge.</p>
                    <a href="">Learn More </a>
                </div>
            </div>
        </div>

        {{-- Part 3 --}}

        <div class="patients-to-meet">
            <div class="patients-meet-sec-1">
                <div class="about-meet-text-heading">
                    <h2>We’re welcoming new patients and can’t wait to meet you.</h2>
                </div>
                <div class="about-meet-text-small">We use only the best quality materials on the market in order to provide
                    the best products to our patients, So don’t worry about anything and book yourself.</div>
            </div>

            <div class="patients-meet-sec-2">
                {{-- <div class="patients-meet-back-img"> --}}
                    <img src="../assets/meet-img.jpg" alt="" class="">
                </div>
            </div>

            {{-- Part 4 --}}

            <div class="choose_tratment">
                <div class="choose_tratment_container">
                    <div class="patients-meet-sec-2">
                        <img src="../assets/choose_tratment.jpg" alt="" class="">
                    </div>
                    <div class="choose_container_for_text">
                        <div class="choose_treatment_heading_text">
                            <h2>Why choose Smile for all your Health treatments?</h2>
                        </div>
                        <div class="choose_tratment_small_text">
                            <p>We use only the best quality materials on the market in order to provide the best products to
                                our patients.</p>
                        </div>
                        <div class="choose_treatment_list">
                            <ul>
                                <li><i class="fa-solid fa-stethoscope"></i> Top quality dental team</li>
                                <li><i class="fa-solid fa-stethoscope"></i> State of the art dental services </li>
                                <li><i class="fa-solid fa-stethoscope"></i> Discount on all dental treatment </li>
                                <li><i class="fa-solid fa-stethoscope"></i> Enrollment is quick and easy </li>
                                <li><i class="fa-solid fa-stethoscope"></i> 24/7 emergency dental services </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Part 5 --}}

            <div class="patients-to-meet" style="margin-top: 10rem; padding: 0px 10rem;">
                <div class="patients-meet-sec-2">
                    <img src="../assets/peaseSmile.png" alt="" class="">
                </div>
                <div class="patients-meet-sec-1">
                    <div class="about-meet-text-heading">
                        <h2 style="font-size: 3rem">We’re welcoming new patients and can’t wait to meet you.</h2>
                    </div>
                    <div class="about-meet-text-small">We use only the best quality materials on the market in order
                        to provide
                        the best products to our patients, So don’t worry about anything and book yourself.</div>
                </div>
            </div>
        </div>

        {{-- Part 6 --}}

        <div class="main_video_contant">
            <div class="video_container">
                <div class="video_heading">
                    <h2>We’re welcoming new patients and can’t wait to meet you.</h2>
                </div>
                <div class="video_small_text">
                    <p>We use only the best quality materials on the market in order to provide the best products to our
                        patients.</p>
                </div>
                <div class="video_player">
                    <iframe width="1000" height="500" style="border-radius: 20px;"
                        src="https://www.youtube.com/embed/2W1dY0xiVcg?si=_MVNjXxGi8X8PVqR" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        {{-- Part 7 --}}

        <div class="container_list">
            <h2><span>Frequently Ask Question</span></h2>
            <p class="subtitle">We use only the best quality materials on the market in order to provide the best products
                to our patients.</p>

            <div class="faq-container">
                <div class="faq-item active">
                    <div class="faq-question">
                        <span>Can I see who reads my email campaigns?</span>
                        <span class="icon">−</span>
                    </div>
                    <div class="faq-answer">
                        Lorem ipsum dolor sit amet consectetur. Convallis cras placerat dignissim aliquam massa. Aliquet
                        volutpat rhoncus in convallis consectetur. Cras adipiscing volutpat non hac enim odio enim.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you offer non-profit discounts?</span>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Lorem ipsum dolor sit amet consectetur. Convallis cras placerat dignissim aliquam massa. Aliquet
                        volutpat rhoncus in convallis consectetur. Cras adipiscing volutpat non hac enim odio enim.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Can I see who reads my email campaigns?</span>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Lorem ipsum dolor sit amet consectetur. Convallis cras placerat dignissim aliquam massa. Aliquet
                        volutpat rhoncus in convallis consectetur. Cras adipiscing volutpat non hac enim odio enim.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you offer non-profit discounts?</span>
                        <span class="icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Lorem ipsum dolor sit amet consectetur. Convallis cras placerat dignissim aliquam massa. Aliquet
                        volutpat rhoncus in convallis consectetur. Cras adipiscing volutpat non hac enim odio enim.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
