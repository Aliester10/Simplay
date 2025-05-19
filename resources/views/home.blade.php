@extends('layouts.Member.master')

@section('content')
    <!-- Menampilkan pesan error -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Ada Kesalahan:</h4>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    

    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <h4 class="alert-heading"><i class="fas fa-check-circle"></i> Berhasil!</h4>
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel mb-5">
        @if ($sliders->isEmpty())
            <!-- Default Slider if no data -->
            <div class="header-carousel-item">
                <img src="{{ asset('assets/img/MAS00029.jpg') }}" class="img-fluid" style="width: 100%; height: 100%;"
                    alt="Default Image">
                <div
                    style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5);">
                </div>
                <div class="carousel-caption">
                    <div class="carousel-caption-content p-3 text-center">
                        <h3 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 2px;">
                            {{ __('messages.slider_not_available') }}
                        </h3>
                    </div>
                </div>
            </div>
        @else
            <!-- Loop through sliders if data exists -->
            @foreach ($sliders as $slider)
                <div class="header-carousel-item position-relative">
                    <img src="{{ asset($slider->image_url) }}" class="img-fluid"
                        style="width: 100%; height: 700px; object-fit: cover;" alt="Image">
                    <div class="overlay"></div>

                    <!-- Center-aligned caption with flex and centered container -->
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center"
                        style="top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%;">
                        <div class="col-lg-12 col-xl-8 text-center">
                            <div class="carousel-caption-content text-center px-3">
                                <h5 class="text-white text-uppercase fw-bold mb-2">
                                    {{ $slider->subtitle }}
                                </h5>
                                <h1 class="display-4 text-capitalize text-white mb-3">
                                    {{ $slider->title }}
                                </h1>
                                <p class="mb-4 fs-5 text-white">{{ $slider->description }}</p>
                                <a class="btn btn-primary rounded-pill text-white py-2 px-4"
                                    href="{{ $slider->button_url }}">
                                    {{ $slider->button_text }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>



    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-secondary text-uppercase">{{ __('messages.about_us') }}</h5>
                    <h1 class="mb-4">{{ $compro->nama_perusahaan ?? 'PT Simplay Abyakta Mediatek' }}</h1>
                    <p class="mb-4" style="text-align: justify;">{{ $company->sejarah_singkat ?? ' ' }}</p>
                    <div class="col-6 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <a class="btn btn-primary rounded-pill text-white py-3 px-5"
                            href="{{ route('about') }}">{{ __('messages.about_us') }}</a>
                    </div>
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

    <!-- Product Start -->
    @if (!$produks->isEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase">{{ __('messages.find_products') }}</h6>
                    <h1 class="mb-5">{{ __('messages.our_products') }}</h1>
                </div>
                <div class="row g-4">
                    @foreach ($produks as $produk)
                        <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                            <!-- Card is now wrapped in a link -->
                            <a href="{{ route('product.show', $produk->id) }}" style="text-decoration: none;">
                                <div class="blog-item rounded"
                                    style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 20px; height: 250px; border-radius: 15px; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div class="blog-img"
                                        style="overflow: hidden; border-radius: 15px; position: relative; flex: 1;">
                                        <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                            class="img-fluid w-100"
                                            style="border-radius: 15px; width: 100%; height: 150px; object-fit: cover; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                            alt="{{ $produk->nama }}"
                                            onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0px 4px 15px rgba(0, 0, 0, 0.2)';"
                                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    </div>
                                    <h5
                                        style="font-weight: bold; color: #343a40; font-size: 1rem; margin: 0; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ $produk->nama }}
                                        <span class="arrow"
                                            style="display: inline-block; font-size: 1.5rem; color: #007BFF; transition: transform 0.3s ease;"
                                            onmouseover="this.textContent='—>'" onmouseout="this.textContent='→'">→</span>
                                    </h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <a class="btn btn-primary rounded-pill text-white py-3 px-5"
                            href="{{ route('product.index') }}">{{ __('messages.see_more') }}</a>
                    </div>
                </div>
            </div>
        </div><br>
    @endif
    <!-- Product End -->

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

    <!-- Map Start -->
    <div id="brand" class="container-xxl py-5" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">{{ __('messages.our_loyal_customers') }}</h6>
                <h1 class="mb-5">{{ __('messages.our_customers') }}</h1>
            </div>
            <div class="container"
                style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); padding: 20px; background-color: #fff; text-align: center; ">
                <div id="map" style=" width: 100%; height: 600px; border-radius: 10px; overflow: hidden;"></div>
            </div>
        </div>
    </div><br> <br>
    <!-- Map End -->

    <!-- Include Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-1.8694501185333308, 115.36224445532018], 5);

        //tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Terjemahan dari server untuk konten popup
        let translationTemplate =
            `{{ __('messages.members_in_province', ['count' => ':count', 'province' => ':province']) }}`;

        function addMarker(lat, lng, province, userCount, users) {
            var marker = L.marker([lat, lng]).addTo(map);

            // Buat daftar pengguna
            let userList = '<ul>';
            users.forEach(function(user) {
                userList += `<li>${user.nama_perusahaan} (Became a Member on: ${user.created_at})</li>`;
            });
            userList += '</ul>';

            // Terjemahan dinamis
            let popupText = translationTemplate
                .replace(':count', userCount)
                .replace(':province', province);

            // Konten popup untuk marker
            marker.bindPopup(`
                <div class="info-window">
                    <h3 class="popup-title">${province}</h3>
                    <p class="popup-description">${popupText}</p>
                    ${userList}
                </div>
            `);

            // Tooltip
            marker.bindTooltip(`<div>${province}</div>`, {
                permanent: false,
                direction: 'top',
                offset: [0, -20],
                className: 'marker-tooltip'
            });

            marker.on('mouseover', function(e) {
                this.openTooltip();
            });
            marker.on('mouseout', function(e) {
                this.closeTooltip();
            });
        }

        fetch("{{ url('/locations') }}")
            .then(response => response.json())
            .then(data => {
                console.log("Received Data:", data); // Debugging to check data
                data.forEach(location => {
                    if (location.user_count > 0) {
                        console.log("Adding marker for:", location.province, "with", location.user_count,
                            "users.");
                        addMarker(location.latitude, location.longitude, location.province, location.user_count,
                            location.user_data);
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>


    <!-- CSS for styling -->
    <style>
        .header-carousel-item {
            height: 700px;
            position: fixeda;
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

        /* Overlay for darkening image */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Centering caption with flexbox */
        .carousel-caption {
            position: absolute;
            width: 100%;
            padding: 20% 5%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        /* Caption content styling */
        .carousel-caption-content {
            max-width: 700px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-carousel-item {
                height: 400px;
            }

            .carousel-caption {
                padding: 15% 5%;
            }

            .carousel-caption-content h1 {
                font-size: 2rem;
            }

            .carousel-caption-content p {
                font-size: 1rem;
            }
        }
    </style>

    <style>
        .marker-tooltip {
            background-color: #b3d9ff;
            border: 1px solid #80b3ff;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            font-size: 12px;
            color: #333;
        }

        .info-window img.popup-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .popup-title {
            font-size: 20px;
            color: black;
            font-weight: bold;
        }

        .popup-description,
        .popup-address {
            font-size: 12px;
            color: #333;
            margin-top: 10px;
            text-align: justify;
        }

        /* Media query untuk perangkat dengan lebar maksimal 768px */
        @media (max-width: 768px) {
            .info-window {
                padding: 10px;
            }

            .popup-title {
                font-size: 18px;
            }

            .popup-description,
            .popup-address {
                font-size: 10px;a
            }

            .info-window img.popup-image {
                margin-bottom: 5px
            }
        }

        /* Media query untuk perangkat dengan lebar maksimal 480px */
        @media (max-width: 480px) {
            .popup-title {
                font-size: 16px;
            }

            .popup-description,
            .popup-address {
                font-size: 9px;
            }
        }
    </style>

    <style>
        .carousel-container {
            position: relative;
            overflow: hidden;
            height: 150px;
            /* Adjust height for two rows */
        }

        .carousel-rows {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            /* 4 images per row */
            grid-auto-rows: 120px;
            /* Fixed height for each row */
            animation: marquee 50s linear infinite;
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
