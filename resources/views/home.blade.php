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

    <!-- Modern Header Section Start -->
    <div class="modern-header">
        <!-- Dynamic Background Slider -->
        <div id="backgroundSlider" class="wave-bg"></div>
        
        <div class="container-fluid p-0">
            <div class="row g-0">
                <!-- Left Categories Section -->
                <div class="col-lg-auto col-md-auto category-sidebar">
                    <div class="category-list">
                        <div class="category-item active">
                            <a href="{{ route('filterByCategory', 1) }}">COMPUTER & LAPTOP</a>
                            <div class="orange-divider"></div>
                        </div>
                        <div class="category-item">
                            <a href="{{ route('filterByCategory', 2) }}">PRINTER & SCANNER</a>
                            <div class="orange-divider"></div>
                        </div>
                        <div class="category-item">
                            <a href="{{ route('filterByCategory', 3) }}">AIR CONDITIONER</a>
                            <div class="orange-divider"></div>
                        </div>
                        <div class="category-item">
                            <a href="{{ route('filterByCategory', 4) }}">TELEVISION & VW</a>
                            <div class="orange-divider"></div>
                        </div>
                        <div class="category-item">
                            <a href="{{ route('filterByCategory', 5) }}">CAMERA & PHOTOGRAPHY</a>
                            <div class="orange-divider"></div>
                        </div>
                        <div class="category-item">
                            <a href="{{ route('filterByCategory', 6) }}">NETWORKING</a>
                            <div class="orange-divider"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Middle Content Section -->
                <div class="col header-content">
                    <div id="sliderContent" class="content-wrapper">
                        <!-- Content will be dynamically updated by JavaScript -->
                    </div>
                </div>
                
                <!-- Right Featured Product Section -->
                <div class="col-lg-4 col-md-4 featured-product">
                    @if(!$produks->isEmpty())
                        <div id="productCarousel" class="product-carousel">
                            @foreach($produks->take(3) as $index => $featuredProduct)
                                <div class="product-container carousel-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                                    <div class="product-image">
                                        <img src="{{ asset($featuredProduct->images->first()->gambar ?? 'assets/img/default.jpg') }}" alt="{{ $featuredProduct->nama }}">
                                    </div>
                                    <div class="product-info">
                                        <h3>{{ $featuredProduct->nama }}</h3>
                                        <p>{{ Str::limit($featuredProduct->deskripsi, 80) }}</p>
                                        <div class="product-price">IDR {{ number_format($featuredProduct->harga, 0, ',', '.') }}</div>
                                        <div class="product-actions">
                                            <a href="{{ route('product.show', $featuredProduct->id) }}" class="add-to-cart">READ MORE</a>
                                            <button class="cart-icon"><i class="fas fa-shopping-cart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="nav-controls">
                            <button class="nav-prev"><i class="fas fa-circle-arrow-left"></i></button>
                            <div class="carousel-indicators">
                                @foreach($produks->take(3) as $index => $product)
                                    <span class="indicator {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
                                @endforeach
                            </div>
                            <button class="nav-next"><i class="fas fa-circle-arrow-right"></i></button>
                        </div>
                    @else
                        <div class="product-container">
                            <div class="product-image">
                                <img src="{{ asset('assets/img/laptop.png') }}" alt="Featured Product">
                            </div>
                            <div class="product-info">
                                <h3>JUDUL PRODUK</h3>
                                <p>DESKRIPSI PRODUK</p>
                                <div class="product-price">IDR 1,000</div>
                                <div class="product-actions">
                                    <button class="add-to-cart">READ MORE</button>
                                    <button class="cart-icon"><i class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modern Header Section End -->

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
                    <h2 class="luxury-section-title">Our Products</h2>
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

    <!-- CSS for styling (Including NEW Modern Header Styling) -->
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

        /* Background slider fade */
        @keyframes fadeSlide {
            0%, 15% {
                opacity: 1;
            }
            30%, 45% {
                opacity: 0;
            }
            60%, 75% {
                opacity: 0;
            }
            90%, 100% {
                opacity: 1;
            }
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

        /* ===== NEW MODERN HEADER STYLING ===== */
        .modern-header {
            position: relative;
            min-height: 800px; /* Increased height for better visual */
            overflow: hidden;
            margin-bottom: 0;
        }
        
        /* Background wave effect with dynamic slider */
        .wave-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            z-index: 0;
        }
        
        #backgroundSlider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #FF1493 0%, #8A2BE2 50%, #6A0DAD 100%);
            background-size: cover;
            background-position: center;
            z-index: 0;
            transition: background-image 1s ease;
        }
        
        #backgroundSlider:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,20,147,0.4) 0%, rgba(138,43,226,0.3) 50%, rgba(106,13,173,0.3) 100%); /* Reduced opacity here */
            z-index: 1;
        }
        
        /* Category sidebar styling */
        .category-sidebar {
            width: 220px;
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
        }
        
        .category-list {
            background-color: rgba(147, 0, 119, 0.7);
            width: 100%;
            padding: 15px 0;
            border-radius: 0 0 10px 0;
        }
        
        .category-item {
            position: relative;
            padding: 16px 20px;
            transition: all 0.3s ease;
        }
        
        .category-item a {
            color: rgba(255,255,255,0.8);
            font-size: 0.8rem;
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.5px;
            display: block;
            padding-left: 15px;
            text-transform: uppercase;
        }
        
        .category-item.active a,
        .category-item:hover a {
            color: white;
        }
        
        .orange-divider {
            height: 1px;
            background-color: #ff8432;
            margin: 0;
            opacity: 0.9;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
        }
        
        /* Middle content section */
        .header-content {
            padding: 130px 30px 60px;
            position: relative;
            z-index: 2;
            flex: 1;
            display: flex;
            align-items: center;
        }
        
        .content-wrapper {
            max-width: 680px; /* Increased from 580px to accommodate longer titles */
            padding-left: 30px;
        }
        
        .design-tagline {
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
            letter-spacing: 2px;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: 400;
        }
        
        .design-title h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            line-height: 1.1;
            margin: 0;
            margin-bottom: 20px;
            text-transform: uppercase;
            white-space: nowrap; /* Ensure title stays on one line */
            overflow: hidden;
            text-overflow: ellipsis; /* Add ellipsis if text is too long */
        }
        
        .design-description {
            color: rgba(255,255,255,0.9);
            font-size: 1rem;
            line-height: 1.6;
            margin-top: 20px;
            max-width: 480px;
        }
        
        .explore-btn {
            margin-top: 40px;
        }
        
        .btn-explore {
            background-color: rgba(0,0,0,0.2);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            text-transform: uppercase;
        }
        
        .btn-explore:hover {
            background-color: white;
            color: #FF1493;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        /* Right featured product carousel - Keep translucent background */
        .featured-product {
            padding: 130px 30px 60px;
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .product-carousel {
            position: relative;
            height: 440px;
            overflow: hidden;
        }
        
        .carousel-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            pointer-events: none;
        }
        
        .carousel-item.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: all;
        }
        
        .product-container {
            background-color: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .product-image {
            text-align: center;
            margin-bottom: 20px;
            background: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            flex: 0 0 auto;
            max-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-image img {
            max-width: 100%;
            height: auto;
            max-height: 140px;
            object-fit: contain;
        }
        
        .product-info {
            padding: 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-info h3 {
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.2;
        }
        
        .product-info p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            margin-bottom: 15px;
            line-height: 1.5;
            flex: 1;
        }
        
        .product-price {
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .product-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }
        
        .add-to-cart {
            flex: 1;
            background-color: #FF1493;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }
        
        .add-to-cart:hover {
            background-color: #ff69b4;
            transform: translateY(-3px);
            color: white;
        }
        
        .cart-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border: none;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .cart-icon:hover {
            background-color: white;
            color: #FF1493;
        }
        
        .nav-controls {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
            justify-content: center;
        }
        
        .nav-prev, .nav-next {
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .nav-prev:hover, .nav-next:hover {
            background-color: white;
            color: #FF1493;
            transform: scale(1.1);
        }
        
        .carousel-indicators {
            display: flex;
            gap: 8px;
        }
        
        .indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .indicator.active {
            background-color: white;
            transform: scale(1.3);
        }

        /* ===== RESPONSIVE STYLES FOR BANNER ONLY ===== */
        @media (max-width: 1199px) {
            /* Large Desktop adjustments */
            .category-sidebar {
                width: 200px;
            }
            
            .category-item {
                padding: 14px 18px;
            }
            
            .category-item a {
                font-size: 0.75rem;
            }
            
            .header-content, .featured-product {
                padding: 120px 25px 50px;
            }
            
            .content-wrapper {
                max-width: 580px;
            }
            
            .design-title h1 {
                font-size: 2.3rem;
            }
            
            .modern-header {
                min-height: 750px;
            }
        }

        @media (max-width: 991px) {
            /* Tablet adjustments */
            .category-sidebar {
                width: 180px;
            }
            
            .category-item {
                padding: 12px 15px;
            }
            
            .category-item a {
                font-size: 0.7rem;
                padding-left: 10px;
            }
            
            .header-content, .featured-product {
                padding: 100px 20px 40px;
            }
            
            .content-wrapper {
                padding-left: 15px;
                max-width: 480px;
            }
            
            .design-title h1 {
                font-size: 2rem;
                letter-spacing: 2px;
            }
            
            .design-description {
                font-size: 0.9rem;
            }
            
            .product-carousel {
                height: 400px;
            }
            
            .modern-header {
                min-height: 700px;
            }
        }

        @media (max-width: 768px) {
            /* Mobile landscape & small tablets */
            .modern-header {
                min-height: auto;
            }
            
            .row {
                flex-direction: column;
            }
            
            .category-sidebar {
                width: 100%;
                height: auto;
                min-height: auto;
            }
            
            .category-list {
                display: flex;
                flex-wrap: wrap;
                padding: 15px 0;
                border-radius: 0;
            }
            
            .category-item {
                padding: 10px 15px;
                width: 50%;
            }
            
            .orange-divider {
                display: none;
            }
            
            .header-content, .featured-product {
                padding: 30px 20px;
                width: 100%;
            }
            
            .content-wrapper {
                padding-left: 0;
                max-width: 100%;
            }
            
            .design-title h1 {
                font-size: 1.8rem;
                letter-spacing: 2px;
                white-space: normal; /* Allow wrapping on mobile */
            }
            
            .design-description p {
                font-size: 0.9rem;
            }
            
            .product-carousel {
                height: 350px;
            }
            
            .col-lg-4, .col-md-4 {
                width: 100%;
                max-width: 100%;
                flex: 0 0 100%;
            }
        }

        @media (max-width: 576px) {
            /* Mobile portrait */
            .category-item {
                width: 100%;
                padding: 8px 15px;
            }
            
            .category-list {
                padding: 10px 0;
            }
            
            .header-content {
                padding: 25px 15px;
            }
            
            .design-title h1 {
                font-size: 1.6rem;
                letter-spacing: 1px;
            }
            
            .btn-explore {
                padding: 8px 20px;
                font-size: 0.85rem;
                width: 100%;
                text-align: center;
                display: block;
            }
            
            .product-carousel {
                height: 320px;
            }
            
            .product-info h3 {
                font-size: 1.2rem;
            }
            
            .add-to-cart {
                font-size: 0.8rem;
                padding: 8px 12px;
            }
            
            .cart-icon, .nav-prev, .nav-next {
                width: 35px;
                height: 35px;
            }
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

        /* ========== PREMIUM PRODUCT SECTION ========== */
        
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
        
        .premium-product-logo img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            transition: all 0.4s ease;
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

        /* Animation for drawLine */
        @keyframes drawLine {
            from { width: 0; }
            to { width: 100px; }
        }

        /* Ensure both background and content transition simultaneously */
        .slide-transition .wave-bg,
        .slide-transition .content-wrapper {
            transition: opacity 0.8s ease;
        }
        
        /* Special class for slide transitions */
        .slide-transition {
            position: relative;
        }
    </style>

    <!-- JavaScript animations (Updated for Modern Header) -->
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
            
            // Initialize slider content and background
            initSliderContent();
            
            // Initialize Product Carousel
            initProductCarousel();
            
            // Initialize scroll animations
            const fadeElements = document.querySelectorAll('.container-xxl, .premium-product-card, h6, .brand-item');
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
            
            // Category Interaction
            document.querySelectorAll('.category-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    document.querySelectorAll('.category-item').forEach(function(elem) {
                        elem.classList.remove('active');
                    });
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                });
            });
        });
        
        // Slider Content Function with TEXT and IMAGE fully synchronized changes
        function initSliderContent() {
            // Get all slider data from PHP
            const sliders = @json($sliders);
            
            if (!sliders || sliders.length === 0) {
                // No sliders available, add default content
                updateSliderContent({
                    title: 'COMPUTER AND LAPTOPS',  // Updated to match the image example
                    subtitle: 'PRESENTING SMART SOLUTIONS',
                    description: 'Welcome our latest innovation! We are proud to introduce the latest products designed to meet your needs better. With advanced features and modern design, this new product is ready to provide extraordinary experiences that have never existed before.',
                    button_text: 'MORE',
                    button_url: '#',
                    image_url: 'assets/img/default-bg.jpg'
                }, true);
                return;
            }
            
            // Set initial slide
            updateSliderContent(sliders[0], true);
            
            // Set up auto rotate if multiple sliders
            if (sliders.length > 1) {
                let currentIndex = 0;
                
                // Auto rotate sliders
                setInterval(() => {
                    currentIndex = (currentIndex + 1) % sliders.length;
                    updateSliderContent(sliders[currentIndex], false);
                }, 5000); // Change every 5 seconds
            }
        }
        
        function updateSliderContent(slider, isInitial) {
            // Get the content wrapper
            const contentWrapper = document.getElementById('sliderContent');
            // Get background element
            const bgElement = document.getElementById('backgroundSlider');
            
            if (!contentWrapper || !bgElement) return;
            
            // Set background image with transition effect
            const assetPath = "{{ asset('') }}";
            const newImageUrl = `${assetPath}${slider.image_url}`;
            
            // Create new background element
            const tempBg = document.createElement('div');
            tempBg.className = 'wave-bg slide-transition';
            tempBg.style.backgroundImage = `url('${newImageUrl}')`;
            tempBg.style.opacity = '0';
            tempBg.style.position = 'absolute';
            tempBg.style.top = '0';
            tempBg.style.left = '0';
            tempBg.style.width = '100%';
            tempBg.style.height = '100%';
            tempBg.style.transition = 'opacity 0.8s ease';
            tempBg.style.zIndex = '0';
            
            // Add gradient overlay with reduced opacity
            tempBg.innerHTML = '<div style="position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(90deg, rgba(255,20,147,0.4) 0%, rgba(138,43,226,0.3) 50%, rgba(106,13,173,0.3) 100%);z-index:1;"></div>';
            
            // Prepare new content
            const newContent = document.createElement('div');
            newContent.className = 'content-wrapper slide-transition';
            newContent.style.opacity = '0';
            newContent.style.transition = 'opacity 0.8s ease';
            newContent.innerHTML = `
                <div class="design-tagline">${slider.subtitle || ''}</div>
                <div class="design-title">
                    <h1>${slider.title || 'TITLE HERE'}</h1>
                </div>
                <div class="design-description">
                    <p>${slider.description || ''}</p>
                </div>
                <div class="explore-btn">
                    <a href="${slider.button_url || '#'}" class="btn-explore">
                        ${slider.button_text || 'MORE'}
                    </a>
                </div>
            `;
            
            if (isInitial) {
                // First load - just show content and background immediately
                if (bgElement) {
                    bgElement.style.backgroundImage = `url('${newImageUrl}')`;
                    // Ensure the overlay also has reduced opacity on initial load
                    const existingOverlay = bgElement.querySelector('div');
                    if (!existingOverlay) {
                        bgElement.innerHTML = '<div style="position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(90deg, rgba(255,20,147,0.4) 0%, rgba(138,43,226,0.3) 50%, rgba(106,13,173,0.3) 100%);z-index:1;"></div>';
                    } else {
                        existingOverlay.style.background = 'linear-gradient(90deg, rgba(255,20,147,0.4) 0%, rgba(138,43,226,0.3) 50%, rgba(106,13,173,0.3) 100%)';
                    }
                }
                contentWrapper.innerHTML = '';
                contentWrapper.appendChild(newContent);
                newContent.style.opacity = '1';
                animateTitleLetters(newContent.querySelector('.design-title h1'));
            } else {
                try {
                    // 1. Add new background to DOM but keep it invisible
                    bgElement.parentNode.insertBefore(tempBg, bgElement.nextSibling);
                    
                    // 2. Create new content but keep it invisible too
                    const oldContent = contentWrapper.innerHTML;
                    contentWrapper.innerHTML = '';
                    contentWrapper.appendChild(newContent);
                    
                    // 3. IMPORTANT: Force reflow to ensure transitions work
                    void tempBg.offsetWidth;
                    void newContent.offsetWidth;
                    
                    // 4. Start both transitions simultaneously
                    tempBg.style.opacity = '1';
                    newContent.style.opacity = '1';
                    
                    // 5. Animate title letters
                    animateTitleLetters(newContent.querySelector('.design-title h1'));
                    
                    // 6. Remove old background after transition
                    setTimeout(() => {
                        if (bgElement && bgElement.parentNode) {
                            bgElement.parentNode.removeChild(bgElement);
                            tempBg.id = 'backgroundSlider';
                        }
                    }, 800);
                } catch (error) {
                    console.error("Error during slider transition:", error);
                }
            }
        }

        function animateTitleLetters(titleElement) {
            if (!titleElement) return;
            
            try {
                // Create animated letters
                const text = titleElement.textContent;
                titleElement.textContent = '';
                
                [...text].forEach((letter, i) => {
                    const span = document.createElement('span');
                    span.textContent = letter === ' ' ? '\u00A0' : letter; // Use non-breaking space for spaces
                    span.style.transitionDelay = `${i * 0.05}s`;
                    span.style.opacity = '0';
                    span.style.transform = 'translateY(20px)';
                    span.style.display = 'inline-block';
                    span.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    
                    titleElement.appendChild(span);
                    
                    // Animate entrance with a small delay for each letter
                    setTimeout(() => {
                        span.style.opacity = '1';
                        span.style.transform = 'translateY(0)';
                    }, 100 + (i * 50));
                });
            } catch (error) {
                console.error("Error animating title letters:", error);
                if (titleElement) titleElement.style.opacity = '1';
            }
        }
        
        // Product Carousel Function
        function initProductCarousel() {
            const carousel = document.getElementById('productCarousel');
            if (!carousel) return;
            
            const items = carousel.querySelectorAll('.carousel-item');
            if (!items.length) return;
            
            const prevBtn = document.querySelector('.nav-prev');
            const nextBtn = document.querySelector('.nav-next');
            const indicators = document.querySelectorAll('.carousel-indicators .indicator');
            
            let currentIndex = 0;
            let timer;
            let touchStartX, touchEndX;
            
            function showSlide(index) {
                if (index < 0) index = items.length - 1;
                if (index >= items.length) index = 0;
                
                // Update carousel items
                items.forEach(item => item.classList.remove('active'));
                items[index].classList.add('active');
                
                // Update indicators
                if (indicators && indicators.length) {
                    indicators.forEach(ind => ind.classList.remove('active'));
                    if (indicators[index]) indicators[index].classList.add('active');
                }
                
                currentIndex = index;
                
                // Reset timer
                clearInterval(timer);
                timer = setInterval(autoAdvance, 5000);
            }
            
            function autoAdvance() {
                showSlide(currentIndex + 1);
            }
            
            // Event listeners
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    showSlide(currentIndex - 1);
                });
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    showSlide(currentIndex + 1);
                });
            }
            
            if (indicators && indicators.length) {
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        showSlide(index);
                    });
                });
            }
            
            // Touch swipe support
            carousel.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            
            carousel.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });
            
            function handleSwipe() {
                if (touchStartX - touchEndX > 50) {
                    // Swipe left - next slide
                    showSlide(currentIndex + 1);
                } else if (touchEndX - touchStartX > 50) {
                    // Swipe right - previous slide
                    showSlide(currentIndex - 1);
                }
            }
            
            // Start auto-advance
            timer = setInterval(autoAdvance, 5000);
            
            // Initialize first slide
            showSlide(0);
            
            // Pause the carousel on hover, resume on mouse leave
            carousel.addEventListener('mouseenter', function() {
                clearInterval(timer);
            });
            
            carousel.addEventListener('mouseleave', function() {
                timer = setInterval(autoAdvance, 5000);
            });
            
            // Handle visibility changes (when user switches tabs or apps)
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    clearInterval(timer);
                } else {
                    timer = setInterval(autoAdvance, 5000);
                }
            });
        }
    </script>
@endsection