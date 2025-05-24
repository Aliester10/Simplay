@extends('layouts.Member.master-black')

@section('content')
<!-- Breadcrumb -->
<div class="container breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>
</div>

<div class="container main-container">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="filters-container">
                <div class="filters-header">
                    <h5><i class="fas fa-sliders-h me-2"></i>Filters</h5>
                    <a href="{{ route('product.index') }}" class="btn-reset d-none d-lg-block">Reset</a>
                    
                    <!-- Mobile Filter Toggle -->
                    <button class="filter-toggle d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterContent">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                
                <div id="filterContent" class="collapse d-lg-block">
                    <div class="filter-section">
                        <h6 class="filter-title">Categories</h6>
                        <div class="category-list">
                            @foreach ($kategori as $kat)
                                @php
                                    // Fixed: Count products without using 'active' column
                                    $productCount = DB::table('produk')
                                        ->where('kategori_id', $kat->id)
                                        ->count();
                                @endphp
                                <div class="filter-item">
                                    <a href="{{ route('filterByCategory', $kat->id) }}" class="category-link {{ request()->route('id') == $kat->id ? 'active' : '' }}">
                                        <span>{{ $kat->nama }}</span>
                                        <span class="category-count">{{ $productCount }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Products Header -->
            <div class="products-header">
                <div class="product-count">
                    <h4>Products <span class="count-badge">{{ $produks->total() }}</span></h4>
                    <p class="text-muted">
                        Showing {{ ($produks->currentPage() - 1) * $produks->perPage() + 1 }}-{{ min($produks->currentPage() * $produks->perPage(), $produks->total()) }} of {{ $produks->total() }} Products
                    </p>
                </div>
                
                <div class="products-actions">
                    <!-- View Toggle -->
                    <div class="view-options">
                        <button class="btn-view active" data-view="grid">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="btn-view" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                    
                    <!-- Sort Dropdown -->
                    <div class="sort-wrapper">
                        <label for="sortOptions">Sort by:</label>
                        <select class="form-select" id="sortOptions">
                            <option selected>Most Popular</option>
                            <option value="1">{{ __('messages.newest') }}</option>
                            <option value="2">{{ __('messages.latest') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row product-grid g-4">
                @foreach ($produks as $produk)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ route('product.show', $produk->id) }}">
                                <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                    class="img-fluid" alt="{{ $produk->nama }}">
                            </a>
                            <div class="product-actions">
                                <a href="{{ route('product.show', $produk->id) }}" class="btn-product-action" title="View details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn-product-action" title="Add to wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                                <button class="btn-product-action" title="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-brand">{{ $produk->merk }}</div>
                            @php
                                $name = $produk->nama;
                                $limitedName = strlen($name) > 22 ? substr($name, 0, 22) . '..' : $name;
                            @endphp
                            <h6 class="product-title">
                                <a href="{{ route('product.show', $produk->id) }}">{{ $limitedName }}</a>
                            </h6>
                            <!-- Menampilkan harga produk -->
                            <div class="product-price">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-controls">
                    @if ($produks->onFirstPage())
                        <span class="pagination-button disabled">
                            <i class="fas fa-chevron-left me-1"></i> Previous
                        </span>
                    @else
                        <a href="{{ $produks->previousPageUrl() }}" class="pagination-button">
                            <i class="fas fa-chevron-left me-1"></i> Previous
                        </a>
                    @endif

                    <div class="pagination-numbers">
                        @php
                            $totalPages = $produks->lastPage();
                            $currentPage = $produks->currentPage();
                            
                            $startPage = max($currentPage - 2, 1);
                            $endPage = min($startPage + 4, $totalPages);
                            
                            if ($endPage - $startPage < 4 && $totalPages > 5) {
                                $startPage = max($endPage - 4, 1);
                            }
                        @endphp

                        @if ($startPage > 1)
                            <a href="{{ $produks->url(1) }}" class="page-number">1</a>
                            @if ($startPage > 2)
                                <span class="page-ellipsis">...</span>
                            @endif
                        @endif

                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <a href="{{ $produks->url($i) }}" class="page-number {{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                        @endfor

                        @if ($endPage < $totalPages)
                            @if ($endPage < $totalPages - 1)
                                <span class="page-ellipsis">...</span>
                            @endif
                            <a href="{{ $produks->url($totalPages) }}" class="page-number">{{ $totalPages }}</a>
                        @endif
                    </div>

                    @if ($produks->hasMorePages())
                        <a href="{{ $produks->nextPageUrl() }}" class="pagination-button">
                            Next <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    @else
                        <span class="pagination-button disabled">
                            Next <i class="fas fa-chevron-right ms-1"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Inline styles for the enhanced design -->
<style>
/* Base Styles & Variables */
:root {
    --primary-color: #3a3a3a;
    --accent-color: #070528;
    --light-accent: #f5f5f8;
    --border-color: #e9e9e9;
    --text-color: #333;
    --text-light: #767676;
    --bg-light: #f9f9f9;
    --shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
    --radius: 8px;
}

body {
    color: var(--text-color);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    line-height: 1.6;
}

/* Breadcrumb */
.breadcrumb-container {
    background: white;
    padding: 1px 0;
    border-bottom: 1px solid var(--border-color);
    margin-bottom: 1rem;
    margin-top: 5.5rem;
}

.breadcrumb {
    margin: 0;
    padding: 0;
    background: transparent;
}

.breadcrumb-item a {
    color: var(--text-light);
    text-decoration: none;
    transition: var(--transition);
}

.breadcrumb-item a:hover {
    color: var(--accent-color);
}

.breadcrumb-item.active {
    color: var(--text-color);
    font-weight: 500;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: var(--text-light);
}

/* Main Container */
.main-container {
    padding-bottom: 4rem;
}

/* Filters Sidebar */
.filters-container {
    background: white;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 1.5rem;
    margin-bottom: 2rem;
    position: sticky;
    top: 20px;
}

.filters-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border-color);
}

