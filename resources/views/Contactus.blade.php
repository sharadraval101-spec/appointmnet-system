{{-- @extends('layouts.nav') --}}

    <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Get In Touch</title>

  <!-- Bootstrap CSS -->
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- GSAP -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/contactus.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

</head>

{{-- @section('main-contant') --}}
<body>

  <div class="content-area">
    <h2 class="text-center mb-2">Get In Touch</h2>
    <p class="text-center text-muted mb-5">Book an appointment to treat your teeth right now.</p>

    <div class="row g-4">
      <!-- Left column -->
      <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2798907082!2d-74.25986687835813!3d40.69767006482365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQxJzUxLjYiTiA3NMKwMTUnNDIuMCJX!5e0!3m2!1sen!2sus!4v1616711201791!5m2!1sen!2sus"></iframe>

        <div class="info-box">
          <i class="bi bi-geo-alt-fill"></i>
          <div>
            <h6>Office Address</h6>
            <p class="mb-0">141/A Ring Road Near , Ahemdabad </p>
          </div>
        </div>

        <div class="info-box">
          <i class="bi bi-clock-fill"></i>
          <div>
            <h6>Office Timings</h6>
            <p class="mb-0">Monday - Saturday (9am to 5pm)</p>
          </div>
        </div>

        <div class="info-box">
          <i class="bi bi-envelope-fill"></i>
          <div>
            <h6>Email Address</h6>
            <p class="mb-0">Sharadraval29@gmail.com</p>
          </div>
        </div>

        <div class="info-box">
          <i class="bi bi-telephone-fill"></i>
          <div>
            <h6>Phone Number</h6>
            <p class="mb-0">+91 8758443566</p>
          </div>
        </div>

        <div class="info-box">
          <i class="bi bi-chat-dots-fill"></i>
          <div>
            <h6>Live Chat</h6>
            <p class="mb-0">+21 0984 2599</p>
          </div>
        </div>
      </div>

            <!-- Right column -->

            <div class="col-md-6">

              <div class="form-container">



                  @if (session('success'))

                  <script>

                      Swal.fire({

                          title: 'FeedBack Sent!',

                          text: '{{ session('success') }}',

                          icon: 'success',

                          confirmButtonText: 'OK'

                      })

                  </script>

                  @endif

                                 <form id="gtForm" action="{{ route('feedback.store') }}" method="POST">

                  @csrf

                  <div class="row">

                    <div class="col-md-6 mb-3">

                      <input type="text" class="form-control" name="first_name" placeholder="First name" required>

                    </div>

                    <div class="col-md-6 mb-3">

                      <input type="text" class="form-control" name="last_name" placeholder="Last name" required>

                    </div>

                  </div>



                  <div class="mb-3">

                    <input type="email" class="form-control" name="email" placeholder="Email" required>

                  </div>



                  <div class="mb-3">

                    <input type="tel" class="form-control" name="phone" placeholder="Phone number" required>

                  </div>



                  <div class="mb-3">

                    <input type="date" class="form-control" name="date" required>

                  </div>



                  <div class="mb-3">

                    <textarea class="form-control" rows="4" name="feedback" placeholder="Type Your Feedback"></textarea>

                  </div>



                  <button type="submit" class="btn btn-primary w-100">Send FeedBack</button>

                </form>

              </div>

            </div>

          </div>

        </div>



        <!-- FAQ -->

        <div class="faq-area">

          <h2 class="text-center mb-4">Frequently Ask Question</h2>

          <p class="text-center text-muted mb-5">We use only the best quality materials in the market to provide the best products to our patients.</p>



          <div class="accordion" id="faqAccordion">

            <div class="accordion-item mb-3 rounded">

              <h2 class="accordion-header" id="headingOne">

                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">

                  Can I see who reads my email campaigns?

                </button>

              </h2>

              <div id="collapseOne" class="accordion-collapse collapse show">

                <div class="accordion-body">

                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti consequatur, aliquam accusantium ratione earum illum.

                </div>

              </div>

            </div>



            <div class="accordion-item mb-3 rounded">

              <h2 class="accordion-header" id="headingTwo">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"

                  data-bs-target="#collapseTwo">

                  Do you offer non-profit discounts?

                </button>

              </h2>

              <div id="collapseTwo" class="accordion-collapse collapse">

                <div class="accordion-body">

                  Yes, we do! Please contact our support team to discuss non-profit pricing options.

                </div>

              </div>

            </div>



            <div class="accordion-item mb-3 rounded">

              <h2 class="accordion-header" id="headingThree">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"

                  data-bs-target="#collapseThree">

                  Can I see who reads my email campaigns?

                </button>

              </h2>

              <div id="collapseThree" class="accordion-collapse collapse">

                <div class="accordion-body">

                  You can track email opens and click rates through our analytics dashboard.

                </div>

              </div>

            </div>

          </div>

        </div>



        <!-- Bootstrap JS -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



        <!-- GSAP Animations -->

        <script>

          // gsap.from("h2, p", { y: 50, opacity: 0, duration: 1, stagger: 0.2 });

          // gsap.from(".info-box", { x: -50, opacity: 0, duration: 1, stagger: 0.2 });

          // gsap.from(".form-container", { x: 50, opacity: 0, duration: 1 });

        </script>



</body>
{{-- @endsection --}}

