@php
    // Fetch the first record from the compro_parameter table
    $compro = \App\Models\CompanyParameter::first();
    
    // Get active metas
    $activeMetas = \App\Models\Meta::where('start_date', '<=', today())
        ->where('end_date', '>=', today())
        ->get()
        ->groupBy('type');
@endphp

<!-- Top Dark Bar -->
<div class="container-fluid top-dark-bar">
    <div class="container d-flex justify-content-center align-items-center flex-wrap h-100">
        @if(!empty($compro->maps))
            <a href="{{ $compro->maps }}" class="text-light me-md-4 me-2 mb-1 mb-md-0" target="_blank">
                <img src="{{ asset('assets/icons/topbar-icons/location.svg') }}" alt="Location" class="topbar-icon">
                <span>Lokasi Kantor</span>
            </a>
        @endif
        
        @if(!empty($compro->no_telepon))
            <a href="tel:+62{{ $compro->no_telepon }}" class="text-light me-md-4 me-2 mb-1 mb-md-0">
                <img src="{{ asset('assets/icons/topbar-icons/phone-call.svg') }}" alt="Phone" class="topbar-icon">
                <span>{{ $compro->no_telepon }}</span>
            </a>
        @endif
        
        @if(!empty($compro->email))
            <a href="mailto:{{ $compro->email }}" class="text-light mb-1 mb-md-0">
                <img src="{{ asset('assets/icons/topbar-icons/email.svg') }}" alt="Email" class="topbar-icon">
                <span>{{ $compro->email }}</span>
            </a>
        @endif
    </div>
</div>