.filters-header h5 {
    font-weight: 600;
    margin: 0;
    font-size: 1.1rem;
}

.btn-reset {
    border: none;
    background: transparent;
    color: var(--text-light);
    font-size: 0.85rem;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
}

.btn-reset:hover {
    color: var(--accent-color);
}

.filter-toggle {
    background: transparent;
    border: none;
    color: var(--text-color);
    cursor: pointer;
}

.filter-section {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
}

.filter-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.filter-title {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--text-color);
}

.category-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-item {
    transition: var(--transition);
}

.category-link {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    color: var(--text-color);
    text-decoration: none;
    transition: var(--transition);
    border-radius: var(--radius);
}

.category-link:hover {
    color: var(--accent-color);
    transform: translateX(5px);
}

.category-link.active {
    color: var(--accent-color);
    font-weight: 500;
}

.category-count {
    background: var(--bg-light);
    padding: 0.1rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    color: var(--text-light);
}

/* Products Header */
.products-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.product-count h4 {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.count-badge {
    background: var(--accent-color);
    color: white;
    font-size: 0.75rem;
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-weight: 500;
}

.products-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.view-options {
    display: flex;
    border: 1px solid var(--border-color);
    border-radius: var(--radius);
    overflow: hidden;
}

.btn-view {
    background: white;
    border: none;
    width: 40px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
}

.btn-view:hover {
    background: var(--bg-light);
}

.btn-view.active {
    background: var(--accent-color);
    color: white;
}

.sort-wrapper {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sort-wrapper label {
    font-size: 0.85rem;
    color: var(--text-light);
    margin-bottom: 0;
}

.form-select {
    border: 1px solid var(--border-color);
    border-radius: var(--radius);
    padding: 0.5rem 2rem 0.5rem 0.75rem;
    font-size: 0.9rem;
    background-position: right 0.5rem center;
    cursor: pointer;
    transition: var(--transition);
}

.form-select:focus {
    border-color: var(--accent-color);
    box-shadow: none;
    outline: none;
}

/* Product Grid */
.product-grid {
    margin-top: 1rem;
}

.product-card {
    background: white;
    border-radius: var(--radius);
    overflow: hidden;
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: var(--shadow);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.product-image {
    position: relative;
    padding-top: 100%;
    background: var(--bg-light);
    overflow: hidden;
}

.product-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: var(--transition);
    padding: 1rem;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-actions {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    flex-direction: column;
    gap: 5px;
    opacity: 0;
    transform: translateX(10px);
    transition: var(--transition);
}

.product-card:hover .product-actions {
    opacity: 1;
    transform: translateX(0);
}

.btn-product-action {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    color: var(--text-color);
    transition: var(--transition);
    text-decoration: none;
}

.btn-product-action:hover {
    background: var(--accent-color);
    color: white;
    transform: translateY(-2px);
}

.product-info {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.product-brand {
    color: var(--text-light);
    font-size: 0.8rem;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-title {
    margin-bottom: 0.5rem;
    font-weight: 600;
    line-height: 1.4;
}

.product-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: var(--transition);
}

.product-title a:hover {
    color: var(--accent-color);
}

/* Style untuk harga produk */
.product-price {
    font-size: 1rem;
    font-weight: 600;
    color: var(--accent-color);
    margin-top: 0.5rem;
}

/* Pagination */
.pagination-container {
    margin-top: 4rem;
    display: flex;
    justify-content: center;
}

.pagination-controls {
    display: flex;
    gap: 1rem;
    align-items: center;
    background: white;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.pagination-button {
    color: var(--text-color);
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: var(--radius);
    font-weight: 500;
    transition: var(--transition);
    font-size: 0.9rem;
}

.pagination-button:hover {
    background: var(--bg-light);
    color: var(--accent-color);
}

.pagination-button.disabled {
    color: var(--text-light);
    cursor: not-allowed;
    pointer-events: none;
}

.pagination-numbers {
    display: flex;
    gap: 0.5rem;
}

.page-number, .page-ellipsis {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    border-radius: var(--radius);
    text-decoration: none;
    color: var(--text-color);
    transition: var(--transition);
    font-size: 0.9rem;
}

.page-number:hover {
    background: var(--bg-light);
    color: var(--accent-color);
}

.page-number.active {
    background: var(--accent-color);
    color: white;
    font-weight: 500;
}

.page-ellipsis {
    color: var(--text-light);
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .filters-container {
        margin-bottom: 2rem;
        position: static;
    }
}

@media (max-width: 767.98px) {
    .products-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .products-actions {
        justify-content: space-between;
    }
    
    .pagination-container {
        margin-top: 3rem;
    }
    
    .pagination-controls {
        flex-wrap: wrap;
        justify-content: center;
    }
}

@media (max-width: 575.98px) {
    .product-grid .col-md-4 {
        width: 50%;
    }
    
    .pagination-numbers {
        display: none;
    }
    
    .filters-header h5 {
        font-size: 1rem;
    }
}

/* List View Styles */
.product-grid.list-view .product-card {
    flex-direction: row;
    height: 180px;
}

.product-grid.list-view .product-image {
    flex: 0 0 180px;
    padding-top: 0;
    height: 100%;
}

.product-grid.list-view .product-info {
    padding: 1.5rem;
    justify-content: center;
}

@media (max-width: 767.98px) {
    .product-grid.list-view .product-card {
        flex-direction: column;
        height: auto;
    }
    
    .product-grid.list-view .product-image {
        flex: none;
        padding-top: 100%;
        height: auto;
    }
}
</style>

<!-- JavaScript for Interactive Features -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const viewButtons = document.querySelectorAll('.btn-view');
    const productGrid = document.querySelector('.product-grid');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.getAttribute('data-view');
            
            // Remove active class from all buttons
            viewButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Toggle grid/list view
            if (view === 'grid') {
                productGrid.classList.remove('list-view');
                document.querySelectorAll('.col-md-4').forEach(col => {
                    col.classList.remove('col-12');
                });
            } else {
                productGrid.classList.add('list-view');
                document.querySelectorAll('.col-md-4').forEach(col => {
                    col.classList.add('col-12');
                });
            }
        });
    });
    
    // Mobile filter toggle
    const filterToggle = document.querySelector('.filter-toggle');
    if (filterToggle) {
        filterToggle.addEventListener('click', function() {
            this.querySelector('i').classList.toggle('fa-chevron-up');
            this.querySelector('i').classList.toggle('fa-chevron-down');
        });
    }
});
</script>