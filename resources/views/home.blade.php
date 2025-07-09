@extends('layouts.Member.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
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
                    <div id="sliderContent" class="content-wrapper" data-sliders="{{ json_encode($sliders ?? []) }}">
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

    <!-- Add the asset path data attribute to the body -->
    <script>
        document.body.dataset.assetPath = "{{ asset('') }}";
    </script>
    
    <!-- Include the external JavaScript file -->
    <script src="{{ asset('assets/js/home.js') }}"></script>
@endsection