<!-- Main Navigation Bar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo Section -->
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('assets/img/Logo.png') }}" alt="SIMPLAY Logo" class="img-fluid logo-img">
        </a>
        
        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Main Navigation Links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('activity') }}" class="nav-link {{ request()->routeIs('activity') ? 'active' : '' }}">Activity</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">Products</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Career</a>
                </li>
                
                @foreach ($activeMetas as $type => $metas)
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ ucfirst($type) }}</a>
                        <ul class="dropdown-menu">
                            @foreach ($metas as $meta)
                                <li><a href="{{ route('member.meta.show', $meta->slug) }}" class="dropdown-item">{{ $meta->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                
                @auth
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Portal</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('portal') }}" class="dropdown-item">{{ __('messages.portal_member') }}</a></li>
                            <li><a href="{{ route('distribution') }}" class="dropdown-item">{{ __('messages.portal_distribution') }}</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
            
            <!-- Right Side Icons -->
            <div class="d-flex align-items-center nav-icons">
                <!-- Search Bar -->
                <div class="search-container me-3 d-none d-lg-block">
                    <form action="{{ route('products.search') }}" method="GET">
                        <div class="search-wrapper">
                            <input type="text" class="search-input" name="keyword" placeholder="Search for products..." required>
                            <button class="search-btn" type="submit">
                                <img src="{{ asset('assets/icons/navbar-icons/search-icon.svg') }}" alt="Search" class="search-icon">
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- User Icon -->
                <div class="me-3">
                    @if (auth()->check())
                        <div class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle nav-icon-link" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('assets/icons/navbar-icons/login.svg') }}" alt="User" class="navbar-icon">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu" aria-labelledby="userDropdown">
                                <li class="dropdown-item user-info">
                                    <strong>{{ auth()->user()->nama_perusahaan }}</strong>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ auth()->user()->type == 'member' ? route('profile.show') : (auth()->user()->type == 'distributor' ? route('distributor.profile.show') : '#') }}" id="profileLink">
                                        <i class="fa fa-user-circle me-2"></i> Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt me-2"></i> Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-icon-link">
                            <img src="{{ asset('assets/icons/navbar-icons/login.svg') }}" alt="Login" class="navbar-icon">
                        </a>
                    @endif
                </div>
                
                <!-- Cart Icon -->
                <div>
                    <a href="{{ auth()->check() && auth()->user()->type === 'distributor' ? route('quotations.cart') : '#' }}" class="nav-icon-link">
                        <img src="{{ asset('assets/icons/navbar-icons/cart.svg') }}" alt="Cart" class="navbar-icon">
                        @if(auth()->check() && auth()->user()->type === 'distributor' && session('quotation_cart'))
                            <span class="badge bg-primary rounded-pill position-absolute translate-middle">
                                {{ count(session('quotation_cart')) }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Search - Only shows on mobile when navbar is expanded -->
<div class="container mobile-search d-none">
    <form action="{{ route('products.search') }}" method="GET">
        <div class="search-wrapper w-100">
            <input type="text" class="search-input" name="keyword" placeholder="Search for products..." required>
            <button class="search-btn" type="submit">
                <img src="{{ asset('assets/icons/navbar-icons/search-icon.svg') }}" alt="Search" class="search-icon">
            </button>
        </div>
    </form>
</div>

<!-- Embedded CSS -->
<style>
/* Top dark bar styling */
.top-dark-bar {
    background-color: #1D1E33;
    font-size: 0.85rem;
    position: relative;
    z-index: 1030;
    height: 50px; /* Set fixed height to 50px */
}

.top-dark-bar a {
    text-decoration: none;
    color: #fff;
    transition: all 0.3s ease;
    font-size: 12px;
    display: flex;
    align-items: center;
}

.top-dark-bar a:hover {
    opacity: 0.8;
}

.topbar-icon {
    height: 17px;
    width: auto;
    margin-right: 5px;
    filter: brightness(0) invert(1);
}

/* Main navigation bar styling - Transparent */
.navbar {
    background-color: transparent;
    padding: 1rem 0;
    z-index: 1020;
    position: absolute;
    width: 100%;
    top: 50px; /* Updated to match top bar height */
}

.navbar-brand img.logo-img {
    height: 34px;
    width: auto;
}

/* Navigation links */
.navbar .nav-link {
    color: #fff;
    font-weight: 500;
    padding: 0.5rem 1rem;
    margin-right: 0.5rem;
    position: relative;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.navbar .nav-link:hover,
.navbar .nav-link.active {
    color: #6196FF;
}

.navbar .navbar-toggler {
    border: none;
    color: #fff;
    padding: 0.4rem 0.6rem;
    font-size: 1.2rem;
}

/* Updated Search bar styling */
.search-container {
    width: 220px;
    max-width: 100%;
}

.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 30px;
    height: 36px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.search-input {
    border: none;
    font-size: 0.9rem;
    background-color: transparent;
    height: 100%;
    width: 100%;
    padding: 0 45px 0 20px;
    outline: none;
    color: #fff;
}

.search-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.search-btn {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: transparent;
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-icon {
    width: 18px;
    height: 18px;
    opacity: 0.8;
    filter: brightness(0) invert(1);
}

/* Navbar icons styling */
.navbar-icon {
    height: 22px;
    width: auto;
    filter: brightness(0) invert(1);
}

.nav-icon-link {
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

/* Dropdown menu styling */
.dropdown-menu {
    border-radius: 0.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border: none;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
}

.dropdown-item {
    padding: 0.5rem 1.25rem;
    font-size: 0.85rem;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.user-info {
    background-color: #f8f9fa;
    color: #333;
}

/* Badge positioning fix */
.badge.translate-middle {
    position: absolute;
    top: 0;
    right: 0;
    transform: translate(25%, -25%);
}

/* Mobile search */
.mobile-search {
    padding: 1rem 0;
    background-color: #fff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    display: none;
    z-index: 1010;
}

.mobile-search .search-wrapper {
    background-color: #f5f5f5;
    border: 1px solid #eee;
}

.mobile-search .search-input {
    color: #555;
}

.mobile-search .search-input::placeholder {
    color: #aaa;
}

.mobile-search .search-icon {
    filter: none;
    opacity: 0.6;
}

/* Adjust header carousel to work with transparent navbar */
.header-carousel {
    margin-top: -50px; /* Updated to match top bar height */
}

.header-carousel-item {
    padding-top: 50px; /* Updated to match top bar height */
}

/* User dropdown specific styling - NEW */
.user-dropdown {
    position: relative;
}

.user-dropdown-menu {
    padding: 0.75rem 0;
    min-width: 220px;
    transition: all 0.3s ease;
    display: block;
    opacity: 0;
    visibility: hidden;
    margin-top: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.user-dropdown-menu.show {
    opacity: 1;
    visibility: visible;
}

.user-dropdown .dropdown-item {
    padding: 0.75rem 1.5rem;
    transition: background-color 0.2s ease;
    white-space: nowrap;
}

.user-dropdown .dropdown-item:hover {
    background-color: #f2f7ff;
}

.user-dropdown .user-info {
    padding: 0.75rem 1.5rem;
    background-color: #f8f9fa;
    font-weight: 500;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .navbar {
        background-color: rgba(255, 255, 255, 0.95);
        position: relative;
        top: 0;
        padding: 0.5rem 0;
    }
    
    .navbar .nav-link {
        color: #333;
    }
    
    .navbar .navbar-toggler {
        color: #333;
    }
    
    .navbar-icon {
        filter: none;
    }
    
    .search-wrapper {
        background-color: white;
        border: 1px solid #f0f0f0;
    }
    
    .search-input {
        color: #555;
    }
    
    .search-input::placeholder {
        color: #aaa;
    }
    
    .search-icon {
        filter: none;
        opacity: 0.6;
    }
    
    #navbarContent {
        background-color: white;
        border-radius: 0 0 1rem 1rem;
        padding: 1rem;
        margin-top: 0.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .navbar-collapse {
        max-height: 80vh;
        overflow-y: auto;
    }
    
    .navbar .nav-item {
        border-bottom: 1px solid #f0f0f0;
    }
    
    .navbar .nav-item:last-child {
        border-bottom: none;
    }
    
    .nav-icons {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
        justify-content: center;
    }
    
    .header-carousel {
        margin-top: 0; /* Reset margin for mobile */
    }
    
    .header-carousel-item {
        padding-top: 0; /* Reset padding for mobile */
    }
}

@media (max-width: 767.98px) {
    .top-dark-bar a {
        margin-right: 0.5rem !important;
        font-size: 0.7rem;
    }
    .top-dark-bar a span {
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .navbar-brand img.logo-img {
        height: 28px;
    }
}

@media (max-width: 575.98px) {
    .top-dark-bar .container {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .top-dark-bar a {
        margin-bottom: 0.25rem;
        margin-right: 0.75rem !important;
        font-size: 0.65rem;
    }
    
    .top-dark-bar a:last-child {
        margin-right: 0 !important;
    }
    
    .navbar-brand img.logo-img {
        height: 26px;
    }
}

/* For very small screens like iPhone SE */
@media (max-width: 360px) {
    .top-dark-bar .container {
        flex-direction: column;
        align-items: flex-start;
        padding-left: 1rem;
    }
    .top-dark-bar a {
        margin-right: 0 !important;
    }
}
</style>

<!-- Embedded JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Mobile navbar toggle handling
    const navbarToggler = document.querySelector('.navbar-toggler');
    const mobileSearch = document.querySelector('.mobile-search');
    
    if (navbarToggler && mobileSearch) {
        navbarToggler.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            if (!isExpanded) {
                mobileSearch.classList.remove('d-none');
            } else {
                setTimeout(() => {
                    mobileSearch.classList.add('d-none');
                }, 300); // Delay to match collapse animation
            }
        });
    }
    
    // Handle profile link clicks to open in new tab
    const profileLink = document.getElementById('profileLink');
    if (profileLink) {
        profileLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.open(this.href, '_blank');
        });
    }
    
    // Improved dropdown menu behavior
    const userDropdownContainer = document.querySelector('.user-dropdown');
    const userDropdownToggle = document.getElementById('userDropdown');
    const userDropdownMenu = document.querySelector('.user-dropdown-menu');
    
    if (userDropdownContainer && userDropdownToggle && userDropdownMenu) {
        let dropdownTimeout;
        
        // Show dropdown on hover
        userDropdownContainer.addEventListener('mouseenter', function() {
            clearTimeout(dropdownTimeout);
            
            // Use Bootstrap's dropdown API to show the dropdown
            const bsDropdown = new bootstrap.Dropdown(userDropdownToggle);
            bsDropdown.show();
            
            // Add show class manually for better styling control
            userDropdownMenu.classList.add('show');
        });
        
        // Hide dropdown with delay when mouse leaves
        userDropdownContainer.addEventListener('mouseleave', function() {
            dropdownTimeout = setTimeout(() => {
                // Use Bootstrap's dropdown API to hide the dropdown
                const bsDropdown = bootstrap.Dropdown.getInstance(userDropdownToggle);
                if (bsDropdown) {
                    bsDropdown.hide();
                }
                
                // Remove show class manually
                userDropdownMenu.classList.remove('show');
            }, 300); // 300ms delay before closing
        });
        
        // Keep dropdown open when clicking inside the menu
        userDropdownMenu.addEventListener('click', function(e) {
            // Prevent closing when clicking inside the dropdown menu (except links)
            if (!e.target.closest('a[href]')) {
                e.stopPropagation();
            }
        });
        
        // Handle touch devices
        userDropdownToggle.addEventListener('touchstart', function(e) {
            // Toggle dropdown on touch for mobile
            const isOpen = userDropdownMenu.classList.contains('show');
            if (isOpen) {
                const bsDropdown = bootstrap.Dropdown.getInstance(userDropdownToggle);
                if (bsDropdown) {
                    bsDropdown.hide();
                }
                userDropdownMenu.classList.remove('show');
            } else {
                const bsDropdown = new bootstrap.Dropdown(userDropdownToggle);
                bsDropdown.show();
                userDropdownMenu.classList.add('show');
            }
            e.preventDefault();
        });
    }
});
</script>