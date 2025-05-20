@extends('layouts.Member.master')

@section('content')
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader"></div>
    </div>

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

    <!-- GOOD Banner (Complete Rewrite) -->
    <div class="ticker-wrap">
        <div class="ticker">
            @for ($i = 0; $i < 99; $i++)
            <div class="ticker-item">Lorem <span class="ticker-dot">•</span></div>
            @endfor
        </div>
    </div>

    <!-- Category Section Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <!-- Computer & Laptop -->
                <div class="col-lg-2 col-md-3 col-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="{{ route('filterByCategory', 1) }}" class="category-item text-center">
                        <div class="category-icon">
                            <img src="{{ asset('assets/icons/category-icon/monitor.svg') }}" alt="Computer & Laptop">
                        </div>
                        <h5 class="mt-3">Computer & Laptop</h5>
                    </a>
                </div>
                <!-- Printer & Scanner -->
                <div class="col-lg-2 col-md-3 col-6 wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ route('filterByCategory', 2) }}" class="category-item text-center">
                        <div class="category-icon">
                            <img src="{{ asset('assets/icons/category-icon/printer.svg') }}" alt="Printer & Scanner">
                        </div>
                        <h5 class="mt-3">Printer & Scanner</h5>
                    </a>
                </div>
                <!-- Air Conditioner -->
                <div class="col-lg-2 col-md-3 col-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="{{ route('filterByCategory', 3) }}" class="category-item text-center">
                        <div class="category-icon">
                            <img src="{{ asset('assets/icons/category-icon/air-conditioner.svg') }}" alt="Air Conditioner">
                        </div>
                        <h5 class="mt-3">Air Conditioner</h5>
                    </a>
                </div>
                <!-- Television & Video Wall -->
                <div class="col-lg-2 col-md-3 col-6 wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('filterByCategory', 4) }}" class="category-item text-center">
                        <div class="category-icon">
                            <img src="{{ asset('assets/icons/category-icon/television.svg') }}" alt="Television & Video Wall">
                        </div>
                        <h5 class="mt-3">Television & Video Wall</h5>
                    </a>
                </div>
                <!-- Camera & Photography -->
                <div class="col-lg-2 col-md-3 col-6 wow fadeInUp" data-wow-delay="0.5s">
                    <a href="{{ route('filterByCategory', 5) }}" class="category-item text-center">
                        <div class="category-icon">
                            <img src="{{ asset('assets/icons/category-icon/Camera.svg') }}" alt="Camera & Photography">
                        </div>
                        <h5 class="mt-3">Camera & Photography</h5>
                    </a>
                </div>
                <!-- Networking -->
                <div class="col-lg-2 col-md-3 col-6 wow fadeInUp" data-wow-delay="0.6s">
                    <a href="{{ route('filterByCategory', 6) }}" class="category-item text-center">
                        <div class="category-icon">
                            <img src="{{ asset('assets/icons/category-icon/web.svg') }}" alt="Networking">
                        </div>
                        <h5 class="mt-3">Networking</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Category Section End -->

    <!-- HIGHLY ENHANCED Product Section Start -->
    @if (!$produks->isEmpty())
        <div class="premium-products-section">
            <div class="premium-bg-wrapper">
                <div class="premium-bg-overlay"></div>
            </div>
            <div class="container">
                <!-- Elegant section header -->
                <div class="luxury-section-header">
                    <div class="luxury-section-line"></div>
                    <h2 class="luxury-section-title">Our  Products</h2>
                    <div class="luxury-section-line"></div>
                </div>
                <p class="luxury-section-subtitle">Discover Excellence in Technology</p>
                
                <!-- Product grid with enhanced cards -->
                <div class="premium-product-grid">
                    @foreach ($produks as $produk)
                        <div class="premium-product-card" data-wow-delay="0.{{ $loop->iteration }}s">
                            <!-- Logo badge using company logo -->
                            <div class="premium-product-logo">
                                <img src="{{ asset('assets/img/Logo.png') }}" alt="Company Logo">
                            </div>
                            
                            <!-- Product image container with hover effects -->
                            <div class="premium-product-image">
                                <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" 
                                     alt="{{ $produk->nama }}">
                                
                                <!-- Premium overlay with shine effect -->     
                                <div class="premium-shine-overlay"></div>
                                
                                <!-- Quick action buttons -->
                                <div class="premium-quick-actions">
                                    <a href="{{ route('product.show', $produk->id) }}" class="premium-action-button view-details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="premium-action-button add-wishlist">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    <a href="#" class="premium-action-button share-product">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Product details with elegant styling -->
                            <div class="premium-product-details">
                                <div class="premium-product-category">
                                    {{ $produk->category->nama ?? 'Premium Technology' }}
                                </div>
                                <h3 class="premium-product-title">{{ $produk->nama }}</h3>
                                
                                <!-- Interactive product footer -->
                                <div class="premium-product-footer">
                                    <a href="{{ route('product.show', $produk->id) }}" class="premium-details-link">
                                        <span class="link-text">Explore Details</span>
                                        <span class="link-icon"><i class="fas fa-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Elegant "view all" button -->
                <div class="premium-view-all">
                    <a href="{{ route('product.index') }}" class="premium-view-button">
                        <span class="button-text">View All Collections</span>
                        <span class="button-icon"><i class="fas fa-chevron-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    @endif
    <!-- HIGHLY ENHANCED Product Section End -->

    <!-- Brand Start (Revised for vertical scroll) -->
    <div id="brand" class="container-xxl py-5" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">{{ __('messages.our_brand') }}</h6>
                <h1 class="mb-5">{{ __('messages.brands_product') }}</h1>
            </div>
            @if ($partners->isEmpty())
                <div class="carousel-container-vertical" style="height: 250px; overflow: hidden; position: relative;">
                    <div class="carousel-content-vertical" style="text-align: center; padding: 20px;">
                        <p class="text-dark" style="letter-spacing: 2px; margin: 0;">
                            {{ __('messages.brand_not_available') }}
                        </p>
                    </div>
                </div>
            @else
                <div class="carousel-container-vertical">
                    <div class="carousel-content-vertical">
                        <div class="brand-grid">
                            @foreach ($partners as $partner)
                                <div class="brand-item">
                                    <img src="{{ asset($partner->gambar) }}" class="img-fluid" alt="{{ $partner->nama }}">
                                </div>
                            @endforeach
                        </div>
                        <!-- Clone for continuous scroll -->
                        <div class="brand-grid">
                            @foreach ($partners as $partner)
                                <div class="brand-item">
                                    <img src="{{ asset($partner->gambar) }}" class="img-fluid" alt="{{ $partner->nama }}">
                                </div>
                            @endforeach
                        </div>
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

    <!-- CSS for styling (Including NEW Premium Products Styling) -->
    <style>
        /* ===== ANIMASI UTAMA ===== */
        /* Keyframes for animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        @keyframes borderGrow {
            from { height: 0; }
            to { height: 100%; }
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes ticker {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(-100%, 0, 0); }
        }

        @keyframes scrollVertical {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
        
        /* Shine effect */
        @keyframes shine {
            0% {
                transform: translateX(-100%) rotate(25deg);
            }
            100% {
                transform: translateX(100%) rotate(25deg);
            }
        }
        
        /* Scale bounce */
        @keyframes scaleBounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        /* Button pulse */
        @keyframes buttonPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(2, 11, 41, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(2, 11, 41, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(2, 11, 41, 0);
            }
        }
        
        /* Logo rotation */
        @keyframes slowRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Text gradient animation */
        @keyframes textGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Section title reveal */
        @keyframes drawLine {
            0% { width: 0; }
            100% { width: 60px; }
        }

        /* ===== PRELOADER ===== */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #020b29;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .loader {
            width: 70px;
            height: 70px;
            border: 5px solid rgba(255, 255, 255, 0.1);
            border-top: 5px solid #6196FF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* ===== HEADER CAROUSEL ANIMATIONS ===== */
        .header-carousel-item {
            height: 100vh;
            max-height: 600px;
            position: relative;
            overflow: hidden;
            background-color: #f0f0f0;
        }

        .header-carousel-item img {
            transition: transform 8s ease;
        }

        .owl-item.active .header-carousel-item img {
            transform: scale(1.1);
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
            opacity: 0;
        }

        .owl-item.active .carousel-caption-content {
            animation: fadeInRight 1s forwards 0.5s;
        }

        /* Border for text content */
        .text-border {
            border-left: 4px solid #fff;
            padding-left: 15px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .owl-item.active .text-border:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 0;
            background-color: #fff;
            animation: borderGrow 1s forwards 0.8s;
        }

        .carousel-caption-content h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            opacity: 0;
        }

        .owl-item.active h1 {
            animation: fadeInUp 0.8s forwards 1s;
        }

        .carousel-caption-content p {
            font-size: 1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            opacity: 0;
        }

        .owl-item.active p {
            animation: fadeInUp 0.8s forwards 1.3s;
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
            opacity: 0;
        }

        .owl-item.active .shop-now-btn {
            animation: fadeInUp 0.8s forwards 1.6s;
        }

        .shop-now-btn:hover {
            background-color: #020b29;
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
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

        /* ===== GOOD BANNER ANIMATIONS ===== */
        .ticker-wrap {
            width: 100%;
            overflow: hidden;
            background: #020b29;
            padding: 10px 0;
            position: relative;
        }

        .ticker {
            display: inline-block;
            white-space: nowrap;
            padding-right: 100%; /* offset for seamless looping */
            box-sizing: content-box;
            -webkit-animation-iteration-count: infinite;
            animation-iteration-count: infinite;
            -webkit-animation-timing-function: linear;
            animation-timing-function: linear;
            -webkit-animation-name: ticker;
            animation-name: ticker;
            -webkit-animation-duration: 30s;
            animation-duration: 30s;
        }

        .ticker:hover {
            animation-play-state: paused;
        }

        .ticker-item {
            display: inline-block;
            padding: 0 1rem;
            font-size: 1rem;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .ticker-dot {
            margin-left: 10px;
            display: inline-block;
        }

        /* ===== CATEGORY SECTION ANIMATIONS ===== */
        .category-item {
            display: block;
            text-decoration: none;
            color: #333;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .category-item:hover {
            transform: translateY(-10px);
            text-decoration: none;
            color: #6196FF;
        }

        .category-icon {
            width: 80px;
            height: 80px;
            background-color: #020b29;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.4s ease-out;
            position: relative;
            overflow: hidden;
        }

        .category-icon:hover {
            transform: rotate(5deg);
            background-color: #6196FF;
            box-shadow: 0 10px 20px rgba(97, 150, 255, 0.3);
        }

        .category-icon::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .category-icon:hover::after {
            opacity: 1;
        }

        .category-icon img {
            width: 40px;
            height: 40px;
            filter: brightness(0) invert(1);
            transition: all 0.3s ease;
        }

        .category-item:hover .category-icon img {
            transform: scale(1.2);
            animation: pulse 1.5s infinite;
        }

        .category-item h5 {
            font-size: 0.9rem;
            margin-top: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .category-item:hover h5 {
            color: #020b29;
            font-weight: bold;
        }

        .category-item h5::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #6196FF;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .category-item:hover h5::after {
            width: 50%;
        }

        /* ===== BRAND SECTION ANIMATIONS ===== */
        .carousel-container-vertical {
            position: relative;
            height: 300px;
            overflow: hidden;
            margin: 0 auto;
            max-width: 1200px;
        }

        .carousel-content-vertical {
            animation: scrollVertical 40s linear infinite;
        }

        .brand-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
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
            transition: all 0.3s ease;
            background: white;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .brand-item:hover {
            transform: translateY(-5px) rotateY(10deg);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border-color: #6196FF;
        }

        .brand-item img {
            max-height: 60px;
            width: auto;
            transition: all 0.3s ease;
            filter: grayscale(100%);
        }

        .brand-item:hover img {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        /* ===== ALERT ANIMATIONS ===== */
        .alert {
            animation: slideDown 0.5s ease forwards;
            transform-origin: top center;
        }

        .alert .btn-close {
            transition: all 0.3s ease;
        }

        .alert .btn-close:hover {
            transform: rotate(90deg);
        }

        .alert-heading i {
            animation: pulse 2s infinite;
        }

        /* ===== SCROLL ANIMATIONS ===== */
        .fade-in-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Leaflet Map marker tooltip */
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

        /* ========== NEW PREMIUM PRODUCT SECTION ========== */
        
        /* Main section styling */
        .premium-products-section {
            position: relative;
            padding: 100px 0;
            background-color: #fcfcfc;
            overflow: hidden;
            z-index: 1;
        }
        
        /* Background effects */
        .premium-bg-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .premium-bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(240,240,250,0.8) 0%, rgba(250,250,255,0.9) 50%, rgba(240,245,255,0.8) 100%);
            z-index: 1;
        }
        
        /* Luxury section header */
        .luxury-section-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .luxury-section-line {
            height: 3px;
            width: 0;
            background: linear-gradient(90deg, transparent, #020b29, transparent);
            margin: 0 15px;
            animation: drawLine 1.5s forwards ease-out;
        }
        
        .luxury-section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #020b29;
            text-align: center;
            margin: 0;
            letter-spacing: 2px;
            position: relative;
            padding: 0 10px;
        }
        
        .luxury-section-subtitle {
            font-size: 1.1rem;
            color: #6196FF;
            text-align: center;
            margin-bottom: 50px;
            font-weight: 500;
            letter-spacing: 1px;
        }
        
        /* Premium product grid */
        .premium-product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }
        
        /* Premium product card */
        .premium-product-card {
            position: relative;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            transform: translateY(0);
            height: 450px;
            display: flex;
            flex-direction: column;
        }
        
        .premium-product-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        /* Logo badge */
        .premium-product-logo {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            overflow: hidden;
        }
        
        .premium-product-card:hover .premium-product-logo {
            transform: scale(1.1) rotate(10deg);
        }
        
        .premium-product-logo img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            transition: all 0.4s ease;
        }
        
        .premium-product-card:hover .premium-product-logo img {
            animation: slowRotate 10s linear infinite;
        }
        
        /* Product image */
        .premium-product-image {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .premium-product-image img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        
        .premium-product-card:hover .premium-product-image img {
            transform: scale(1.1);
        }
        
        /* Shine overlay effect */
        .premium-shine-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transform: translateX(-100%) rotate(25deg);
            transition: all 0.6s ease;
            pointer-events: none;
        }
        
        .premium-product-card:hover .premium-shine-overlay {
            animation: shine 1.5s forwards;
        }
        
        /* Quick action buttons */
        .premium-quick-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 15px;
            padding: 15px;
            background: linear-gradient(to top, rgba(2,11,41,0.7), transparent);
            transform: translateY(100%);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            opacity: 0;
        }
        
        .premium-product-card:hover .premium-quick-actions {
            transform: translateY(0);
            opacity: 1;
        }
        
        .premium-action-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #020b29;
            font-size: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            transform: translateY(20px);
            opacity: 0;
        }
        
        .premium-product-card:hover .premium-action-button {
            transform: translateY(0);
            opacity: 1;
        }
        
        .premium-product-card:hover .premium-action-button:nth-child(1) {
            transition-delay: 0.1s;
        }
        
        .premium-product-card:hover .premium-action-button:nth-child(2) {
            transition-delay: 0.2s;
        }
        
        .premium-product-card:hover .premium-action-button:nth-child(3) {
            transition-delay: 0.3s;
        }
        
        .premium-action-button:hover {
            background: #020b29;
            color: white;
            transform: translateY(-5px);
        }
        
        /* Product details */
        .premium-product-details {
            flex: 1;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .premium-product-category {
            font-size: 0.85rem;
            color: #6196FF;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .premium-product-title {
            font-size: 1.2rem;
            color: #151515;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 15px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            min-height: 3.2rem;
            transition: all 0.3s ease;
        }
        
        .premium-product-card:hover .premium-product-title {
            background: linear-gradient(90deg, #020b29, #6196FF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 100%;
            animation: textGradient 2s linear infinite;
        }
        
        /* Product footer with details link */
        .premium-product-footer {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid rgba(0,0,0,0.08);
        }
        
        .premium-details-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: #020b29;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 8px 0;
            transition: all 0.3s ease;
        }
        
        .premium-details-link:hover {
            color: #6196FF;
            transform: translateX(5px);
        }
        
        .link-icon {
            transition: all 0.3s ease;
        }
        
        .premium-details-link:hover .link-icon {
            transform: translateX(10px);
        }
        
        /* View all button */
        .premium-view-all {
            text-align: center;
            margin-top: 40px;
        }
        
        .premium-view-button {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #020b29;
            color: white;
            padding: 14px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 10px 30px rgba(2, 11, 41, 0.3);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .premium-view-button:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #020b29, #6196FF);
            z-index: -1;
            transition: all 0.4s ease;
            opacity: 0;
        }
        
        .premium-view-button:hover {
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(2, 11, 41, 0.5);
            animation: buttonPulse 1.5s infinite;
        }
        
        .premium-view-button:hover:before {
            opacity: 1;
        }
        
        .button-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .premium-view-button:hover .button-icon {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(5px);
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .premium-product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 30px;
            }
            
            .luxury-section-title {
                font-size: 2.2rem;
            }
            
            .premium-product-card {
                height: 420px;
            }
            
            .premium-product-image {
                height: 220px;
            }
        }
        
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

            .category-icon {
                width: 60px;
                height: 60px;
            }

            .category-icon img {
                width: 30px;
                height: 30px;
            }

            .category-item h5 {
                font-size: 0.8rem;
            }
            
            .premium-products-section {
                padding: 70px 0;
            }
            
            .luxury-section-title {
                font-size: 1.8rem;
            }
            
            .luxury-section-subtitle {
                font-size: 1rem;
                margin-bottom: 30px;
            }
            
            .premium-product-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 20px;
            }
            
            .premium-product-card {
                height: 380px;
            }
            
            .premium-product-image {
                height: 200px;
            }
            
            .premium-product-title {
                font-size: 1.1rem;
                min-height: 3rem;
            }
            
            .premium-product-logo {
                width: 40px;
                height: 40px;
            }
            
            .premium-product-logo img {
                width: 30px;
                height: 30px;
            }
            
            .premium-action-button {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
            
            .carousel-container-vertical {
                height: 250px;
            }
            
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
                margin-bottom: 5px;
            }

            .ticker-item {
                padding: 0 1rem;
                font-size: 0.85rem;
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
            
            .carousel-container-vertical {
                height: 220px;
            }
            
            .brand-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
            
            .premium-products-section {
                padding: 50px 0;
            }
            
            .luxury-section-title {
                font-size: 1.5rem;
            }
            
            .luxury-section-subtitle {
                font-size: 0.9rem;
                margin-bottom: 20px;
            }
            
            .premium-product-grid {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
                gap: 20px;
            }
            
            .premium-product-card {
                height: 350px;
            }
            
            .premium-product-image {
                height: 180px;
            }
            
            .premium-product-details {
                padding: 15px;
            }
            
            .premium-product-category {
                font-size: 0.8rem;
            }
            
            .premium-product-title {
                font-size: 1rem;
                min-height: 2.8rem;
            }
            
            .premium-view-button {
                padding: 12px 30px;
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- JavaScript animations (Updated) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Preloader
            window.addEventListener('load', function() {
                setTimeout(function() {
                    document.querySelector('.preloader').classList.add('fade-out');
                    setTimeout(function() {
                        document.querySelector('.preloader').remove();
                    }, 500);
                }, 500);
            });
            
            // Initialize scroll animations
            const fadeElements = document.querySelectorAll('.container-xxl, .premium-product-card, .category-item, h1, h6, .brand-item');
            fadeElements.forEach(function(element) {
                element.classList.add('fade-in-scroll');
            });
            
            // Handle scroll animations
            function checkScroll() {
                const elements = document.querySelectorAll('.fade-in-scroll');
                const windowHeight = window.innerHeight;
                
                elements.forEach(function(element) {
                    const elementPosition = element.getBoundingClientRect().top;
                    if (elementPosition < windowHeight - 100) {
                        element.classList.add('visible');
                    }
                });
            }
            
            // Initial check and add scroll event listener
            checkScroll();
            window.addEventListener('scroll', checkScroll);
            
            // Enhanced Header Carousel
            if (document.querySelector('.header-carousel')) {
                $('.header-carousel').on('initialized.owl.carousel', function() {
                    setTimeout(function() {
                        $('.owl-item.active .carousel-caption-content').css('opacity', '1');
                    }, 100);
                });
                
                $('.header-carousel').on('translated.owl.carousel', function() {
                    $('.owl-item .carousel-caption-content').css('opacity', '0');
                    setTimeout(function() {
                        $('.owl-item.active .carousel-caption-content').css('opacity', '1');
                    }, 100);
                });
            }
            
            // Calculate ticker speed based on number of items for smoother animation
            const ticker = document.querySelector('.ticker');
            if (ticker) {
                const tickerItems = ticker.querySelectorAll('.ticker-item');
                const itemCount = tickerItems.length;
                // Adjust speed based on number of items (more items = slower animation for better visibility)
                ticker.style.animationDuration = (itemCount * 1.5) + 's';
            }
            
            // Category Icons Animation
            document.querySelectorAll('.category-icon').forEach(function(icon, index) {
                icon.style.animationDelay = (index * 0.1) + 's';
                icon.addEventListener('mouseenter', function() {
                    this.style.animationPlayState = 'paused';
                });
                
                icon.addEventListener('mouseleave', function() {
                    this.style.animationPlayState = 'running';
                });
            });
            
            // Premium Product Cards Animation
            document.querySelectorAll('.premium-product-card').forEach(function(card, index) {
                // Add staggered animation delay
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                
                setTimeout(function() {
                    card.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200 + (index * 100)); // Staggered delay
                
                // 3D Tilting effect for premium cards
                card.addEventListener('mousemove', function(e) {
                    const cardRect = card.getBoundingClientRect();
                    const cardX = e.clientX - cardRect.left;
                    const cardY = e.clientY - cardRect.top;
                    
                    const angleY = (cardX / cardRect.width - 0.5) * 8; // Reduce tilt intensity
                    const angleX = (0.5 - cardY / cardRect.height) * 8;
                    
                    card.style.transform = `translateY(-10px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;
                });
                
                card.addEventListener('mouseleave', function() {
                    card.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
                });
            });
            
            // Brand Items Animation
            document.querySelectorAll('.brand-item').forEach(function(item, index) {
                item.style.animationDelay = (index * 0.1) + 's';
                item.addEventListener('mouseenter', function() {
                    this.style.animationPlayState = 'paused';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.animationPlayState = 'running';
                });
            });
            
            // Vertical scroll for brand section - pause on hover
            const carouselContentVertical = document.querySelector('.carousel-content-vertical');
            if (carouselContentVertical) {
                carouselContentVertical.addEventListener('mouseenter', function() {
                    this.style.animationPlayState = 'paused';
                });
                
                carouselContentVertical.addEventListener('mouseleave', function() {
                    this.style.animationPlayState = 'running';
                });
            }
            
            // Parallax Effect for Carousel Background
            document.querySelectorAll('.header-carousel-item').forEach(function(item) {
                item.addEventListener('mousemove', function(e) {
                    const moveX = (e.clientX - window.innerWidth / 2) * 0.005;
                    const moveY = (e.clientY - window.innerHeight / 2) * 0.005;
                    
                    const img = this.querySelector('img');
                    if (img) {
                        img.style.transform = `scale(1.1) translate(${moveX}px, ${moveY}px)`;
                    }
                });
                
                item.addEventListener('mouseleave', function() {
                    const img = this.querySelector('img');
                    if (img) {
                        img.style.transform = 'scale(1.1)';
                    }
                });
            });
            
            // Enhanced Alert Animations
            document.querySelectorAll('.alert').forEach(function(alert) {
                // Add close animation
                const closeBtn = alert.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        alert.style.animation = 'fadeOut 0.5s forwards';
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    });
                }
            });
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                document.querySelectorAll('.alert').forEach(function(alert) {
                    alert.style.animation = 'fadeOut 0.5s forwards';
                    setTimeout(function() {
                        if (alert.parentNode) {
                            alert.remove();
                        }
                    }, 500);
                });
            }, 5000);
            
            // Random floating particles for premium section background
            const productsSection = document.querySelector('.premium-products-section');
            if (productsSection) {
                // Create canvas for floating particles
                const canvas = document.createElement('canvas');
                canvas.style.position = 'absolute';
                canvas.style.top = '0';
                canvas.style.left = '0';
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                canvas.style.pointerEvents = 'none';
                canvas.style.zIndex = '0';
                
                // Add canvas to section background
                const bgWrapper = document.querySelector('.premium-bg-wrapper');
                bgWrapper.appendChild(canvas);
                
                // Set canvas dimensions
                canvas.width = productsSection.offsetWidth;
                canvas.height = productsSection.offsetHeight;
                
                const ctx = canvas.getContext('2d');
                const particles = [];
                
                // Create floating particles
                for (let i = 0; i < 50; i++) {
                    particles.push({
                        x: Math.random() * canvas.width,
                        y: Math.random() * canvas.height,
                        radius: Math.random() * 2 + 1,
                        speedX: Math.random() * 0.5 - 0.25,
                        speedY: Math.random() * 0.5 - 0.25,
                        color: getParticleColor()
                    });
                }
                
                function getParticleColor() {
                    const colors = [
                        'rgba(2, 11, 41, 0.1)',
                        'rgba(97, 150, 255, 0.1)',
                        'rgba(200, 220, 255, 0.2)'
                    ];
                    return colors[Math.floor(Math.random() * colors.length)];
                }
                
                // Animate particles
                function animateParticles() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    particles.forEach(particle => {
                        particle.x += particle.speedX;
                        particle.y += particle.speedY;
                        
                        // Bounce from edges
                        if (particle.x > canvas.width) particle.x = 0;
                        if (particle.x < 0) particle.x = canvas.width;
                        if (particle.y > canvas.height) particle.y = 0;
                        if (particle.y < 0) particle.y = canvas.height;
                        
                        // Draw particle
                        ctx.beginPath();
                        ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
                        ctx.fillStyle = particle.color;
                        ctx.fill();
                    });
                    
                    requestAnimationFrame(animateParticles);
                }
                
                animateParticles();
                
                // Update canvas size on window resize
                window.addEventListener('resize', function() {
                    canvas.width = productsSection.offsetWidth;
                    canvas.height = productsSection.offsetHeight;
                });
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
            
            // Add subtle movement to product images on mousemove
            document.querySelectorAll('.premium-product-image').forEach(function(productImage) {
                productImage.addEventListener('mousemove', function(e) {
                    const img = this.querySelector('img');
                    if (!img) return;
                    
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left; 
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const moveX = (x - centerX) / centerX * 10; // Maximum 10px movement
                    const moveY = (y - centerY) / centerY * 10;
                    
                    img.style.transform = `translate(${moveX}px, ${moveY}px) scale(1.1)`;
                });
                
                productImage.addEventListener('mouseleave', function() {
                    const img = this.querySelector('img');
                    if (img) {
                        img.style.transform = 'translate(0, 0) scale(1)';
                    }
                });
            });
        });
    </script>
@endsection