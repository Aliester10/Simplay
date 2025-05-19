@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header mb-5 py-5"
        style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/about.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.about_us') }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a>
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ __('messages.about_us') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-secondary text-uppercase">{{ __('messages.about_us') }}</h5>
                    <h1 class="mb-4">{{ $compro->nama_perusahaan ?? 'PT Simplay Abyakta Mediatek' }}</h1>
                    <p class="mb-4" style="text-align: justify;">{{ $company->sejarah_singkat ?? ' ' }}</p>
                </div>
                <div class="col-lg-6 pt-4" style="min-height: 500px;">
                    <div class="position-relative h-100 wow fadeInUp" data-wow-delay="0.5s">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets/img/building.jpeg') }}"
                            style="object-fit: cover; padding: 0 0 50px 100px;" alt="">
                        <img class="position-absolute start-0 bottom-0 img-fluid bg-white pt-2 pe-2 w-50 h-50"
                            src="{{ asset('assets/img/profil2.png') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Legality Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 wow fadeInUp text-center" data-wow-delay="0.1s">
                    <h5 class="text-secondary text-uppercase">{{ __('messages.legality_top') }}</h5>
                    <h1 class="mb-4">{{ __('messages.legality') }}</h1>
                </div>
                <div class="row g-12 justify-content-center d-flex">
                    <div class="col-md-12 col-lg-6 col-xl-6 d-flex" style="margin-bottom: 0.5rem;">
                        <div class="team-item rounded flex-fill"
                            style="display: flex; flex-direction: column; height: 100%; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                            <div class="team-content text-center border border-primary rounded-bottom p-4"
                                style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                <h5>{{ __('messages.legality_1') }}</h5>
                                <p class="mb-0" style="font-weight: bold;">{{ $company->visi ?? ' ' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6 d-flex" style="margin-bottom: 0.5rem;">
                        <div class="team-item rounded flex-fill"
                            style="display: flex; flex-direction: column; height: 100%; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                            <div class="team-content text-center border border-primary rounded-bottom p-4"
                                style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                <h5>{{ __('messages.legality_2') }}</h5>
                                <p class="mb-0" style="font-weight: bold;">{{ $company->misi ?? ' ' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Legality End -->

    <!-- Service Start -->
    <div class="container-fluid py-5 px-4 px-lg-0">
        <div class="row g-0">
            <div class="col-lg-2 d-none d-lg-flex">
                <div class="d-flex align-items-center justify-content-center bg-primary w-100 h-100"
                    style="border-top-right-radius: 100px; border-bottom-right-radius: 100px; overflow: hidden;">
                    <img src="{{ asset('assets/img/Logo2.png') }}" alt="SIMPLAY Logo" class="img-fluid">
                </div>
            </div>
            <div class="col-md-12 col-lg-10">
                <div class="ms-lg-5 ps-lg-5">
                    <div class="text-center text-lg-start wow fadeInUp" data-wow-delay="0.1s">
                        <h6 class="text-secondary text-uppercase">{{ __('messages.tujuan_kami') }}</h6>
                        <h1 class="mb-5">{{ __('messages.visi_misi_perusahaan') }}</h1>
                    </div>
                    <div class="owl-carousel service-carousel position-relative wow fadeInUp" style="text-align: justify;"
                        data-wow-delay="0.1s">
                        <div class="bg-light p-4"
                            style="display: flex; flex-direction: column; justify-content: space-between; height: 300px;">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-handshake fa-2x text-primary"></i>
                            </div>
                            <h5 class="mb-3">{{ __('messages.pelayanan') }}</h5>
                            <p>{{ __('messages.pelayanan_desc') }}</p>
                        </div>
                        <div class="bg-light p-4"
                            style="display: flex; flex-direction: column; justify-content: space-between; height: 300px;">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-check-circle fa-2x text-primary"></i>
                            </div>
                            <h5 class="mb-3">{{ __('messages.kualitas') }}</h5>
                            <p>{{ __('messages.kualitas_desc') }}</p>
                        </div>
                        <div class="bg-light p-4"
                            style="display: flex; flex-direction: column; justify-content: space-between; height: 300px;">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-star fa-2x text-primary"></i>
                            </div>
                            <h5 class="mb-3">{{ __('messages.kepuasan') }}</h5>
                            <p>{{ __('messages.kepuasan_desc') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Brand Start -->
    <div id="brand" class="container-xxl py-5" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">{{ __('messages.our_brand') }}</h6>
                <h1 class="mb-5">{{ __('messages.brands_product') }}</h1>
            </div>
            @if ($partners->isEmpty())
                <div class="carousel-container" style="overflow: hidden; position: relative; height: 150px;">
                    <div class="carousel-rows" style="display: flex; flex-direction: column; height: 100%;">
                        <div class="carousel-row"
                            style="display: flex; white-space: nowrap; align-items: center; justify-content: center; height: 100%; animation: marquee 35s linear infinite;">
                            <div>
                                <p class="text-dark text-center" style="letter-spacing: 2px; margin: 0;">
                                    {{ __('messages.brand_not_available') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="carousel-container">
                    <div class="carousel-rows">
                        @foreach ($partners as $partner)
                            <div class="brand-item">
                                <img src="{{ asset($partner->gambar) }}" class="img-fluid" alt="{{ $partner->nama }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Brand End -->

    <!-- Customer Start -->
    <div id="user" class="container-xxl py-5" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">{{ __('messages.our_loyal_customers') }}</h6>
                <h1 class="mb-5">{{ __('messages.our_customers') }}</h1>
            </div>
            @if ($principals->isEmpty())
                <div class="carousel-container" style="overflow: hidden; position: relative; height: 150px;">
                    <div class="carousel-rows1" style="display: flex; flex-direction: column; height: 100%;">
                        <div class="carousel-row"
                            style="display: flex; white-space: nowrap; align-items: center; justify-content: center; height: 100%; animation: marquee 20s linear infinite;">
                            <div>
                                <p class="text-dark text-center" style="letter-spacing: 2px; margin: 0;">
                                    {{ __('messages.user_not_available') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="carousel-container">
                    <div class="carousel-rows1">
                        @foreach ($principals as $principal)
                            <div class="brand-item">
                                <img src="{{ asset($principal->gambar) }}" class="img-fluid"
                                    alt="{{ $principal->nama }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Customer End -->


    <style>
        .carousel-container {
            position: relative;
            overflow: hidden;
            height: 150px;
            /* Adjust height for two rows */
        }

        .carousel-rows {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            grid-auto-rows: 120px;
            animation: marquee 50s linear infinite;
            position: relative;
        }

        .carousel-rows1 {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            grid-auto-rows: 120px;
            animation: marquee 10s linear infinite;
            position: relative;
        }

        .brand-item {
            margin: 10px;
            border: 2px solid #ddd;
            /* Border around each image */
            border-radius: 5px;
            /* Rounded corners for the border */
            display: flex;
            justify-content: center;
            /* Center the image inside the item */
            align-items: center;
            /* Center the image vertically */
            overflow: hidden;
            /* Hide overflow if image is too big */
        }

        img {
            width: 100%;
            /* Make image fill the container */
            height: 100%;
            /* Maintain height for uniformity */
            object-fit: cover;
            /* Cover the area of the item */
        }

        @keyframes marquee {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-100%);
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const carouselRows = document.getElementById("carouselRows");
            const container = document.querySelector('.carousel-container');

            // Clone the carousel rows to create a seamless loop
            const clonedRows = carouselRows.cloneNode(true);
            carouselRows.appendChild(clonedRows);

            // Calculate total height after cloning
            const totalHeight = carouselRows.scrollHeight; // Get the total height of the images
            const containerHeight = container.clientHeight;

            // Set animation duration based on the total height
            // The factor of 120 can be adjusted based on the speed you desire
            const duration = (totalHeight / 120) * 30; // Adjust based on desired speed

            // Ensure the animation runs smoothly
            carouselRows.style.animation = `marquee ${duration}s linear infinite`;

            // Initial position for the cloned content
            carouselRows.style.transform = `translateY(0)`;

            // Function to reset scroll position when reaching the end of the first set
            const resetScrollPosition = () => {
                const scrollTop = container.scrollTop;

                // Reset position when the original rows are scrolled out of view
                if (scrollTop >= totalHeight / 2) {
                    // Reset the scroll position back to the start
                    carouselRows.style.transform = `translateY(0)`;
                    container.scrollTop = 0; // Reset scroll position
                }
            };

            // Listen for scroll events to reset position
            container.addEventListener('scroll', resetScrollPosition);
        });
    </script>
@endsection
