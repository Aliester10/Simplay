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
    <div class="header-carousel owl-carousel mb-0 position-relative">
        @if ($sliders->isEmpty())
            <!-- Default Slider if no data -->
            <div class="header-carousel-item position-relative">
                <img src="{{ asset('assets/img/MAS00029.jpg') }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" alt="Default Image">
                <div class="gradient-overlay"></div>
                <div class="carousel-caption">
                    <div class="carousel-caption-content text-start">
                        <div class="text-border">
                            <h1 class="text-white mb-3">Lorem ipsum dolor sit amet.</h1>
                            <p class="mb-4 text-white">Lorem ipsum dolor sit amet consectetur adipiscing elit. Amet consectetur adipisicing elit. Eius quibque faucibus et sapien vitae perferendis sem pharetr. Vitae pellentesque sem placerat in eu cursus mi.</p>
                        </div>
                        <a href="#" class="shop-now-btn">shop now</a>
                    </div>
                </div>
            </div>
        @else
            <!-- Loop through sliders if data exists -->
            @foreach ($sliders as $slider)
                <div class="header-carousel-item position-relative">
                    <img src="{{ asset($slider->image_url) }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" alt="Image">
                    <div class="gradient-overlay"></div>
                    <!-- Left-aligned caption -->
                    <div class="carousel-caption">
                        <div class="carousel-caption-content text-start">
                            <div class="text-border">
                                <h1 class="text-white mb-3">{{ $slider->title }}</h1>
                                <p class="mb-4 text-white">{{ $slider->description }}</p>
                            </div>
                            <a href="{{ $slider->button_url }}" class="shop-now-btn">{{ $slider->button_text }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Good Banner -->
    <div class="good-banner">
        <div class="good-banner-content">
            <span>good</span>
            <span>good</span>
            <span>good</span>
            <span>good</span>
            <span>good</span>
            <span>good</span>
            <span>good</span>
            <span>good</span>
            <span>good</span>
            <span>good</span>
        </div>
    </div>

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
                    <div class="carousel-rows" id="carouselRows">
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

    <!-- Include Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


    <script>
        // Terjemahan dari server untuk konten popup
        let translationTemplate =
            `{{ __('messages.members_in_province', ['count' => ':count', 'province' => ':province']) }}`;

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
        /* Modern slider styling */
        .header-carousel-item {
            height: 100vh;
            max-height: 600px;
            position: relative;
            overflow: hidden;
            background-color: #f0f0f0;
        }

        /* Gradient overlay like in the image */
        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);
            z-index: 1;
        }

        /* Left-aligned caption with flexbox */
        .carousel-caption {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            text-align: left;
            z-index: 2;
            padding: 0 5%;
        }

        /* Caption content styling */
        .carousel-caption-content {
            max-width: 550px;
            padding-left: 15px;
        }

        /* Border for text content */
        .text-border {
            border-left: 4px solid #fff;
            padding-left: 15px;
            margin-bottom: 25px;
        }

        .carousel-caption-content h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .carousel-caption-content p {
            font-size: 1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* Shop now button styling */
        .shop-now-btn {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 0.5rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            text-transform: lowercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .shop-now-btn:hover {
            background-color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Good banner styling - sesuai dengan gambar */
        .good-banner {
            background-color: #020b29;
            color: white;
            padding: 10px 0;
            overflow: hidden;
            white-space: nowrap;
            display: flex;
            justify-content: center;
        }

        .good-banner-content {
            display: flex;
            width: 100%;
            justify-content: space-around;
        }

        .good-banner-content span {
            display: inline-block;
            padding: 0 15px;
            position: relative;
        }

        .good-banner-content span:not(:last-child)::after {
            content: "•";
            position: absolute;
            right: -5px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Owl Carousel custom navigation dots */
        .owl-dots {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            z-index: 10;
        }

        .owl-dot {
            width: 10px;
            height: 10px;
            margin: 0 5px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.5) !important;
            border: none !important;
            outline: none !important;
            padding: 0 !important;
        }

        .owl-dot.active {
            background-color: #fff !important;
            width: 12px;
            height: 12px;
        }
        
        /* Menghilangkan tombol navigasi panah */
        .owl-nav {
            display: none !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-carousel-item {
                height: 400px;
            }

            .carousel-caption-content h1 {
                font-size: 1.8rem;
            }

            .carousel-caption-content p {
                font-size: 0.9rem;
                margin-bottom: 1.5rem;
            }
        }

        .brand-item {
            margin: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            padding: 10px;
            height: 80px;
        }

        .brand-item img {
            max-height: 60px;
            width: auto;
        }

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
                font-size: 10px;
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

        .carousel-container {
            position: relative;
            overflow: hidden;
            height: 150px;
        }

        .carousel-rows {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-auto-rows: 120px;
            animation: marquee 50s linear infinite;
            position: relative;
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
            const carouselRows = document.querySelector('.carousel-rows');
            const container = document.querySelector('.carousel-container');

            // Clone the carousel rows to create a seamless loop
            if (carouselRows) {
                const clonedRows = carouselRows.cloneNode(true);
                carouselRows.appendChild(clonedRows);
            }
            
            // Initialize Owl Carousel with navigation dots
            $(document).ready(function(){
                $('.header-carousel').owlCarousel({
                    items: 1,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    nav: false,           // Pastikan navigasi panah dinonaktifkan
                    dots: true,           // Aktifkan indikator dots
                    dotsClass: 'owl-dots',
                    animateOut: 'fadeOut',
                    smartSpeed: 1000
                });
                
                // Menghapus elemen navigasi yang mungkin masih muncul
                $('.owl-nav').remove();
            });
        });
    </script>
@endsection