@extends('layouts.Member.master-black')

@section('content')
    <div class="product-detail-wrapper container py-5">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-nav mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama }}</li>
                </ol>
            </nav>
        </div>

        <!-- Product Main Section -->
        <div class="row g-5">
            <!-- Product Images - LEFT Side -->
            <div class="col-lg-6">
                <div class="product-gallery">
                    <!-- Main Image Container -->
                    <div class="main-image-container mb-3">
                        <div class="image-zoom-wrapper">
                            @if ($produk->images->count() > 0)
                                <img id="mainImage" 
                                    src="{{ asset($produk->images->first()->gambar) }}" 
                                    alt="{{ $produk->nama }}"
                                    data-zoom="{{ asset($produk->images->first()->gambar) }}">
                            @else
                                <img id="mainImage" 
                                    src="{{ asset('assets/img/default.jpg') }}" 
                                    alt="{{ $produk->nama }}">
                            @endif
                            <div class="zoom-lens"></div>
                        </div>
                        <div class="image-controls">
                            <button class="control-btn prev-btn"><i class="fa fa-angle-left"></i></button>
                            <button class="control-btn next-btn"><i class="fa fa-angle-right"></i></button>
                            <button class="control-btn fullscreen-btn"><i class="fa fa-expand"></i></button>
                            <button class="control-btn autoplay-btn" title="Toggle auto-scroll">
                                <i class="fa fa-play"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Thumbnails Row -->
                    <div class="thumbnails-container">
                        <div class="thumbnails-slider">
                            @foreach ($produk->images as $key => $image)
                                <div class="thumbnail-item {{ $key === 0 ? 'active' : '' }}" data-index="{{ $key }}">
                                    <img src="{{ asset($image->gambar) }}" 
                                        alt="{{ $produk->nama }} thumbnail" 
                                        onclick="changeMainImage({{ $key }})">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Info - RIGHT Side -->
            <div class="col-lg-6">
                <div class="product-info-container">
                    <div class="badges mb-3">
                        <span class="badge bg-success">In Stock</span>
                        <span class="badge bg-primary">New Arrival</span>
                    </div>
                    
                    <h1 class="product-title">{{ $produk->nama }}</h1>
                    
                    <!-- Menampilkan harga produk -->
                    <div class="product-price mb-3">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </div>
                    
                    <div class="product-meta d-flex align-items-center mt-2 mb-4">
                        <div class="product-brand">
                            <span class="meta-label">Brand:</span>
                            <span class="meta-value">{{ $produk->merk }}</span>
                        </div>
                        <div class="product-id ms-4">
                            <span class="meta-label">SKU:</span>
                            <span class="meta-value">PD-{{ $produk->id }}</span>
                        </div>
                    </div>
                    
                    <div class="product-description mt-3 mb-4">
                        <p>{{ $produk->kegunaan ?? 'This product is perfect for any occasion. Crafted from quality materials, it offers superior performance and style.' }}</p>
                    </div>
                    
                    <div class="product-info-box mb-4">
                        <div class="info-row">
                            <div class="info-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="info-content">
                                <span class="info-label">{{ __('messages.merk') }}</span>
                                <span class="info-value">{{ $produk->merk }}</span>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><i class="fas fa-link"></i></div>
                            <div class="info-content">
                                <span class="info-label">{{ __('messages.link') }}</span>
                                <span class="info-value">
                                    <a href="{{$produk->link}}" target="_blank" class="external-link">
                                        {{ __('messages.click_here') }} <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Divider -->
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons mb-4">
                        <div class="row g-2">
                            <div class="col-6">
                                <button class="btn btn-outline-dark btn-action w-100">
                                    <i class="fas fa-file-download me-2"></i> E-Katalog
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-dark btn-action w-100">
                                    <i class="fas fa-info-circle me-2"></i> Read More
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quantity Controls and Add to Cart -->
                    <div class="cart-section">
                        <div class="d-flex align-items-center mb-4">
                            <div class="quantity-control me-3">
                                <button class="quantity-btn minus" aria-label="Decrease quantity">−</button>
                                <input type="text" value="1" class="quantity-input" readonly>
                                <button class="quantity-btn plus" aria-label="Increase quantity">+</button>
                            </div>
                            <button class="btn btn-light add-to-wishlist" aria-label="Add to wishlist">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="cta-buttons">
                            <button class="btn btn-dark add-to-cart-btn">
                                <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                            </button>
                            <button class="btn btn-success buy-now-btn mt-2">
                                <i class="fas fa-bolt me-2"></i> Buy Now
                            </button>
                        </div>
                    </div>
                    
                    <!-- Social Share -->
                    <div class="social-share mt-4">
                        <span class="share-label">Follow Us:</span>
                        <div class="share-buttons">
                            <a href="#" class="share-btn" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="share-btn" aria-label="Share on Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="share-btn" aria-label="Share on Pinterest"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="share-btn" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Details Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="product-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabs-1" role="tab">
                                <i class="fas fa-info-circle me-2"></i> Product Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-2" role="tab">
                                <i class="fas fa-list-ul me-2"></i> Specifications
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabs-1" role="tabpanel">
                            <div class="tab-content-inner">
                                <h4>{{ __('messages.description_product') }}</h4>
                                <div class="product-description-content">
                                    {!! $produk->deskripsi !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-2" role="tabpanel">
                            <div class="tab-content-inner">
                                <h4>Specifications</h4>
                                <div class="specifications-table">
                                    {!! $produk->spesifikasi !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section - MODIFIED FOR EYE ICON NAVIGATION -->
    <div class="related-products-section container mb-5 mt-5">
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title">{{ __('messages.related_products') }}</h2>
            <div class="slider-controls">
                <button class="control-btn related-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="control-btn related-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="related-products-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($produkSerupa as $similarProduct)
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="{{ route('product.show', $similarProduct->id) }}">
                                        <img src="{{ asset($similarProduct->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                            alt="{{ $similarProduct->nama }}">
                                    </a>
                                    <div class="product-actions">
                                        <!-- Changed from button to anchor with proper href -->
                                        <a href="{{ route('product.show', $similarProduct->id) }}" class="action-btn quick-view" title="View product details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="action-btn add-to-cart" data-id="{{ $similarProduct->id }}">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-title">
                                        <a href="{{ route('product.show', $similarProduct->id) }}">{{ $similarProduct->nama }}</a>
                                    </h5>
                                    <div class="product-brand">{{ $similarProduct->merk }}</div>
                                    <!-- Menampilkan harga produk serupa -->
                                    <div class="product-price">
                                        Rp {{ number_format($similarProduct->harga, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Image Lightbox Modal -->
    <div class="modal fade" id="imageLightbox" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="lightbox-container">
                        <div class="swiper-container lightbox-slider">
                            <div class="swiper-wrapper">
                                @foreach ($produk->images as $image)
                                    <div class="swiper-slide lightbox-slide">
                                        <img src="{{ asset($image->gambar) }}" alt="{{ $produk->nama }}" class="lightbox-image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="lightbox-controls">
                            <button class="lightbox-control lightbox-prev"><i class="fas fa-chevron-left"></i></button>
                            <button class="lightbox-control lightbox-next"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Main Layout */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #333;
            background-color: #f9f9f9;
        }
        
        .container {
            max-width: 1200px;
        }
        
        .product-detail-wrapper {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
            margin-top: 5rem; /* Changed from 30px to 5rem as requested */
            margin-bottom: 30px;
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .breadcrumb-item a {
            color: #555;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .breadcrumb-item a:hover {
            color: #000;
        }
        
        .breadcrumb-item.active {
            color: #222;
            font-weight: 500;
        }
        
        /* Badges */
        .badges .badge {
            border-radius: 4px;
            padding: 6px 12px;
            font-weight: 500;
            font-size: 12px;
            margin-right: 8px;
        }
        
        /* Product Title */
        .product-title {
            font-size: 32px;
            font-weight: 700;
            color: #000;
            margin-bottom: 15px;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }
        
        /* Product Price */
        .product-price {
            font-size: 28px;
            font-weight: 700;
            color: #000;
            margin-bottom: 10px;
        }
        
        /* Product Meta */
        .product-meta {
            font-size: 14px;
            color: #777;
        }
        
        .meta-label {
            color: #555;
            font-weight: 500;
            margin-right: 5px;
        }
        
        .meta-value {
            color: #222;
        }
        
        /* Product Gallery */
        .product-gallery {
            position: relative;
        }
        
        .main-image-container {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background-color: #f8f8f8;
            aspect-ratio: 1 / 1;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .image-zoom-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        
        #mainImage {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        
        .zoom-lens {
            position: absolute;
            border: 1px solid #ccc;
            width: 100px;
            height: 100px;
            display: none;
            background-color: rgba(255,255,255,0.4);
            pointer-events: none;
            cursor: crosshair;
        }
        
        .image-zoom-wrapper:hover .zoom-lens {
            display: block;
        }
        
        .image-controls {
            position: absolute;
            bottom: 20px;
            right: 20px;
            display: flex;
        }
        
        .control-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }
        
        .control-btn:hover {
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        
        .control-btn.autoplay-btn.active {
            background-color: #28a745;
            color: white;
        }
        
        .thumbnails-container {
            margin-top: 20px;
        }
        
        .thumbnails-slider {
            display: flex;
            overflow-x: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
            scroll-behavior: smooth;
            gap: 15px;
            padding: 5px 0;
        }
        
        .thumbnails-slider::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        
        .thumbnail-item {
            flex: 0 0 auto;
            width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s ease;
            opacity: 0.7;
        }
        
        .thumbnail-item:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .thumbnail-item.active {
            border-color: #000;
            opacity: 1;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Product Info */
        .product-info-container {
            padding-left: 20px;
        }
        
        .product-description {
            color: #555;
            line-height: 1.7;
            font-size: 16px;
        }
        
        .product-info-box {
            background-color: #f9f9f9;
            border-radius: 12px;
            padding: 20px;
        }
        
        .info-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .info-row:last-child {
            margin-bottom: 0;
        }
        
        .info-icon {
            flex: 0 0 24px;
            color: #000;
            margin-right: 15px;
            font-size: 18px;
        }
        
        .info-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-weight: 500;
            color: #666;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .info-value {
            color: #222;
            font-weight: 500;
        }
        
        .external-link {
            text-decoration: none;
            color: #007bff;
            display: inline-flex;
            align-items: center;
            transition: color 0.2s;
        }
        
        .external-link i {
            font-size: 14px;
            margin-left: 5px;
        }
        
        .external-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        
        /* Action Buttons */
        .btn-action {
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        /* Quantity Control */
        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }
        
        .quantity-btn {
            background: #f5f5f5;
            border: none;
            width: 45px;
            height: 45px;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            transition: all 0.2s;
        }
        
        .quantity-btn:hover {
            background: #e9e9e9;
        }
        
        .quantity-input {
            width: 50px;
            text-align: center;
            border: none;
            padding: 8px 0;
            font-size: 18px;
            font-weight: 500;
            background: #fff;
        }
        
        /* Updated wishlist button styles */
        .add-to-wishlist {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            border: 1px solid #e5e5e5;
            background-color: #fff;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }
        
        .add-to-wishlist:hover {
            background-color: #f9f9f9;
        }
        
        .add-to-wishlist i {
            font-size: 18px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .add-to-wishlist i.fas.fa-heart {
            color: #ff0000 !important;
        }
        
        .add-to-wishlist .heart-animation {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: rgba(255, 0, 0, 0.1);
            transform: scale(0);
            animation: heartPulse 0.4s forwards;
        }
        
        @keyframes heartPulse {
            0% { transform: scale(0); opacity: 1; }
            100% { transform: scale(3); opacity: 0; }
        }
        
        @keyframes heartBeat {
            0% { transform: scale(1); }
            15% { transform: scale(1.25); }
            30% { transform: scale(1); }
            45% { transform: scale(1.25); }
            60% { transform: scale(1); }
        }
        
        .heart-beat {
            animation: heartBeat 0.8s;
        }
        
        .cta-buttons {
            display: flex;
            flex-direction: column;
        }
        
        .add-to-cart-btn, .buy-now-btn {
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            transition: all 0.3s;
        }
        
        .add-to-cart-btn {
            background: #000;
            color: white;
            border: none;
        }
        
        .add-to-cart-btn:hover {
            background: #222;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .buy-now-btn {
            background: #28a745;
            color: white;
            border: none;
        }
        
        .buy-now-btn:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        
        /* Social Share */
        .social-share {
            display: flex;
            align-items: center;
        }
        
        .share-label {
            font-weight: 500;
            color: #666;
            margin-right: 15px;
        }
        
        .share-buttons {
            display: flex;
        }
        
        .share-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: #555;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .share-btn:hover {
            transform: translateY(-3px);
            color: #fff;
        }
        
        .share-btn:nth-child(1):hover {
            background-color: #3b5998;
        }
        
        .share-btn:nth-child(2):hover {
            background-color: #1da1f2;
        }
        
        .share-btn:nth-child(3):hover {
            background-color: #1da1f2;
        }
        
        .share-btn:nth-child(4):hover {
            background-color: #25d366;
        }
        
        /* Tabs */
        .product-tabs {
            margin-top: 60px;
        }
        
        .nav-tabs {
            border-bottom: 2px solid #eee;
            margin-bottom: 30px;
        }
        
        .nav-tabs .nav-item {
            margin-right: 40px;
        }
        
        .nav-tabs .nav-link {
            font-weight: 600;
            color: #888;
            padding: 15px 0;
            border: none;
            position: relative;
            transition: all 0.2s;
            font-size: 16px;
        }
        
        .nav-tabs .nav-link i {
            font-size: 18px;
            vertical-align: middle;
            margin-top: -2px;
        }
        
        .nav-tabs .nav-link:hover {
            color: #333;
        }
        
        .nav-tabs .nav-link.active {
            color: #000;
            background: none;
        }
        
        .nav-tabs .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #000;
            border-radius: 3px 3px 0 0;
        }
        
        .tab-content-inner {
            padding: 20px 0;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .tab-content-inner h4 {
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 22px;
            color: #000;
        }
        
        .product-description-content {
            line-height: 1.8;
            font-size: 16px;
            color: #444;
        }
        
        .specifications-table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }
        
        /* Related Products */
        .related-products-section {
            padding-top: 30px;
        }
        
        .section-header {
            margin-bottom: 30px;
        }
        
        .section-title {
            text-align: left;
            font-weight: 700;
            margin-bottom: 0;
            font-size: 28px;
            color: #000;
        }
        
        .slider-controls .control-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #fff;
            border: 1px solid #eee;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .slider-controls .control-btn:hover {
            background-color: #000;
            color: #fff;
            border-color: #000;
        }
        
        .product-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin: 10px 5px;
            background-color: #fff;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .product-image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }
        
        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover img {
            transform: scale(1.08);
        }
        
        .product-actions {
            position: absolute;
            bottom: -50px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            transition: bottom 0.3s ease;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        }
        
        .product-card:hover .product-actions {
            bottom: 0;
        }
        
        /* Updated styles for action buttons in related products */
        .product-actions .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: #333;
            text-decoration: none; /* Remove underline for anchor tag */
        }
        
        .product-actions .action-btn:hover {
            background-color: #000;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        /* Add subtle tooltip effect */
        .product-actions .action-btn.quick-view:hover::after {
            content: "View Details";
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0,0,0,0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
        }
        
        .product-card .product-info {
            padding: 20px;
            background-color: #fff;
        }
        
        .product-card .product-title {
            margin: 0;
            font-weight: 600;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }
        
        .product-card .product-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .product-card .product-title a:hover {
            color: #000;
        }
        
        .product-card .product-brand {
            color: #888;
            font-size: 14px;
        }
        
        /* Style untuk harga produk dalam kartu produk serupa */
        .product-card .product-price {
            font-size: 16px;
            font-weight: 700;
            color: #000;
            margin-top: 8px;
        }
        
        /* Lightbox Styles */
        .lightbox-container {
            position: relative;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .lightbox-slider {
            width: 100%;
            height: 100%;
        }
        
        .lightbox-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        
        .lightbox-image {
            max-height: 80vh;
            max-width: 100%;
            object-fit: contain;
        }
        
        .lightbox-controls {
            position: absolute;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 30px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }
        
        .lightbox-control {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 18px;
        }
        
        .lightbox-control:hover {
            background-color: #fff;
            transform: scale(1.1);
        }
        
        /* Auto-scroll animation */
        @keyframes fadeImage {
            0% { opacity: 1; }
            45% { opacity: 1; }
            55% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        
        .image-auto-scroll {
            animation: fadeImage 1s ease;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .product-detail-wrapper {
                padding: 30px 20px;
            }
            
            .product-info-container {
                padding-left: 0;
                margin-top: 40px;
            }
            
            .product-title {
                font-size: 28px;
            }
            
            .product-price {
                font-size: 24px;
            }
            
            .main-image-container {
                aspect-ratio: 4/3;
            }
            
            .nav-tabs .nav-item {
                margin-right: 20px;
            }
        }
        
        @media (max-width: 768px) {
            .product-detail-wrapper {
                padding: 20px 15px;
                border-radius: 10px;
            }
            
            .product-title {
                font-size: 24px;
            }
            
            .product-price {
                font-size: 20px;
            }
            
            .action-buttons .row {
                margin: 0 -5px;
            }
            
            .action-buttons .col-6 {
                padding: 0 5px;
            }
            
            .btn-action {
                padding: 10px;
                font-size: 12px;
            }
            
            .quantity-btn, .quantity-input, .add-to-wishlist {
                height: 40px;
            }
            
            .quantity-btn {
                width: 40px;
            }
            
            .add-to-cart-btn, .buy-now-btn {
                padding: 12px;
                font-size: 14px;
            }
            
            .nav-tabs .nav-link {
                padding: 10px 0;
                font-size: 14px;
            }
            
            .nav-tabs .nav-item {
                margin-right: 15px;
            }
            
            .section-title {
                font-size: 22px;
            }
            
            .slider-controls .control-btn {
                width: 36px;
                height: 36px;
            }
            
            .lightbox-container {
                height: 60vh;
            }
        }
    </style>

    <!-- Make sure to include FontAwesome and Swiper JS in your main layout or add them here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image Zoom Effect
            const mainImage = document.getElementById('mainImage');
            const zoomLens = document.querySelector('.zoom-lens');
            const zoomWrapper = document.querySelector('.image-zoom-wrapper');
            
            if (zoomWrapper && zoomLens && mainImage) {
                zoomWrapper.addEventListener('mousemove', function(e) {
                    // Get cursor position
                    const rect = zoomWrapper.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    // Position lens
                    const lensWidth = zoomLens.offsetWidth;
                    const lensHeight = zoomLens.offsetHeight;
                    
                    let lensX = x - lensWidth / 2;
                    let lensY = y - lensHeight / 2;
                    
                    // Make sure lens doesn't go outside the image
                    if (lensX < 0) lensX = 0;
                    if (lensY < 0) lensY = 0;
                    if (lensX > rect.width - lensWidth) lensX = rect.width - lensWidth;
                    if (lensY > rect.height - lensHeight) lensY = rect.height - lensHeight;
                    
                    // Position the lens
                    zoomLens.style.left = lensX + 'px';
                    zoomLens.style.top = lensY + 'px';
                    
                    // Apply zoom effect to main image
                    const zoomRatio = 1.5;
                    const percentX = (lensX + lensWidth/2) / rect.width * 100;
                    const percentY = (lensY + lensHeight/2) / rect.height * 100;
                    
                    mainImage.style.transformOrigin = `${percentX}% ${percentY}%`;
                    mainImage.style.transform = `scale(${zoomRatio})`;
                });
                
                zoomWrapper.addEventListener('mouseleave', function() {
                    mainImage.style.transform = 'scale(1)';
                });
            }
            
            // Initialize Swiper for related products
            const relatedSwiper = new Swiper('.related-products-slider .swiper-container', {
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.related-next',
                    prevEl: '.related-prev',
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    992: {
                        slidesPerView: 4,
                    }
                }
            });
            
            // Initialize Lightbox Swiper
            const lightboxSwiper = new Swiper('.lightbox-slider', {
                slidesPerView: 1,
                spaceBetween: 0,
                navigation: {
                    nextEl: '.lightbox-next',
                    prevEl: '.lightbox-prev',
                },
            });
            
            // Fullscreen button
            const fullscreenBtn = document.querySelector('.fullscreen-btn');
            const imageLightbox = new bootstrap.Modal(document.getElementById('imageLightbox'));
            
            if (fullscreenBtn) {
                fullscreenBtn.addEventListener('click', function() {
                    imageLightbox.show();
                    
                    // Get current image index and slide to it
                    const currentIndex = parseInt(document.querySelector('.thumbnail-item.active').dataset.index);
                    lightboxSwiper.slideTo(currentIndex, 0);
                });
            }
            
            // Quantity buttons functionality
            const minusBtn = document.querySelector('.minus');
            const plusBtn = document.querySelector('.plus');
            const quantityInput = document.querySelector('.quantity-input');
            
            if (minusBtn && plusBtn && quantityInput) {
                minusBtn.addEventListener('click', function() {
                    let value = parseInt(quantityInput.value);
                    if (value > 1) {
                        quantityInput.value = value - 1;
                    }
                });
                
                plusBtn.addEventListener('click', function() {
                    let value = parseInt(quantityInput.value);
                    quantityInput.value = value + 1;
                });
            }
            
            // Enhanced wishlist heart animation
            const wishlistBtn = document.querySelector('.add-to-wishlist');
            if (wishlistBtn) {
                wishlistBtn.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    
                    // Create ripple animation element
                    const ripple = document.createElement('span');
                    ripple.classList.add('heart-animation');
                    this.appendChild(ripple);
                    
                    // Remove ripple after animation completes
                    setTimeout(() => {
                        ripple.remove();
                    }, 400);
                    
                    if (icon.classList.contains('far')) {
                        // Change from outline to solid heart
                        icon.classList.remove('far');
                        icon.classList.add('fas', 'heart-beat');
                        
                        // Make sure the color is set to red
                        icon.style.color = '#ff0000';
                        
                        // Remove the animation class after it completes
                        setTimeout(() => {
                            icon.classList.remove('heart-beat');
                        }, 800);
                    } else {
                        // Change back to outline heart
                        icon.classList.remove('fas', 'heart-beat');
                        icon.classList.add('far');
                        icon.style.color = '#333';
                    }
                });
            }
            
            // Auto-scroll functionality
            let autoScrollInterval;
            let isAutoScrolling = false;
            const autoplayBtn = document.querySelector('.autoplay-btn');
            const imageCount = {{ count($produk->images) }};
            
            // Function to start auto-scrolling
            function startAutoScroll() {
                if (imageCount <= 1) return; // Don't auto-scroll if there's only one image
                
                isAutoScrolling = true;
                autoplayBtn.classList.add('active');
                autoplayBtn.innerHTML = '<i class="fa fa-pause"></i>';
                
                autoScrollInterval = setInterval(() => {
                    const currentThumb = document.querySelector('.thumbnail-item.active');
                    const currentIndex = parseInt(currentThumb.dataset.index);
                    const newIndex = currentIndex < {{ count($produk->images) - 1 }} ? currentIndex + 1 : 0;
                    
                    // Add fade animation class
                    mainImage.classList.add('image-auto-scroll');
                    
                    // Change image after a short delay to allow animation to work
                    setTimeout(() => {
                        changeMainImage(newIndex);
                        // Remove animation class after change
                        setTimeout(() => {
                            mainImage.classList.remove('image-auto-scroll');
                        }, 100);
                    }, 300);
                    
                }, 3000); // Change image every 3 seconds
            }
            
            // Function to stop auto-scrolling
            function stopAutoScroll() {
                isAutoScrolling = false;
                clearInterval(autoScrollInterval);
                autoplayBtn.classList.remove('active');
                autoplayBtn.innerHTML = '<i class="fa fa-play"></i>';
            }
            
            // Toggle auto-scroll on button click
            if (autoplayBtn) {
                autoplayBtn.addEventListener('click', function() {
                    if (isAutoScrolling) {
                        stopAutoScroll();
                    } else {
                        startAutoScroll();
                    }
                });
            }
            
            // Start auto-scroll by default when page loads
            startAutoScroll();
            
            // Pause auto-scroll when hovering on the image
            if (zoomWrapper) {
                zoomWrapper.addEventListener('mouseenter', function() {
                    if (isAutoScrolling) {
                        clearInterval(autoScrollInterval);
                    }
                });
                
                zoomWrapper.addEventListener('mouseleave', function() {
                    if (isAutoScrolling) {
                        startAutoScroll();
                    }
                });
            }
        });
        
        // Function to change main image
        function changeMainImage(index) {
            const images = @json($produk->images->pluck('gambar'));
            const mainImage = document.getElementById('mainImage');
            
            if (images[index]) {
                mainImage.src = "{{ asset('') }}" + images[index];
                mainImage.dataset.zoom = "{{ asset('') }}" + images[index];
                
                // Remove active class from all thumbnails
                document.querySelectorAll('.thumbnail-item').forEach(thumb => {
                    thumb.classList.remove('active');
                });
                
                // Add active class to selected thumbnail
                document.querySelector(`.thumbnail-item[data-index="${index}"]`).classList.add('active');
            }
        }
        
        // Image navigation buttons
        document.addEventListener('DOMContentLoaded', function() {
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            
            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', function() {
                    const currentThumb = document.querySelector('.thumbnail-item.active');
                    const currentIndex = parseInt(currentThumb.dataset.index);
                    const newIndex = currentIndex > 0 ? currentIndex - 1 : {{ count($produk->images) - 1 }};
                    changeMainImage(newIndex);
                });
                
                nextBtn.addEventListener('click', function() {
                    const currentThumb = document.querySelector('.thumbnail-item.active');
                    const currentIndex = parseInt(currentThumb.dataset.index);
                    const newIndex = currentIndex < {{ count($produk->images) - 1 }} ? currentIndex + 1 : 0;
                    changeMainImage(newIndex);
                });
            }
        });
    </script>
@endsection