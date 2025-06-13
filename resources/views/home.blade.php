@extends('layouts.Member.master')

@section('content')
    <!-- Simple Preloader -->
    <div id="preloader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 9999; display: flex; justify-content: center; align-items: center;">
        <div style="width: 40px; height: 40px; border: 3px solid #f3f3f3; border-top: 3px solid #2563eb; border-radius: 50%; animation: spin 1s linear infinite;"></div>
    </div>

    <!-- Alerts -->
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
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <h4 class="alert-heading"><i class="fas fa-check-circle"></i> Berhasil!</h4>
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Banner Section -->
    <div class="modern-header">
        <div id="backgroundSlider" class="wave-bg"></div>
        
        <div class="container-fluid p-0">
            <div class="row g-0 h-100">
                <!-- MODERN FLOATING CATEGORIES SECTION -->
                <div class="col-lg-auto col-md-auto category-sidebar-modern">
                    <div class="categories-floating-panel">
                        <!-- Categories Header with Grid Icon -->
                        <div class="categories-floating-header">
                            <div class="floating-grid-icon">
                                <div class="grid-dots">
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Categories List -->
                        <div class="categories-floating-list">
                            <!-- Computer & Laptop -->
                            <div class="category-floating-item active" data-category="1">
                                <div class="category-floating-icon">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                <div class="category-floating-content">
                                    <a href="{{ route('filterByCategory', 1) }}" class="category-floating-link">
                                        <span class="category-floating-name">Computer & Laptop</span>
                                    </a>
                                </div>
                                <div class="category-floating-arrow">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>

                            <!-- Printer & Scanner -->
                            <div class="category-floating-item" data-category="2">
                                <div class="category-floating-icon">
                                    <i class="fas fa-print"></i>
                                </div>
                                <div class="category-floating-content">
                                    <a href="{{ route('filterByCategory', 2) }}" class="category-floating-link">
                                        <span class="category-floating-name">Printer & Scanner</span>
                                    </a>
                                </div>
                                <div class="category-floating-arrow">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>

                            <!-- Air Conditioner -->
                            <div class="category-floating-item" data-category="3">
                                <div class="category-floating-icon">
                                    <i class="fas fa-wind"></i>
                                </div>
                                <div class="category-floating-content">
                                    <a href="{{ route('filterByCategory', 3) }}" class="category-floating-link">
                                        <span class="category-floating-name">Air Conditioner</span>
                                    </a>
                                </div>
                                <div class="category-floating-arrow">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>

                            <!-- Television & Video -->
                            <div class="category-floating-item" data-category="4">
                                <div class="category-floating-icon">
                                    <i class="fas fa-tv"></i>
                                </div>
                                <div class="category-floating-content">
                                    <a href="{{ route('filterByCategory', 4) }}" class="category-floating-link">
                                        <span class="category-floating-name">Television & Video</span>
                                    </a>
                                </div>
                                <div class="category-floating-arrow">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>

                            <!-- Camera & Photography -->
                            <div class="category-floating-item" data-category="5">
                                <div class="category-floating-icon">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <div class="category-floating-content">
                                    <a href="{{ route('filterByCategory', 5) }}" class="category-floating-link">
                                        <span class="category-floating-name">Camera & Photography</span>
                                    </a>
                                </div>
                                <div class="category-floating-arrow">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>

                            <!-- Networking -->
                            <div class="category-floating-item" data-category="6">
                                <div class="category-floating-icon">
                                    <i class="fas fa-network-wired"></i>
                                </div>
                                <div class="category-floating-content">
                                    <a href="{{ route('filterByCategory', 6) }}" class="category-floating-link">
                                        <span class="category-floating-name">Networking</span>
                                    </a>
                                </div>
                                <div class="category-floating-arrow">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Footer -->
                        <div class="categories-floating-footer">
                            <a href="{{ route('product.index') }}" class="view-all-floating">
                                <div class="view-all-floating-icon">
                                    <div class="mini-grid-dots">
                                        <span class="mini-dot"></span>
                                        <span class="mini-dot"></span>
                                        <span class="mini-dot"></span>
                                        <span class="mini-dot"></span>
                                    </div>
                                </div>
                                <span class="view-all-floating-text">View All Categories</span>
                                <div class="view-all-floating-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END MODERN FLOATING CATEGORIES SECTION -->
                
                <!-- Middle Content Section -->
                <div class="col header-content">
                    <div id="sliderContent" class="content-wrapper">
                        <!-- Content will be dynamically updated by JavaScript -->
                    </div>
                </div>
                
                <!-- Right Featured Product Section -->
                <div class="col-lg-4 col-md-4 featured-product">
                    @if(isset($produks) && !$produks->isEmpty())
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

    <!-- All Products Section -->
    @if(isset($produks) && !$produks->isEmpty())
    <section class="products-section all-products">
        <div class="container">
            <div class="section-header-elegant">
                <div class="header-wrapper">
                    <div class="section-tag">
                        <span class="tag-dot"></span>
                        <span class="tag-text">Explore Our Collection</span>
                    </div>
                    
                    <h2 class="section-title-elegant">
                        Premium Technology
                    </h2>
                    
                    <div class="section-divider">
                        <div class="divider-line"></div>
                        <div class="divider-icon">
                            <i class="fas fa-diamond"></i>
                        </div>
                        <div class="divider-line"></div>
                    </div>
                    
                    <p class="section-description-elegant">
                        Handpicked selection of cutting-edge devices designed to elevate your digital lifestyle to extraordinary heights
                    </p>
                </div>
                
                <div class="header-actions-elegant">
                    <div class="filter-tabs">
                        <button class="tab-btn active" data-filter="all">All Products</button>
                        <button class="tab-btn" data-filter="featured">Featured</button>
                        <button class="tab-btn" data-filter="sale">On Sale</button>
                    </div>
                    <a href="{{ route('product.index') }}" class="view-all-btn-elegant">
                        <span>View All Products</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="products-grid">
                @foreach ($produks->take(8) as $index => $product)
                <div class="product-card" data-category="all {{ $index % 3 == 0 ? 'featured' : '' }} {{ $index % 4 == 0 ? 'sale' : '' }}">
                    <!-- Logo Badge -->
                    <div class="brand-badge">
                        <img src="{{ asset('assets/img/Logo.png') }}" alt="Brand Logo">
                    </div>
                    
                    @if($index % 3 == 0)
                    <div class="featured-badge">
                        <i class="fas fa-star"></i>
                        <span>Featured</span>
                    </div>
                    @endif
                    
                    @if($index % 4 == 0)
                    <div class="sale-badge">
                        <span>{{ rand(10, 40) }}% OFF</span>
                    </div>
                    @endif
                    
                    <div class="product-image">
                        <img src="{{ asset($product->images->first()->gambar ?? 'assets/img/default.jpg') }}" alt="{{ $product->nama }}">
                        <div class="image-overlay">
                            <div class="overlay-actions">
                                <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                                <a href="{{ route('product.show', $product->id) }}" class="action-btn view-btn" title="Quick View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-info">
                        <div class="product-category">{{ $product->category->nama ?? 'Electronics' }}</div>
                        <h3 class="product-name">
                            <a href="{{ route('product.show', $product->id) }}">{{ Str::limit($product->nama, 50) }}</a>
                        </h3>
                        
                        <div class="product-price">
                            @if($index % 4 == 0)
                            <span class="original-price">IDR {{ number_format($product->harga * 1.3, 0, ',', '.') }}</span>
                            @endif
                            <span class="current-price">IDR {{ number_format($product->harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="product-actions">
                            <button class="btn-add-cart" onclick="addToCart(this)">
                                <i class="fas fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Fresh Arrivals Section -->
    @if(isset($produks) && !$produks->isEmpty())
    <section class="products-section fresh-arrivals">
        <div class="container">
            <div class="section-header-elegant fresh-theme">
                <div class="header-wrapper">
                    <div class="section-tag">
                        <span class="tag-dot"></span>
                        <span class="tag-text">Hot Off The Press</span>
                    </div>
                    
                    <h2 class="section-title-elegant">
                        Fresh Innovations
                    </h2>
                    
                    <div class="section-divider">
                        <div class="divider-line"></div>
                        <div class="divider-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="divider-line"></div>
                    </div>
                    
                    <p class="section-description-elegant">
                        Be the first to experience tomorrow's technology today with our latest revolutionary arrivals
                    </p>
                </div>
            </div>
            
            <div class="products-grid">
                @foreach ($produks->sortByDesc('created_at')->take(6) as $index => $freshProduct)
                <div class="product-card fresh-card">
                    <!-- Logo Badge -->
                    <div class="brand-badge">
                        <img src="{{ asset('assets/img/Logo.png') }}" alt="Brand Logo">
                    </div>
                    
                    <div class="fresh-badge">
                        <span>NEW</span>
                    </div>
                    
                    <div class="product-image">
                        <img src="{{ asset($freshProduct->images->first()->gambar ?? 'assets/img/default.jpg') }}" alt="{{ $freshProduct->nama }}">
                        <div class="image-overlay">
                            <div class="overlay-actions">
                                <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                                <a href="{{ route('product.show', $freshProduct->id) }}" class="action-btn view-btn" title="Quick View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-info">
                        <div class="product-category">{{ $freshProduct->category->nama ?? 'Technology' }}</div>
                        <h3 class="product-name">
                            <a href="{{ route('product.show', $freshProduct->id) }}">{{ Str::limit($freshProduct->nama, 50) }}</a>
                        </h3>
                        
                        <div class="product-features">
                            <span class="feature-item">✓ Latest Innovation</span>
                            <span class="feature-item">✓ Premium Build</span>
                        </div>
                        
                        <div class="product-price">
                            <span class="current-price">IDR {{ number_format($freshProduct->harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="product-actions">
                            <button class="btn-add-cart" onclick="addToCart(this)">
                                <i class="fas fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Best Sellers Section -->
    @if(isset($produks) && !$produks->isEmpty())
    <section class="products-section bestsellers">
        <div class="container">
            <div class="section-header-elegant bestseller-theme">
                <div class="header-wrapper">
                    <div class="section-tag">
                        <span class="tag-dot"></span>
                        <span class="tag-text">Crowd Favorites</span>
                    </div>
                    
                    <h2 class="section-title-elegant">
                        Bestselling Heroes
                    </h2>
                    
                    <div class="section-divider">
                        <div class="divider-line"></div>
                        <div class="divider-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="divider-line"></div>
                    </div>
                    
                    <p class="section-description-elegant">
                        Join thousands of happy customers who chose these proven champions of technology excellence
                    </p>
                </div>
            </div>
            
            <div class="products-grid">
                @foreach ($produks->take(6) as $index => $bestSeller)
                <div class="product-card bestseller-card">
                    <!-- Logo Badge -->
                    <div class="brand-badge">
                        <img src="{{ asset('assets/img/Logo.png') }}" alt="Brand Logo">
                    </div>
                    
                    <div class="bestseller-badge">
                        <i class="fas fa-crown"></i>
                        <span>Top Pick</span>
                    </div>
                    
                    <div class="product-image">
                        <img src="{{ asset($bestSeller->images->first()->gambar ?? 'assets/img/default.jpg') }}" alt="{{ $bestSeller->nama }}">
                        <div class="image-overlay">
                            <div class="overlay-actions">
                                <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                                <a href="{{ route('product.show', $bestSeller->id) }}" class="action-btn view-btn" title="Quick View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-info">
                        <div class="product-category">{{ $bestSeller->category->nama ?? 'Electronics' }}</div>
                        <h3 class="product-name">
                            <a href="{{ route('product.show', $bestSeller->id) }}">{{ Str::limit($bestSeller->nama, 50) }}</a>
                        </h3>
                        
                        <div class="product-price">
                            <span class="current-price">IDR {{ number_format($bestSeller->harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="product-actions">
                            <button class="btn-add-cart" onclick="addToCart(this)">
                                <i class="fas fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- MODERN FLOATING DESIGN CSS STYLING -->
    <style>
        /* ===== GLOBAL VARIABLES & RESET ===== */
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --white-color: #ffffff;
            --purple-light: #e879f9;
            --purple-dark: #7c3aed;
            --pink-light: #f472b6;
            --pink-dark: #ec4899;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --dark-overlay: rgba(0, 0, 0, 0.5);
            --shadow-glass: 0 8px 32px rgba(31, 38, 135, 0.37);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --pink-accent: #e91e63;
            --floating-bg: rgba(255, 255, 255, 0.15);
            --floating-border: rgba(255, 255, 255, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            background-color: var(--white-color);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        @keyframes dotPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(0.9); }
        }

        @keyframes floatingShine {
            0% { transform: translateX(-100%) skewX(-15deg); }
            100% { transform: translateX(200%) skewX(-15deg); }
        }

        /* ===== ALERTS ===== */
        .alert {
            animation: fadeInUp 0.5s ease forwards;
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--shadow-glass);
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .alert-success {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            border: 1px solid #4ade80;
        }

        /* ===== MODERN FLOATING CATEGORIES SECTION ===== */
        .modern-header {
            position: relative;
            min-height: 800px;
            overflow: hidden;
            margin-bottom: 0;
            display: flex;
            align-items: center;
        }

        .modern-header .row {
            height: 100%;
            align-items: center;
        }

        .category-sidebar-modern {
            width: 200px;
            position: relative;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            height: 100%;
        }

        .categories-floating-panel {
            width: 100%;
            max-width: 180px;
            background: var(--floating-bg);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 2px solid var(--floating-border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 10px 20px rgba(255, 255, 255, 0.1) inset;
            position: relative;
            transition: var(--transition);
        }

        .categories-floating-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            transition: left 0.6s ease;
            pointer-events: none;
        }

        .categories-floating-panel:hover::before {
            left: 100%;
        }

        .categories-floating-panel:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.15),
                0 15px 30px rgba(255, 255, 255, 0.15) inset;
        }

        /* Categories Header with Grid Dots */
        .categories-floating-header {
            background: linear-gradient(135deg, var(--pink-accent), #ad1457);
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .categories-floating-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20px;
            width: 80px;
            height: 120px;
            background: radial-gradient(
                ellipse,
                rgba(255, 255, 255, 0.15) 0%,
                transparent 70%
            );
            animation: float 4s ease-in-out infinite;
        }

        .floating-grid-icon {
            position: relative;
            z-index: 2;
        }

        .grid-dots {
            display: grid;
            grid-template-columns: repeat(3, 6px);
            grid-template-rows: repeat(3, 6px);
            gap: 3px;
        }

        .dot {
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            transition: var(--transition);
            animation: dotPulse 2s ease-in-out infinite;
        }

        .dot:nth-child(1) { animation-delay: 0s; }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }
        .dot:nth-child(4) { animation-delay: 0.6s; }
        .dot:nth-child(5) { animation-delay: 0.8s; }
        .dot:nth-child(6) { animation-delay: 1s; }
        .dot:nth-child(7) { animation-delay: 1.2s; }
        .dot:nth-child(8) { animation-delay: 1.4s; }
        .dot:nth-child(9) { animation-delay: 1.6s; }

        .categories-floating-panel:hover .dot {
            background: white;
            transform: scale(1.2);
        }

        /* Categories List */
        .categories-floating-list {
            padding: 0;
        }

        .category-floating-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            cursor: pointer;
            transition: var(--transition);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            background: transparent;
        }

        .category-floating-item:last-child {
            border-bottom: none;
        }

        .category-floating-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(180deg, var(--pink-accent), #ad1457);
            transform: scaleY(0);
            transition: transform 0.4s ease;
            transform-origin: bottom;
            border-radius: 0 3px 3px 0;
        }

        .category-floating-item.active::before,
        .category-floating-item:hover::before {
            transform: scaleY(1);
        }

        .category-floating-item:hover {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .category-floating-item.active {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
        }

        .category-floating-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
            margin-right: 12px;
            transition: var(--transition);
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .category-floating-item:hover .category-floating-icon,
        .category-floating-item.active .category-floating-icon {
            color: white;
            background: var(--pink-accent);
            border-color: var(--pink-accent);
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 4px 15px rgba(233, 30, 99, 0.4);
        }

        .category-floating-content {
            flex: 1;
            min-width: 0;
        }

        .category-floating-link {
            text-decoration: none;
            display: block;
        }

        .category-floating-name {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.8rem;
            font-weight: 600;
            transition: var(--transition);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
        }

        .category-floating-item:hover .category-floating-name,
        .category-floating-item.active .category-floating-name {
            color: white;
            text-shadow: 0 2px 10px rgba(233, 30, 99, 0.3);
        }

        .category-floating-arrow {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.7rem;
            transition: var(--transition);
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .category-floating-item:hover .category-floating-arrow {
            color: white;
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(3px) scale(1.1);
        }

        /* Categories Footer */
        .categories-floating-footer {
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .view-all-floating {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            transition: var(--transition);
            padding: 8px 10px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .view-all-floating:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .view-all-floating-icon {
            flex-shrink: 0;
        }

        .mini-grid-dots {
            display: grid;
            grid-template-columns: repeat(2, 4px);
            grid-template-rows: repeat(2, 4px);
            gap: 2px;
        }

        .mini-dot {
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            transition: var(--transition);
        }

        .view-all-floating:hover .mini-dot {
            background: white;
            transform: scale(1.2);
        }

        .view-all-floating-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .view-all-floating-arrow {
            font-size: 0.65rem;
            transition: var(--transition);
            flex-shrink: 0;
        }

        .view-all-floating:hover .view-all-floating-arrow {
            transform: translateX(3px);
        }

        /* ===== BANNER SECTION ===== */
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
            background: linear-gradient(135deg, #FF1493 0%, #8A2BE2 50%, #6A0DAD 100%);
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
            background: linear-gradient(135deg, 
                rgba(255, 20, 147, 0.4) 0%, 
                rgba(138, 43, 226, 0.3) 50%, 
                rgba(106, 13, 173, 0.3) 100%);
            z-index: 1;
        }
        
        .header-content {
            padding: 60px 30px;
            position: relative;
            z-index: 2;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        .content-wrapper {
            max-width: 600px;
            width: 100%;
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
        }
        
        .design-description {
            color: rgba(255,255,255,0.9);
            font-size: 1rem;
            line-height: 1.6;
            margin-top: 20px;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
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
        
        .featured-product {
            padding: 60px 30px;
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
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 20px;
            box-shadow: var(--shadow-glass);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .featured-product .product-image {
            text-align: center;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            flex: 0 0 auto;
            max-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .featured-product .product-image img {
            max-width: 100%;
            height: auto;
            max-height: 140px;
            object-fit: contain;
        }
        
        .featured-product .product-info {
            padding: 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .featured-product .product-info h3 {
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.2;
        }
        
        .featured-product .product-info p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            margin-bottom: 15px;
            line-height: 1.5;
            flex: 1;
        }
        
        .featured-product .product-price {
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .featured-product .product-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }
        
        .featured-product .add-to-cart {
            flex: 1;
            background: linear-gradient(135deg, #FF1493, #8A2BE2);
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
        
        .featured-product .add-to-cart:hover {
            background: linear-gradient(135deg, #ff69b4, #9d4edd);
            transform: translateY(-3px);
            color: white;
        }
        
        .featured-product .cart-icon {
            width: 40px;
            height: 40px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .featured-product .cart-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
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
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
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
            background: rgba(255, 255, 255, 0.2);
            color: white;
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
            background: rgba(255,255,255,0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .indicator.active {
            background: white;
            transform: scale(1.3);
        }

        /* ===== ELEGANT SECTION HEADERS ===== */
        .section-header-elegant {
            text-align: center;
            margin-bottom: 70px;
            padding: 50px 0;
            position: relative;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .header-wrapper {
            position: relative;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.8);
            padding: 8px 20px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(37, 99, 235, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .fresh-theme .section-tag {
            border-color: rgba(16, 185, 129, 0.2);
        }

        .bestseller-theme .section-tag {
            border-color: rgba(139, 92, 246, 0.2);
        }

        .tag-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary-color);
            animation: pulse 2s ease-in-out infinite;
        }

        .fresh-theme .tag-dot {
            background: var(--success-color);
        }

        .bestseller-theme .tag-dot {
            background: #8b5cf6;
        }

        .tag-text {
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title-elegant {
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--dark-color);
            line-height: 1.1;
            margin-bottom: 30px;
            position: relative;
            letter-spacing: -1px;
        }

        .section-title-elegant::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        }

        .fresh-theme .section-title-elegant::before {
            background: linear-gradient(90deg, transparent, var(--success-color), transparent);
        }

        .bestseller-theme .section-title-elegant::before {
            background: linear-gradient(90deg, transparent, #8b5cf6, transparent);
        }

        .section-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
        }

        .divider-line {
            height: 1px;
            width: 80px;
            background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
        }

        .divider-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .fresh-theme .divider-icon {
            background: linear-gradient(135deg, var(--success-color), #34d399);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .bestseller-theme .divider-icon {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .section-description-elegant {
            font-size: 1.25rem;
            color: #475569;
            line-height: 1.7;
            max-width: 600px;
            margin: 0 auto 40px;
            font-weight: 400;
        }

        .header-actions-elegant {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .filter-tabs {
            display: flex;
            background: var(--white-color);
            border-radius: 50px;
            padding: 6px;
            gap: 6px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .tab-btn {
            padding: 12px 24px;
            border: none;
            background: transparent;
            color: #475569;
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 25px;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .tab-btn.active,
        .tab-btn:hover {
            background: linear-gradient(135deg, var(--primary-color), #3b82f6);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        .view-all-btn-elegant {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--dark-color), #334155);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 12px 30px;
            border-radius: 25px;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 25px rgba(30, 41, 59, 0.3);
        }

        .view-all-btn-elegant:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(30, 41, 59, 0.4);
            color: white;
        }

        .view-all-btn-elegant i {
            transition: transform 0.3s ease;
        }

        .view-all-btn-elegant:hover i {
            transform: translateX(5px);
        }

        /* ===== PRODUCTS SECTIONS ===== */
        .products-section {
            padding: 80px 0;
        }

        .all-products {
            background: var(--white-color);
        }

        .fresh-arrivals {
            background: #f1f5f9;
        }

        .bestsellers {
            background: var(--white-color);
        }

        /* ===== PRODUCTS GRID - RESPONSIVE ===== */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        /* ===== PRODUCT CARD ===== */
        .product-card {
            background: var(--white-color);
            border-radius: var(--border-radius);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: var(--transition);
            position: relative;
            transform: translateY(0);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }

        .brand-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 10;
            background: var(--white-color);
            padding: 6px 8px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .brand-badge img {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }

        .featured-badge,
        .fresh-badge,
        .bestseller-badge,
        .sale-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 5;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .featured-badge {
            background: linear-gradient(45deg, var(--accent-color), #d97706);
            color: var(--white-color);
        }

        .fresh-badge {
            background: linear-gradient(45deg, var(--success-color), #059669);
            color: var(--white-color);
        }

        .bestseller-badge {
            background: linear-gradient(45deg, #8b5cf6, #7c3aed);
            color: var(--white-color);
        }

        .sale-badge {
            background: linear-gradient(45deg, var(--danger-color), #dc2626);
            color: var(--white-color);
        }

        .product-image {
            position: relative;
            height: 250px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            transition: var(--transition);
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .product-card:hover .image-overlay {
            opacity: 1;
        }

        .overlay-actions {
            display: flex;
            gap: 12px;
            transform: translateY(20px);
            transition: var(--transition);
        }

        .product-card:hover .overlay-actions {
            transform: translateY(0);
        }

        .action-btn {
            width: 44px;
            height: 44px;
            background: var(--white-color);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-color);
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .action-btn:hover {
            background: var(--primary-color);
            color: var(--white-color);
            transform: scale(1.1);
        }

        .wishlist-btn.active {
            background: var(--danger-color);
            color: var(--white-color);
        }

        .product-info {
            padding: 24px;
        }

        .product-category {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-name {
            margin-bottom: 12px;
        }

        .product-name a {
            color: var(--dark-color);
            text-decoration: none;
            font-size: 1.125rem;
            font-weight: 600;
            line-height: 1.4;
            transition: var(--transition);
            display: block;
        }

        .product-name a:hover {
            color: var(--primary-color);
        }

        .product-features {
            margin-bottom: 16px;
        }

        .feature-item {
            display: block;
            font-size: 0.875rem;
            color: var(--success-color);
            margin-bottom: 4px;
            font-weight: 500;
        }

        .product-price {
            margin-bottom: 20px;
        }

        .original-price {
            color: #64748b;
            text-decoration: line-through;
            font-size: 0.875rem;
            margin-right: 8px;
        }

        .current-price {
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: 700;
        }

        .product-actions {
            display: flex;
            gap: 12px;
        }

        .btn-add-cart {
            flex: 1;
            background: var(--primary-color);
            color: var(--white-color);
            border: none;
            padding: 12px 16px;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content:             center;
            gap: 8px;
            font-size: 0.875rem;
        }

        .btn-add-cart:hover {
            background: var(--dark-color);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1199px) {
            .category-sidebar-modern {
                width: 180px;
            }
            
            .categories-floating-panel {
                max-width: 160px;
            }
            
            .section-title-elegant {
                font-size: 3rem;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 25px;
            }
        }

        @media (max-width: 991px) {
            .category-sidebar-modern {
                width: 100%;
                max-width: 200px;
                margin: 0 auto 30px;
                order: 3;
                padding: 20px;
                height: auto;
            }
            
            .categories-floating-panel {
                max-width: 100%;
            }
            
            .modern-header {
                display: block;
            }
            
            .modern-header .row {
                height: auto;
            }
            
            .section-title-elegant {
                font-size: 2.5rem;
            }
            
            .section-description-elegant {
                font-size: 1.125rem;
            }
            
            .header-actions-elegant {
                flex-direction: column;
                gap: 20px;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 20px;
            }

            .modern-header {
                min-height: 600px;
            }
            
            .header-content {
                padding: 80px 20px 40px;
            }
            
            .featured-product {
                padding: 80px 20px 40px;
            }
        }

        @media (max-width: 768px) {
            .category-sidebar-modern {
                width: 100%;
                max-width: none;
                margin-bottom: 20px;
                padding: 15px;
            }
            
            .categories-floating-panel {
                border-radius: 15px;
            }
            
            .categories-floating-header {
                padding: 12px;
            }
            
            .grid-dots {
                grid-template-columns: repeat(3, 5px);
                grid-template-rows: repeat(3, 5px);
                gap: 2px;
            }
            
            .dot {
                width: 5px;
                height: 5px;
            }
            
            .category-floating-item {
                padding: 10px 12px;
            }
            
            .category-floating-icon {
                width: 20px;
                height: 20px;
                font-size: 0.75rem;
                margin-right: 10px;
            }
            
            .category-floating-name {
                font-size: 0.75rem;
            }
            
            .category-floating-arrow {
                width: 18px;
                height: 18px;
                font-size: 0.65rem;
            }
            
            .categories-floating-footer {
                padding: 10px 12px;
            }
            
            .view-all-floating {
                font-size: 0.7rem;
                padding: 6px 8px;
            }
            
            .section-header-elegant {
                padding: 40px 0;
                margin-bottom: 50px;
            }
            
            .section-title-elegant {
                font-size: 2rem;
            }
            
            .section-description-elegant {
                font-size: 1rem;
            }
            
            .filter-tabs {
                width: 100%;
                justify-content: center;
            }
            
            .products-section {
                padding: 60px 0;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
                padding: 0 10px;
            }
            
            .product-card {
                border-radius: 10px;
            }
            
            .product-image {
                height: 180px;
            }
            
            .product-info {
                padding: 16px;
            }
            
            .product-name a {
                font-size: 1rem;
                line-height: 1.3;
            }
            
            .current-price {
                font-size: 1.1rem;
            }
            
            .btn-add-cart {
                padding: 10px 12px;
                font-size: 0.8rem;
            }
            
            .modern-header {
                min-height: 500px;
                display: block;
            }
            
            .header-content {
                padding: 60px 15px 30px;
                text-align: center;
            }
            
            .content-wrapper {
                max-width: 100%;
            }
            
            .design-title h1 {
                font-size: 1.8rem;
            }
            
            .featured-product {
                padding: 60px 15px 30px;
            }
            
            .product-carousel {
                height: 350px;
            }
        }

        @media (max-width: 576px) {
            .category-sidebar-modern {
                padding: 10px;
            }
            
            .categories-floating-panel {
                border-radius: 12px;
            }
            
            .categories-floating-header {
                padding: 10px;
            }
            
            .grid-dots {
                grid-template-columns: repeat(3, 4px);
                grid-template-rows: repeat(3, 4px);
                gap: 2px;
            }
            
            .dot {
                width: 4px;
                height: 4px;
            }
            
            .category-floating-item {
                padding: 8px 10px;
            }
            
            .category-floating-icon {
                width: 18px;
                height: 18px;
                font-size: 0.7rem;
                margin-right: 8px;
            }
            
            .category-floating-name {
                font-size: 0.7rem;
            }
            
            .category-floating-arrow {
                width: 16px;
                height: 16px;
                font-size: 0.6rem;
            }
            
            .categories-floating-footer {
                padding: 8px 10px;
            }
            
            .view-all-floating {
                font-size: 0.65rem;
                padding: 5px 6px;
                gap: 6px;
            }
            
            .mini-grid-dots {
                grid-template-columns: repeat(2, 3px);
                grid-template-rows: repeat(2, 3px);
                gap: 1px;
            }
            
            .mini-dot {
                width: 3px;
                height: 3px;
            }
            
            .section-header-elegant {
                padding: 30px 0;
                margin-bottom: 40px;
            }
            
            .section-title-elegant {
                font-size: 1.75rem;
            }
            
            .section-tag {
                padding: 6px 15px;
                gap: 8px;
            }
            
            .tag-text {
                font-size: 0.8rem;
            }
            
            .divider-icon {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
            
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                padding: 0 5px;
            }

            .product-card {
                border-radius: 8px;
            }
            
            .product-image {
                height: 160px;
            }
            
            .product-info {
                padding: 12px;
            }
            
            .product-name a {
                font-size: 0.9rem;
                line-height: 1.2;
            }
            
            .current-price {
                font-size: 1rem;
            }
            
            .btn-add-cart {
                padding: 8px 10px;
                font-size: 0.75rem;
                gap: 4px;
            }
            
            .brand-badge {
                top: 8px;
                left: 8px;
                padding: 4px 6px;
            }
            
            .brand-badge img {
                width: 20px;
                height: 20px;
            }
            
            .featured-badge,
            .fresh-badge,
            .bestseller-badge,
            .sale-badge {
                top: 8px;
                right: 8px;
                padding: 4px 8px;
                font-size: 0.65rem;
            }
            
            .action-btn {
                width: 36px;
                height: 36px;
            }
            
            .modern-header {
                min-height: 400px;
            }
            
            .header-content {
                padding: 40px 10px 20px;
            }
            
            .design-title h1 {
                font-size: 1.5rem;
                margin-bottom: 15px;
            }
            
            .design-tagline {
                font-size: 0.8rem;
                margin-bottom: 15px;
            }
            
            .design-description {
                font-size: 0.9rem;
            }
            
            .btn-explore {
                padding: 10px 20px;
                font-size: 0.8rem;
            }
            
            .featured-product {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                padding: 0;
            }
            
            .product-card {
                border-radius: 6px;
            }
            
            .product-image {
                height: 140px;
            }
            
            .product-info {
                padding: 10px;
            }
            
            .product-name a {
                font-size: 0.85rem;
            }
            
            .current-price {
                font-size: 0.95rem;
            }
            
            .btn-add-cart {
                padding: 6px 8px;
                font-size: 0.7rem;
            }
        }

        /* ===== DARK MODE SUPPORT ===== */
        @media (prefers-color-scheme: dark) {
            .categories-floating-panel {
                background: rgba(0, 0, 0, 0.9);
                border: 2px solid rgba(255, 255, 255, 0.2);
            }
            
            .category-floating-name {
                color: #f1f5f9;
            }
            
            .category-floating-icon {
                color: #94a3b8;
                background: rgba(0, 0, 0, 0.3);
                border-color: rgba(255, 255, 255, 0.2);
            }
            
            .categories-floating-footer {
                background: rgba(0, 0, 0, 0.4);
                border-top: 1px solid rgba(255, 255, 255, 0.15);
            }
            
            .view-all-floating {
                color: rgba(255, 255, 255, 0.8);
                background: rgba(0, 0, 0, 0.3);
                border-color: rgba(255, 255, 255, 0.2);
            }
        }

        /* ===== ACCESSIBILITY IMPROVEMENTS ===== */
        .category-floating-item:focus-within {
            outline: 2px solid var(--pink-accent);
            outline-offset: -2px;
            border-radius: 8px;
        }

        .category-floating-link:focus {
            outline: none;
        }

        .view-all-floating:focus {
            outline: 2px solid var(--pink-accent);
            outline-offset: 2px;
        }

        /* ===== REDUCED MOTION ===== */
        @media (prefers-reduced-motion: reduce) {
            .category-floating-item,
            .category-floating-icon,
            .category-floating-name,
            .category-floating-arrow,
            .view-all-floating,
            .view-all-floating-arrow,
            .dot,
            .mini-dot {
                transition: none !important;
                animation: none !important;
            }
            
            .categories-floating-panel::before {
                animation: none !important;
            }
        }

        /* ===== PRINT STYLES ===== */
        @media print {
            .category-sidebar-modern {
                display: none;
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== FLOATING PANEL SPECIAL EFFECTS ===== */
        .categories-floating-panel {
            position: relative;
            overflow: hidden;
        }

        .categories-floating-panel::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.1) 0%,
                rgba(255, 255, 255, 0.05) 50%,
                transparent 100%
            );
            pointer-events: none;
            z-index: 0;
        }

        .categories-floating-list,
        .categories-floating-header,
        .categories-floating-footer {
            position: relative;
            z-index: 1;
        }

        /* ===== ENHANCED FLOATING ANIMATIONS ===== */
        @keyframes floatingGlow {
            0%, 100% { 
                box-shadow: 
                    0 20px 40px rgba(0, 0, 0, 0.1),
                    0 10px 20px rgba(255, 255, 255, 0.1) inset;
            }
            50% { 
                box-shadow: 
                    0 25px 50px rgba(0, 0, 0, 0.15),
                    0 15px 30px rgba(255, 255, 255, 0.15) inset,
                    0 0 20px rgba(233, 30, 99, 0.1);
            }
        }

        .categories-floating-panel:hover {
            animation: floatingGlow 2s ease-in-out infinite;
        }

        /* ===== CATEGORY ITEM LOADING STATE ===== */
        .category-floating-loading {
            position: relative;
            pointer-events: none;
        }

        .category-floating-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent 0%,
                rgba(233, 30, 99, 0.1) 50%,
                transparent 100%
            );
            animation: floatingShine 1s ease-in-out infinite;
        }
    </style>

    <!-- MODERN FLOATING DESIGN JAVASCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Preloader
            window.addEventListener('load', function() {
                setTimeout(function() {
                    const preloader = document.getElementById('preloader');
                    if (preloader) {
                        preloader.style.opacity = '0';
                        setTimeout(() => preloader.remove(), 300);
                    }
                }, 500);
            });

            // Initialize all components
            initSliderContent();
            initProductCarousel();
            initElegantSectionHeaders();
            initFloatingCategories();
            initFilterTabs();
            initScrollAnimations();
            initWishlistHandlers();
            initPerformanceOptimizations();

            // Modern Floating Categories Initialization
            function initFloatingCategories() {
                const categoryItems = document.querySelectorAll('.category-floating-item');
                const floatingPanel = document.querySelector('.categories-floating-panel');
                
                // Add magical entrance animation
                if (floatingPanel) {
                    floatingPanel.style.opacity = '0';
                    floatingPanel.style.transform = 'translateY(30px) scale(0.9)';
                    
                    setTimeout(() => {
                        floatingPanel.style.transition = 'all 1s cubic-bezier(0.4, 0, 0.2, 1)';
                        floatingPanel.style.opacity = '1';
                        floatingPanel.style.transform = 'translateY(0) scale(1)';
                    }, 300);
                }
                
                // Enhanced category interactions with floating effects
                categoryItems.forEach((item, index) => {
                    // Add staggered floating entrance animation
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(-20px)';
                    
                    setTimeout(() => {
                        item.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                        item.style.opacity = '1';
                        item.style.transform = 'translateX(0)';
                    }, 500 + (index * 80));
                    
                    // Get the category link
                    const categoryLink = item.querySelector('.category-floating-link');
                    
                    // Enhanced click handling with floating animation
                    item.addEventListener('click', function(e) {
                        // If the click is directly on the link, let the default behavior work
                        if (e.target.closest('.category-floating-link')) {
                            return;
                        }
                        
                        // Otherwise, handle the click ourselves
                        e.preventDefault();
                        
                        // Remove active class from all items
                        categoryItems.forEach(cat => cat.classList.remove('active'));
                        
                        // Add active class to clicked item
                        this.classList.add('active');
                        
                        // Create floating ripple effect
                        createFloatingRipple(this);
                        
                        // Add floating loading state
                        addFloatingLoadingState(this);
                        
                        // Store selected category
                        sessionStorage.setItem('selectedCategory', this.dataset.category);
                        
                        // Analytics tracking
                        trackCategorySelection(this);
                        
                        // Navigate to the category page with floating transition
                        if (categoryLink && categoryLink.href) {
                            setTimeout(() => {
                                window.location.href = categoryLink.href;
                            }, 400);
                        }
                    });
                    
                    // Enhanced floating hover effects
                    item.addEventListener('mouseenter', function() {
                        if (!this.classList.contains('active')) {
                            this.style.background = 'rgba(255, 255, 255, 0.1)';
                            this.style.backdropFilter = 'blur(10px)';
                        }
                        
                        // Animate icon with floating effect
                        const icon = this.querySelector('.category-floating-icon');
                        if (icon) {
                            icon.style.color = 'white';
                            icon.style.background = 'var(--pink-accent)';
                            icon.style.borderColor = 'var(--pink-accent)';
                            icon.style.transform = 'scale(1.1) rotate(5deg)';
                            icon.style.boxShadow = '0 4px 15px rgba(233, 30, 99, 0.4)';
                        }
                        
                        // Animate arrow with floating motion
                        const arrow = this.querySelector('.category-floating-arrow');
                        if (arrow) {
                            arrow.style.transform = 'translateX(3px) scale(1.1)';
                            arrow.style.color = 'white';
                            arrow.style.background = 'rgba(255, 255, 255, 0.15)';
                        }
                        
                        // Animate text with floating glow
                        const name = this.querySelector('.category-floating-name');
                        if (name) {
                            name.style.color = 'white';
                            name.style.textShadow = '0 2px 10px rgba(233, 30, 99, 0.3)';
                        }
                        
                        // Add floating animation to the entire item
                        this.style.transform = 'translateY(-2px)';
                    });
                    
                    item.addEventListener('mouseleave', function() {
                        if (!this.classList.contains('active')) {
                            this.style.background = 'transparent';
                            this.style.backdropFilter = '';
                        }
                        
                        const icon = this.querySelector('.category-floating-icon');
                        if (icon && !this.classList.contains('active')) {
                            icon.style.color = 'rgba(255, 255, 255, 0.8)';
                            icon.style.background = 'rgba(255, 255, 255, 0.1)';
                            icon.style.borderColor = 'rgba(255, 255, 255, 0.15)';
                            icon.style.transform = 'scale(1) rotate(0deg)';
                            icon.style.boxShadow = 'none';
                        }
                        
                        const arrow = this.querySelector('.category-floating-arrow');
                        if (arrow) {
                            arrow.style.transform = 'translateX(0) scale(1)';
                            arrow.style.color = 'rgba(255, 255, 255, 0.5)';
                            arrow.style.background = 'rgba(255, 255, 255, 0.05)';
                        }
                        
                        const name = this.querySelector('.category-floating-name');
                        if (name && !this.classList.contains('active')) {
                            name.style.color = 'rgba(255, 255, 255, 0.9)';
                            name.style.textShadow = 'none';
                        }
                        
                        this.style.transform = 'translateY(0)';
                    });
                    
                    // Keyboard navigation with floating effects
                    item.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            
                            // Add floating click effect
                            this.style.transform = 'scale(0.98) translateY(1px)';
                            setTimeout(() => {
                                this.style.transform = '';
                                
                                // Navigate to category page
                                if (categoryLink && categoryLink.href) {
                                    window.location.href = categoryLink.href;
                                }
                            }, 200);
                        } else if (e.key === 'ArrowDown') {
                            e.preventDefault();
                            const nextItem = this.nextElementSibling;
                            if (nextItem) {
                                nextItem.focus();
                                nextItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                            }
                        } else if (e.key === 'ArrowUp') {
                            e.preventDefault();
                            const prevItem = this.previousElementSibling;
                            if (prevItem) {
                                prevItem.focus();
                                prevItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                            }
                        }
                    });
                    
                    // Make items focusable for accessibility
                    item.setAttribute('tabindex', '0');
                    item.setAttribute('role', 'button');
                    item.setAttribute('aria-label', 
                        `Select ${item.querySelector('.category-floating-name').textContent} category`);
                });
                
                // Restore selected category with floating styling
                restoreSelectedCategory();
                
                // Initialize floating view all button
                initViewAllButtonFloating();
                
                // Add floating scroll animations
                initFloatingScrollAnimations();
                
                // Initialize dot animations
                initDotAnimations();
            }
            
            // Create floating ripple effect
            function createFloatingRipple(element) {
                const ripple = document.createElement('div');
                
                ripple.style.cssText = `
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(90deg, 
                        transparent 0%, 
                        rgba(233, 30, 99, 0.3) 30%,
                        rgba(255, 255, 255, 0.2) 50%,
                        rgba(233, 30, 99, 0.3) 70%,
                        transparent 100%);
                    transform: translateX(-100%);
                    animation: floatingRipple 0.8s ease;
                    pointer-events: none;
                    z-index: 1;
                    border-radius: 8px;
                `;
                
                // Add floating ripple animation keyframes
                if (!document.querySelector('#floating-ripple-styles')) {
                    const style = document.createElement('style');
                    style.id = 'floating-ripple-styles';
                    style.textContent = `
                        @keyframes floatingRipple {
                            0% {
                                transform: translateX(-100%);
                                opacity: 0;
                            }
                            30% {
                                opacity: 1;
                            }
                            70% {
                                opacity: 1;
                            }
                            100% {
                                transform: translateX(100%);
                                opacity: 0;
                            }
                        }
                    `;
                    document.head.appendChild(style);
                }
                
                element.style.position = 'relative';
                element.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 800);
            }
            
            // Add floating loading state
            function addFloatingLoadingState(element) {
                const arrow = element.querySelector('.category-floating-arrow i');
                const icon = element.querySelector('.category-floating-icon');
                
                if (arrow) {
                    const originalClass = arrow.className;
                    arrow.className = 'fas fa-circle-notch fa-spin';
                    arrow.style.color = 'var(--pink-accent)';
                    
                    setTimeout(() => {
                        arrow.className = originalClass;
                        arrow.style.color = '';
                    }, 1000);
                }
                
                if (icon) {
                    icon.style.animation = 'pulse 0.8s ease infinite';
                    setTimeout(() => {
                        icon.style.animation = '';
                    }, 1000);
                }
                
                // Add floating loading class
                element.classList.add('category-floating-loading');
                setTimeout(() => {
                    element.classList.remove('category-floating-loading');
                }, 1000);
            }
            
            // Restore selected category with floating styling
            function restoreSelectedCategory() {
                const selectedCategory = sessionStorage.getItem('selectedCategory');
                if (selectedCategory) {
                    const categoryItem = document.querySelector(`[data-category="${selectedCategory}"]`);
                    if (categoryItem) {
                        categoryItem.classList.add('active');
                        
                        // Add floating visual feedback
                        categoryItem.style.background = 'rgba(255, 255, 255, 0.15)';
                        categoryItem.style.backdropFilter = 'blur(15px)';
                        
                        const icon = categoryItem.querySelector('.category-floating-icon');
                        if (icon) {
                            icon.style.color = 'white';
                            icon.style.background = 'var(--pink-accent)';
                            icon.style.borderColor = 'var(--pink-accent)';
                        }
                        
                        const name = categoryItem.querySelector('.category-floating-name');
                        if (name) {
                            name.style.color = 'white';
                        }
                    }
                }
            }
            
            // Initialize floating view all button
            function initViewAllButtonFloating() {
                const viewAllBtn = document.querySelector('.view-all-floating');
                if (viewAllBtn) {
                    viewAllBtn.addEventListener('click', function(e) {
                        // Add floating click animation
                        this.style.transform = 'scale(0.95) translateY(2px)';
                        
                        // Add enhanced floating loading state
                        const originalHTML = this.innerHTML;
                        const loadingHTML = `
                            <div class="view-all-floating-icon">
                                <div class="mini-grid-dots">
                                    <span class="mini-dot"></span>
                                    <span class="mini-dot"></span>
                                    <span class="mini-dot"></span>
                                    <span class="mini-dot"></span>
                                </div>
                            </div>
                            <span class="view-all-floating-text">Loading...</span>
                            <div class="view-all-floating-arrow">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </div>
                        `;
                        
                        this.innerHTML = loadingHTML;
                        this.style.color = 'var(--pink-accent)';
                        
                        setTimeout(() => {
                            this.style.transform = '';
                            this.innerHTML = originalHTML;
                            this.style.color = '';
                        }, 1200);
                    });
                    
                    // Add enhanced floating hover animation
                    viewAllBtn.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-2px)';
                        
                        const arrow = this.querySelector('.view-all-floating-arrow');
                        if (arrow) {
                            arrow.style.transform = 'translateX(3px)';
                        }
                        
                        const dots = this.querySelectorAll('.mini-dot');
                        dots.forEach((dot, index) => {
                            setTimeout(() => {
                                dot.style.transform = 'scale(1.2)';
                                dot.style.background = 'white';
                            }, index * 100);
                        });
                    });
                    
                    viewAllBtn.addEventListener('mouseleave', function() {
                        this.style.transform = '';
                        
                        const arrow = this.querySelector('.view-all-floating-arrow');
                        if (arrow) {
                            arrow.style.transform = 'translateX(0)';
                        }
                        
                        const dots = this.querySelectorAll('.mini-dot');
                        dots.forEach(dot => {
                            dot.style.transform = 'scale(1)';
                            dot.style.background = 'rgba(255, 255, 255, 0.7)';
                        });
                    });
                }
            }
            
            // Initialize floating scroll animations
            function initFloatingScrollAnimations() {
                const floatingPanel = document.querySelector('.categories-floating-panel');
                if (!floatingPanel) return;
                
                let lastScrollY = window.scrollY;
                
                window.addEventListener('scroll', () => {
                    const currentScrollY = window.scrollY;
                    const scrollDiff = currentScrollY - lastScrollY;
                    
                    if (currentScrollY > 100) {
                        floatingPanel.style.transform = `translateY(-${Math.min(scrollDiff * 0.05, 2)}px) scale(1.02)`;
                        floatingPanel.style.boxShadow = `
                            0 30px 60px rgba(0, 0, 0, 0.15),
                            0 15px 30px rgba(255, 255, 255, 0.15) inset,
                            0 0 30px rgba(233, 30, 99, 0.1)
                        `;
                    } else {
                        floatingPanel.style.transform = 'translateY(0) scale(1)';
                        floatingPanel.style.boxShadow = `
                            0 20px 40px rgba(0, 0, 0, 0.1),
                            0 10px 20px rgba(255, 255, 255, 0.1) inset
                        `;
                    }
                    
                    lastScrollY = currentScrollY;
                }, { passive: true });
            }
            
            // Initialize dot animations
            function initDotAnimations() {
                const dots = document.querySelectorAll('.dot');
                const floatingPanel = document.querySelector('.categories-floating-panel');
                
                if (floatingPanel) {
                    floatingPanel.addEventListener('mouseenter', () => {
                        dots.forEach((dot, index) => {
                            setTimeout(() => {
                                dot.style.background = 'white';
                                dot.style.transform = 'scale(1.2)';
                                dot.style.boxShadow = '0 2px 8px rgba(233, 30, 99, 0.3)';
                            }, index * 50);
                        });
                    });
                    
                    floatingPanel.addEventListener('mouseleave', () => {
                        dots.forEach(dot => {
                            dot.style.background = 'rgba(255, 255, 255, 0.9)';
                            dot.style.transform = 'scale(1)';
                            dot.style.boxShadow = 'none';
                        });
                    });
                }
            }
            
            // Track category selection for analytics
            function trackCategorySelection(categoryItem) {
                const categoryName = categoryItem.querySelector('.category-floating-name').textContent;
                const categoryId = categoryItem.dataset.category;
                
                // Google Analytics tracking
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'category_selected', {
                        event_category: 'navigation',
                        event_label: categoryName,
                        value: categoryId
                    });
                }
                
                // Custom analytics
                if (typeof analytics !== 'undefined') {
                    analytics.track('Category Selected', {
                        categoryName: categoryName,
                        categoryId: categoryId,
                        timestamp: new Date().toISOString()
                    });
                }
                
                // Console log for development
                console.log(`Category selected: ${categoryName} (ID: ${categoryId})`);
            }

            // Filter Tab Functionality
            function initFilterTabs() {
                const filterTabs = document.querySelectorAll('.tab-btn');
                const productCards = document.querySelectorAll('.product-card');

                filterTabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        filterTabs.forEach(t => t.classList.remove('active'));
                        this.classList.add('active');

                        const filter = this.dataset.filter;

                        productCards.forEach((card, index) => {
                            if (filter === 'all' || card.dataset.category.includes(filter)) {
                                card.style.display = 'block';
                                setTimeout(() => {
                                    card.style.animation = 'fadeInUp 0.5s ease forwards';
                                }, index * 50);
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });
                });
            }

            // Elegant Section Headers Animation
            function initElegantSectionHeaders() {
                const sectionHeaders = document.querySelectorAll('.section-header-elegant');
                
                const observerOptions = {
                    threshold: 0.3,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const header = entry.target;
                            
                            const tag = header.querySelector('.section-tag');
                            if (tag) {
                                setTimeout(() => {
                                    tag.style.animation = 'fadeInUp 0.6s ease forwards';
                                }, 200);
                            }
                            
                            const title = header.querySelector('.section-title-elegant');
                            if (title) {
                                setTimeout(() => {
                                    title.style.animation = 'fadeInUp 0.8s ease forwards';
                                }, 400);
                            }
                            
                            const divider = header.querySelector('.section-divider');
                            if (divider) {
                                setTimeout(() => {
                                    divider.style.animation = 'fadeInUp 0.6s ease forwards';
                                }, 600);
                            }
                            
                            const description = header.querySelector('.section-description-elegant');
                            if (description) {
                                setTimeout(() => {
                                    description.style.animation = 'fadeInUp 0.8s ease forwards';
                                }, 800);
                            }
                            
                            const actions = header.querySelector('.header-actions-elegant');
                            if (actions) {
                                setTimeout(() => {
                                    actions.style.animation = 'fadeInUp 0.8s ease forwards';
                                }, 1000);
                            }
                            
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                sectionHeaders.forEach(header => {
                    observer.observe(header);
                });
            }

            // Scroll Animations
            function initScrollAnimations() {
                const animateElements = document.querySelectorAll('.product-card');
                
                animateElements.forEach(element => {
                    element.classList.add('animate-on-scroll');
                });

                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animated');
                        }
                    });
                }, observerOptions);

                animateElements.forEach(element => {
                    observer.observe(element);
                });
            }

            // Wishlist Handlers
            function initWishlistHandlers() {
                const wishlistButtons = document.querySelectorAll('.wishlist-btn');
                
                wishlistButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        const icon = this.querySelector('i');
                        const isActive = this.classList.contains('active');
                        
                        if (isActive) {
                            this.classList.remove('active');
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                            this.setAttribute('title', 'Add to Wishlist');
                            
                            showToast('Removed from wishlist', 'info');
                        } else {
                            this.classList.add('active');
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                            this.setAttribute('title', 'Remove from Wishlist');
                            
                            showToast('Added to wishlist', 'success');
                        }
                        
                        // Add heart animation
                        icon.style.animation = 'pulse 0.3s ease';
                        setTimeout(() => {
                            icon.style.animation = '';
                        }, 300);
                    });
                });
            }

            // Performance Optimizations
            function initPerformanceOptimizations() {
                // Lazy load images
                const images = document.querySelectorAll('img[data-src]');
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    });
                });

                images.forEach(img => imageObserver.observe(img));

                // Debounce scroll events
                let scrollTimeout;
                window.addEventListener('scroll', () => {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        handleScrollAnimations();
                    }, 16); // ~60fps
                });

                // Throttle resize events
                let resizeTimeout;
                window.addEventListener('resize', () => {
                    clearTimeout(resizeTimeout);
                    resizeTimeout = setTimeout(() => {
                        handleResponsiveChanges();
                    }, 250);
                });
            }

            // Handle scroll-based animations
            function handleScrollAnimations() {
                // Additional scroll-based effects can be added here
            }

            // Handle responsive changes
            function handleResponsiveChanges() {
                const floatingPanel = document.querySelector('.categories-floating-panel');
                const sidebar = document.querySelector('.category-sidebar-modern');
                
                if (window.innerWidth <= 768) {
                    if (sidebar) sidebar.style.padding = '15px';
                    if (floatingPanel) floatingPanel.style.borderRadius = '15px';
                } else if (window.innerWidth <= 991) {
                    if (sidebar) sidebar.style.padding = '20px';
                    if (floatingPanel) floatingPanel.style.borderRadius = '20px';
                } else {
                    if (sidebar) sidebar.style.padding = '0 10px';
                    if (floatingPanel) floatingPanel.style.borderRadius = '20px';
                }
            }

            // Enhanced toast notifications
            function showToast(message, type = 'info') {
                const toast = document.createElement('div');
                const colors = {
                    success: '#10b981',
                    error: '#ef4444', 
                    warning: '#f59e0b',
                    info: '#3b82f6'
                };
                
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${colors[type]};
                    color: white;
                    padding: 12px 20px;
                    border-radius: 12px;
                    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
                    backdrop-filter: blur(20px);
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    z-index: 10000;
                    transform: translateX(100%);
                    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    font-size: 0.875rem;
                    font-weight: 500;
                    max-width: 300px;
                `;
                toast.textContent = message;
                
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.style.transform = 'translateX(0)';
                }, 100);
                
                setTimeout(() => {
                    toast.style.transform = 'translateX(100%)';
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            // Product card interactions
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Visibility change handling
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    // Pause animations when page is hidden
                    const animatedElements = document.querySelectorAll('[style*="animation"]');
                    animatedElements.forEach(el => {
                        if (el.style.animationPlayState !== undefined) {
                            el.style.animationPlayState = 'paused';
                        }
                    });
                } else {
                    // Resume animations when page is visible
                    const animatedElements = document.querySelectorAll('[style*="animation"]');
                    animatedElements.forEach(el => {
                        if (el.style.animationPlayState !== undefined) {
                            el.style.animationPlayState = 'running';
                        }
                    });
                }
            });

            // Error handling
            window.addEventListener('error', function(e) {
                if (window.location.hostname === 'localhost' || window.location.hostname.includes('dev')) {
                    console.error('Development Error:', e.message);
                }
            });
        });

        // Add to Cart Function
        function addToCart(button) {
            const originalText = button.innerHTML;
            button.classList.add('btn-loading');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            button.disabled = true;
            
            button.style.transform = 'scale(0.98)';
            
            setTimeout(() => {
                button.classList.remove('btn-loading');
                button.innerHTML = '<i class="fas fa-check"></i> Added!';
                button.style.background = '#10b981';
                button.style.transform = 'scale(1.05)';
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    button.style.background = '';
                    button.style.transform = '';
                }, 2000);
            }, 1000);
        }
        
        // Slider Content Function
        function initSliderContent() {
            const sliders = @json($sliders ?? []);
            
            if (!sliders || sliders.length === 0) {
                updateSliderContent({
                    title: 'COMPUTER AND LAPTOPS',
                    subtitle: 'PRESENTING SMART SOLUTIONS',
                    description: 'Welcome our latest innovation! We are proud to introduce the latest products designed to meet your needs better.',
                    button_text: 'MORE',
                    button_url: '#',
                    image_url: 'assets/img/default-bg.jpg'
                }, true);
                return;
            }
            
            updateSliderContent(sliders[0], true);
            
            if (sliders.length > 1) {
                let currentIndex = 0;
                setInterval(() => {
                    currentIndex = (currentIndex + 1) % sliders.length;
                    updateSliderContent(sliders[currentIndex], false);
                }, 5000);
            }
        }
        
        function updateSliderContent(slider, isInitial) {
            const contentWrapper = document.getElementById('sliderContent');
            const bgElement = document.getElementById('backgroundSlider');
            
            if (!contentWrapper || !bgElement) return;
            
            const assetPath = "{{ asset('') }}";
            const newImageUrl = `${assetPath}${slider.image_url}`;
            
            const newContent = document.createElement('div');
            newContent.className = 'content-wrapper slide-transition';
            newContent.style.opacity = '0';
            newContent.style.transition = 'opacity 0.8s ease';
            newContent.innerHTML = `
                <div class="design-tagline" style="animation: slideInLeft 1s ease 0.2s both;">${slider.subtitle || ''}</div>
                <div class="design-title" style="animation: slideInLeft 1s ease 0.4s both;">
                    <h1>${slider.title || 'TITLE HERE'}</h1>
                </div>
                <div class="design-description" style="animation: slideInLeft 1s ease 0.6s both;">
                    <p>${slider.description || ''}</p>
                </div>
                <div class="explore-btn" style="animation: slideInLeft 1s ease 0.8s both;">
                    <a href="${slider.button_url || '#'}" class="btn-explore">
                        ${slider.button_text || 'MORE'}
                    </a>
                </div>
            `;
            
            if (isInitial) {
                if (bgElement) {
                    bgElement.style.backgroundImage = `url('${newImageUrl}')`;
                }
                contentWrapper.innerHTML = '';
                contentWrapper.appendChild(newContent);
                setTimeout(() => newContent.style.opacity = '1', 100);
            } else {
                contentWrapper.style.opacity = '0.7';
                setTimeout(() => {
                    if (bgElement) {
                        bgElement.style.backgroundImage = `url('${newImageUrl}')`;
                    }
                    contentWrapper.innerHTML = '';
                    contentWrapper.appendChild(newContent);
                    newContent.style.opacity = '1';
                    contentWrapper.style.opacity = '1';
                }, 300);
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
                
                items.forEach((item, i) => {
                    item.classList.remove('active');
                    if (i === index) {
                        setTimeout(() => {
                            item.classList.add('active');
                            item.style.animation = 'slideInRight 0.6s ease forwards';
                        }, 100);
                    }
                });
                
                if (indicators && indicators.length) {
                    indicators.forEach(ind => ind.classList.remove('active'));
                    if (indicators[index]) {
                        indicators[index].classList.add('active');
                    }
                }
                
                currentIndex = index;
                
                clearInterval(timer);
                timer = setInterval(autoAdvance, 6000);
            }
            
            function autoAdvance() {
                showSlide(currentIndex + 1);
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    showSlide(currentIndex - 1);
                    prevBtn.style.transform = 'scale(0.9)';
                    setTimeout(() => prevBtn.style.transform = '', 150);
                });
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    showSlide(currentIndex + 1);
                    nextBtn.style.transform = 'scale(0.9)';
                    setTimeout(() => nextBtn.style.transform = '', 150);
                });
            }
            
            if (indicators && indicators.length) {
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        showSlide(index);
                    });
                });
            }
            
            // Touch/Swipe Support
            carousel.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            
            carousel.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });
            
            function handleSwipe() {
                const swipeThreshold = 50;
                if (touchStartX - touchEndX > swipeThreshold) {
                    showSlide(currentIndex + 1);
                } else if (touchEndX - touchStartX > swipeThreshold) {
                    showSlide(currentIndex - 1);
                }
            }
            
            timer = setInterval(autoAdvance, 6000);
            showSlide(0);
            
            carousel.addEventListener('mouseenter', function() {
                clearInterval(timer);
            });
            
            carousel.addEventListener('mouseleave', function() {
                timer = setInterval(autoAdvance, 6000);
            });
            
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    clearInterval(timer);
                } else {
                    timer = setInterval(autoAdvance, 6000);
                }
            });
        }
    </script>
@endsection