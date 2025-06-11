@php
    // Fetch the first record from the compro_parameter table
    $compro = \App\Models\CompanyParameter::first();
    
    // Get active metas
    $activeMetas = \App\Models\Meta::where('start_date', '<=', today())
        ->where('end_date', '>=', today())
        ->get()
        ->groupBy('type');
    
    // Count cart items based on user type - ONLY DISTRIBUTOR AND MEMBER
    $cartCount = 0;
    if (auth()->check() && in_array(auth()->user()->type, ['distributor', 'member'])) {
        if (auth()->user()->type === 'distributor' && session()->has('quotation_cart')) {
            $cartCount = is_array(session('quotation_cart')) ? count(session('quotation_cart')) : 0;
        } elseif (auth()->user()->type === 'member' && session()->has('member_cart')) {
            $cartCount = is_array(session('member_cart')) ? count(session('member_cart')) : 0;
        }
    }
    // No cart access for guests or other user types
    
    // Current date and time (UTC)
    $currentDateTime = "2025-06-04 09:43:42";
    // Current user's login
    $currentUserLogin = "Aliester10";
@endphp

<!-- Main Navigation Bar (Now at top position) -->
<nav class="navbar navbar-expand-lg custom-transparent-navbar">
    <div class="container custom-transparent-container">
        <!-- Logo Section -->
        <a href="{{ route('home') }}" class="navbar-brand custom-transparent-brand">
            <img src="{{ asset('assets/img/Logo.png') }}" alt="SIMPLAY Logo" class="img-fluid logo-img">
        </a>
        
        <!-- Toggler for mobile -->
        <button class="navbar-toggler custom-transparent-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Navbar Content -->
        <div class="collapse navbar-collapse custom-transparent-collapse" id="navbarContent">
            <!-- Main Navigation Links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 custom-transparent-nav">
                <li class="nav-item custom-transparent-item">
                    <a href="{{ route('home') }}" class="nav-link custom-transparent-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item custom-transparent-item">
                    <a href="{{ route('activity') }}" class="nav-link custom-transparent-link {{ request()->routeIs('activity') ? 'active' : '' }}">Activity</a>
                </li>
                
                @if(auth()->check() && in_array(auth()->user()->type, ['distributor', 'member']))
                    <!-- Menu for authorized users only (distributor & member) -->
                    <li class="nav-item custom-transparent-item">
                        <a href="{{ auth()->user()->type == 'member' ? route('portal') : route('distribution') }}" class="nav-link custom-transparent-link">Services</a>
                    </li>
                @endif
                
                <li class="nav-item custom-transparent-item">
                    <a href="{{ route('about') }}" class="nav-link custom-transparent-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                </li>
                <li class="nav-item custom-transparent-item">
                    <a href="{{ route('member.career.index') }}" class="nav-link custom-transparent-link">Career</a>
                </li>
                
                @foreach ($activeMetas as $type => $metas)
                    <li class="nav-item dropdown custom-transparent-item">
                        <a href="#" class="nav-link dropdown-toggle custom-transparent-link" data-bs-toggle="dropdown">{{ ucfirst($type) }}</a>
                        <ul class="dropdown-menu">
                            @foreach ($metas as $meta)
                                <li><a href="{{ route('member.meta.show', $meta->slug) }}" class="dropdown-item">{{ $meta->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                
                <!-- User Menu - Different for Mobile and Desktop -->
                @if(auth()->check() && in_array(auth()->user()->type, ['distributor', 'member']))
                    <!-- Mobile User Menu (Direct Links) - Only visible on mobile for authorized users -->
                    <li class="nav-item d-lg-none mobile-user-item custom-transparent-item">
                        <span class="nav-link user-name-mobile custom-transparent-link">{{ auth()->user()->nama_perusahaan }}</span>
                    </li>
                    <li class="nav-item d-lg-none mobile-user-item custom-transparent-item">
                        <a class="nav-link custom-transparent-link" href="{{ auth()->user()->type == 'member' ? route('profile.show') : (auth()->user()->type == 'distributor' ? route('distributor.profile.show') : '#') }}">
                            <i class="fa fa-user-circle me-2"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item d-lg-none mobile-user-item custom-transparent-item">
                        <a class="nav-link custom-transparent-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt me-2"></i> Keluar
                        </a>
                    </li>
                @else
                    <!-- Mobile Login Button - Only visible on mobile for unauthenticated users -->
                    <li class="nav-item d-lg-none mobile-user-item custom-transparent-item">
                        <a class="nav-link custom-transparent-link mobile-login-link" href="{{ route('login') }}">
                            <i class="fa fa-sign-in-alt me-2"></i> Login
                        </a>
                    </li>
                @endif
            </ul>
            
            <!-- Right Side Icons -->
            <div class="d-flex align-items-center nav-icons custom-transparent-icons">
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
                
                <!-- User Icon - Only for Desktop -->
                <div class="me-3 d-none d-lg-block">
                    @if(auth()->check() && in_array(auth()->user()->type, ['distributor', 'member']))
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
                
                <!-- Cart Icon - ACCESSIBLE FOR ALL, REDIRECT TO LOGIN IF UNAUTHORIZED -->
                <div>
                    @if(auth()->check() && in_array(auth()->user()->type, ['distributor', 'member']))
                        <!-- Functional cart untuk distributor & member -->
                        @if(auth()->user()->type === 'distributor')
                            <a href="{{ route('quotations.cart') }}" class="nav-icon-link position-relative">
                                <img src="{{ asset('assets/icons/navbar-icons/cart.svg') }}" alt="Cart" class="navbar-icon navbar-cart">
                                @if($cartCount > 0)
                                    <span class="cart-badge">{{ $cartCount }}</span>
                                @endif
                            </a>
                        @elseif(auth()->user()->type === 'member')
                            <a href="{{ route('cart.index') }}" class="nav-icon-link position-relative">
                                <img src="{{ asset('assets/icons/navbar-icons/cart.svg') }}" alt="Cart" class="navbar-icon navbar-cart">
                                @if($cartCount > 0)
                                    <span class="cart-badge">{{ $cartCount }}</span>
                                @endif
                            </a>
                        @endif
                    @else
                        <!-- Cart icon yang mengarahkan ke login untuk unauthorized users -->
                        <a href="{{ route('login') }}" class="nav-icon-link position-relative cart-login-redirect" title="Login sebagai Member atau Distributor untuk akses keranjang">
                            <img src="{{ asset('assets/icons/navbar-icons/cart.svg') }}" alt="Cart" class="navbar-icon navbar-cart">
                        </a>
                    @endif
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
/* Main navigation bar styling */
.custom-transparent-navbar {
    background-color: transparent !important;
    padding: 1rem 0;
    z-index: 1030;
    position: absolute;
    width: 100%;
    top: 0;
    border: none !important;
    box-shadow: none !important;
}

.navbar-brand img.logo-img {
    height: 34px;
    width: auto;
}

/* Navigation links - UPDATED: changed text color to black */
.custom-transparent-link {
    color: #000 !important;  /* Changed from #fff to #000 */
    font-weight: 500;
    padding: 0.5rem 1rem;
    margin-right: 0.5rem;
    position: relative;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    text-decoration: none !important;
    background: transparent !important;
    background-color: transparent !important;
}

.custom-transparent-link:hover,
.custom-transparent-link.active {
    color: #6196FF !important;
    background: transparent !important;
    background-color: transparent !important;
}

.custom-transparent-toggler {
    border: none !important;
    color: #000 !important;  /* Changed from #fff to #000 */
    padding: 0.4rem 0.6rem;
    font-size: 1.2rem;
    background: transparent !important;
    background-color: transparent !important;
}

/* Transparent overrides untuk navbar */
.custom-transparent-navbar,
.custom-transparent-container,
.custom-transparent-brand,
.custom-transparent-collapse,
.custom-transparent-nav,
.custom-transparent-item,
.custom-transparent-icons {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
}

/* Search bar styling - UPDATED: changed colors to black */
.search-container {
    width: 220px;
    max-width: 100%;
}

.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.05);  /* Changed background color to be more suitable for black text */
    border-radius: 30px;
    height: 36px;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.2);  /* Changed from white to black border */
}

.search-input {
    border: none;
    font-size: 0.9rem;
    background-color: transparent;
    height: 100%;
    width: 100%;
    padding: 0 45px 0 20px;
    outline: none;
    color: #000;  /* Changed from #fff to #000 */
}

.search-input::placeholder {
    color: rgba(0, 0, 0, 0.6);  /* Changed from white to black placeholder */
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
    filter: none;  /* Removed invert filter to keep the icon black */
}

/* Navbar icons styling - UPDATED: changed to black */
.navbar-icon {
    height: 22px;
    width: auto;
    filter: none;  /* Removed invert filter to keep icons black */
}

.nav-icon-link {
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.3s ease;
}

/* Cart login redirect styling */
.cart-login-redirect {
    opacity: 0.8;
    transition: all 0.3s ease;
}

.cart-login-redirect:hover {
    opacity: 1;
    transform: scale(1.1);
}

/* Cart Badge Styling */
.cart-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: linear-gradient(135deg, #ff3e3e, #ff0000);
    color: white;
    font-size: 10px;
    font-weight: 600;
    min-width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    border: 2px solid white;
    z-index: 10;
    animation: badgePulse 2s infinite;
    transition: all 0.3s ease;
}

@keyframes badgePulse {
    0% {
        box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.4);
    }
    70% {
        box-shadow: 0 0 0 6px rgba(255, 0, 0, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
    }
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

/* Mobile search - UPDATED: changed to black */
.mobile-search {
    padding: 1rem 0;
    background: transparent !important;
    background-color: transparent !important;
    box-shadow: none !important;
    display: none;
    z-index: 1010;
}

.mobile-search .search-wrapper {
    background-color: rgba(0, 0, 0, 0.05);  /* Changed to match main search styling */
    border: 1px solid rgba(0, 0, 0, 0.2);  /* Changed to match main search styling */
}

.mobile-search .search-input {
    color: #000;  /* Changed from #fff to #000 */
}

.mobile-search .search-input::placeholder {
    color: rgba(0, 0, 0, 0.6);  /* Changed from white to black */
}

.mobile-search .search-icon {
    filter: none;  /* Removed invert filter */
    opacity: 0.8;
}

/* Adjust header carousel to work with transparent navbar */
.header-carousel {
    margin-top: 0;
}

.header-carousel-item {
    padding-top: 0;
}

/* User dropdown specific styling */
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

/* Mobile User Menu Styling - UPDATED: changed to black */
.mobile-user-item .nav-link {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);  /* Changed from white to black */
    margin-bottom: 0;
    border-radius: 0;
    padding: 0.75rem 1rem;
    background: transparent !important;
    background-color: transparent !important;
}

.mobile-user-item:last-child .nav-link {
    border-bottom: none;
}

.user-name-mobile {
    background-color: rgba(0, 0, 0, 0.05) !important;  /* Changed from white to black background */
    font-weight: 600 !important;
    color: #000 !important;  /* Changed from #fff to #000 */
    margin-bottom: 0.5rem;
}

/* Mobile Login Link Styling - UPDATED: changed for black text */
.mobile-login-link {
    background-color: rgba(97, 150, 255, 0.1) !important;  /* Lighter background for better contrast with black text */
    color: #000 !important;  /* Changed from #fff to #000 */
    font-weight: 500;
    border-radius: 4px;
    margin: 0.5rem 0;
    text-align: center;
    padding: 0.75rem !important;
    transition: all 0.3s ease;
}

.mobile-login-link:hover, 
.mobile-login-link:active {
    background-color: rgba(97, 150, 255, 0.2) !important;  /* Slightly darker on hover */
    color: #000 !important;  /* Keep black on hover */
}

/* Cart Animations */
.flying-image {
    z-index: 9999;
    pointer-events: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    transform-origin: center center;
}

.cart-bump {
    animation: cartBump 0.5s ease;
}

@keyframes cartBump {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.4); }
}

.count-update {
    animation: countBounce 0.5s ease;
}

@keyframes countBounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.5); background-color: #28a745; }
    100% { transform: scale(1); }
}

/* DESKTOP - Kembalikan tampilan normal */
@media (min-width: 992px) {
    /* PERBAIKAN: Reset untuk desktop agar normal kembali */
    html, body {
        padding-top: 0 !important;
        margin: initial;
        padding: initial;
        background: initial;
        background-color: initial;
    }
    
    .app, .main-wrapper, .content-wrapper, .page-wrapper, .layout-wrapper, 
    header, .header, .top-bar, .header-container {
        background: initial;
        background-color: initial;
        margin: initial;
        padding: initial;
    }
    
    .custom-transparent-navbar {
        position: absolute !important;
    }
    
    .main-content, .container-fluid, .content-wrapper, main {
        margin-top: 0 !important;
        padding-top: initial;
    }
}

/* MOBILE RESPONSIVE - Transparan untuk mobile saja */
@media (max-width: 991.98px) {
    /* Reset HTML & Body untuk mobile */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        background: transparent !important;
        background-color: transparent !important;
    }
    
    /* Override wrapper elements untuk mobile */
    .app, .main-wrapper, .content-wrapper, .page-wrapper, .layout-wrapper, 
    header, .header, .top-bar, .header-container {
        background: none !important;
        background-color: transparent !important;
        background-image: none !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
    }
    
    /* Body content margin untuk mobile */
    .main-content,
    .container-fluid:not(.mobile-search),
    .content-wrapper,
    main {
        margin-top: 80px !important;
        padding-top: 0 !important;
    }
    
    .custom-transparent-navbar {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        padding: 0.5rem 0 !important;
        width: 100%;
        z-index: 1030;
        background: transparent !important;
        background-color: transparent !important;
    }
    
    .custom-transparent-toggler {
        background-color: rgba(0, 0, 0, 0.05) !important;  /* Changed from white to black for better visibility */
        border-radius: 5px;
        border: 1px solid rgba(0, 0, 0, 0.2) !important;  /* Changed from white to black */
    }
    
    /* Menu dropdown semi-transparan untuk keterbacaan - UPDATED: lighter background for black text */
    #navbarContent {
        background-color: rgba(255, 255, 255, 0.95) !important;  /* Changed from dark to light background for black text */
        border-radius: 0 0 1rem 1rem;
        padding: 1rem;
        margin-top: 0.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
    }
    
    .navbar-collapse {
        max-height: 80vh;
        overflow-y: auto;
    }
    
    .custom-transparent-item {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);  /* Changed from white to black */
    }
    
    .custom-transparent-item:last-child {
        border-bottom: none;
    }
    
    .custom-transparent-icons {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);  /* Changed from white to black */
        justify-content: center;
    }
    
    .mobile-search {
        position: fixed;
        top: 80px;
        left: 0;
        right: 0;
        z-index: 1025;
    }
}

/* Mobile size adjustments */
@media (max-width: 767.98px) {
    .navbar-brand img.logo-img {
        height: 28px;
    }
    
    .main-content,
    .container-fluid:not(.mobile-search),
    .content-wrapper,
    main {
        margin-top: 75px !important;
    }
    
    .mobile-search {
        top: 75px !important;
    }
}

@media (max-width: 575.98px) {
    .navbar-brand img.logo-img {
        height: 26px;
    }
    
    .main-content,
    .container-fluid:not(.mobile-search),
    .content-wrapper,
    main {
        margin-top: 70px !important;
    }
    
    .mobile-search {
        top: 70px !important;
    }
}

@media (max-width: 360px) {
    .navbar-brand img.logo-img {
        height: 24px;
    }
    
    .main-content,
    .container-fluid:not(.mobile-search),
    .content-wrapper,
    main {
        margin-top: 65px !important;
    }
    
    .mobile-search {
        top: 65px !important;
    }
}
</style>

<!-- Embedded JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // PERBAIKAN: Hanya apply force transparent untuk mobile
    function forceTransparentBackgroundMobile() {
        if (window.innerWidth <= 991) {
            const elementsToMakeTransparent = [
                'html',
                'body',
                '.app',
                '.main-wrapper', 
                '.content-wrapper',
                '.page-wrapper',
                '.layout-wrapper',
                'header:not(.main-header)',
                '.header:not(.main-header)',
                '.top-bar',
                '.header-container'
            ];
            
            elementsToMakeTransparent.forEach(selector => {
                const elements = document.querySelectorAll(selector);
                elements.forEach(element => {
                    if (element) {
                        element.style.background = 'none';
                        element.style.backgroundColor = 'transparent';
                        element.style.backgroundImage = 'none';
                        element.style.border = 'none';
                        element.style.boxShadow = 'none';
                        element.style.margin = '0';
                        element.style.padding = '0';
                    }
                });
            });
        }
    }
    
    // Apply untuk mobile saja
    forceTransparentBackgroundMobile();
    
    // Re-apply on window resize
    window.addEventListener('resize', function() {
        setTimeout(forceTransparentBackgroundMobile, 100);
    });
    
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
                }, 300);
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
    
    // User dropdown behavior for desktop
    const userDropdownContainer = document.querySelector('.user-dropdown');
    const userDropdownToggle = document.getElementById('userDropdown');
    const userDropdownMenu = document.querySelector('.user-dropdown-menu');
    
    if (userDropdownContainer && userDropdownToggle && userDropdownMenu && window.innerWidth >= 992) {
        let dropdownTimeout;
        
        userDropdownContainer.addEventListener('mouseenter', function() {
            clearTimeout(dropdownTimeout);
            const bsDropdown = new bootstrap.Dropdown(userDropdownToggle);
            bsDropdown.show();
            userDropdownMenu.classList.add('show');
        });
        
        userDropdownContainer.addEventListener('mouseleave', function() {
            dropdownTimeout = setTimeout(() => {
                const bsDropdown = bootstrap.Dropdown.getInstance(userDropdownToggle);
                if (bsDropdown) {
                    bsDropdown.hide();
                }
                userDropdownMenu.classList.remove('show');
            }, 300);
        });
        
        userDropdownMenu.addEventListener('click', function(e) {
            if (!e.target.closest('a[href]')) {
                e.stopPropagation();
            }
        });
        
        userDropdownToggle.addEventListener('touchstart', function(e) {
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
    
    // Updated login check function - ONLY DISTRIBUTOR AND MEMBER CAN ACCESS CART
    window.checkLoginBeforeAddToCart = function(event, productId) {
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        const userType = '{{ auth()->check() ? auth()->user()->type : '' }}';
        const authorizedTypes = ['distributor', 'member'];
        
        if (!isLoggedIn || !authorizedTypes.includes(userType)) {
            event.preventDefault();
            if (!isLoggedIn) {
                // Save product ID to session storage to potentially redirect back after login
                sessionStorage.setItem('pendingCartProduct', productId);
                // Redirect to login page
                window.location.href = "{{ route('login') }}";
            } else {
                // User is logged in but not authorized
                alert('Akses ditolak. Hanya Member dan Distributor yang dapat mengakses keranjang.');
            }
            return false;
        }
        return true;
    }
    
    // Cart animation effects
    function animateCartIcon() {
        const cartIcon = document.querySelector('.navbar-cart');
        const cartBadge = document.querySelector('.cart-badge');
        
        if (cartIcon) {
            cartIcon.classList.add('cart-bump');
            setTimeout(() => {
                cartIcon.classList.remove('cart-bump');
            }, 500);
        }
        
        if (cartBadge) {
            cartBadge.style.transform = 'scale(1.5)';
            cartBadge.style.boxShadow = '0 0 10px rgba(255,0,0,0.7)';
            setTimeout(() => {
                cartBadge.style.transform = '';
                cartBadge.style.boxShadow = '';
            }, 500);
        }
    }
    
    document.addEventListener('cartUpdated', function() {
        animateCartIcon();
    });
    
    document.addEventListener('click', function(e) {
        const addToCartBtn = e.target.closest('.add-to-cart-btn');
        if (addToCartBtn) {
            const productId = addToCartBtn.dataset.productId;
            if (!checkLoginBeforeAddToCart(e, productId)) {
                return;
            }
            
            setTimeout(() => {
                animateCartIcon();
            }, 500);
        }
    });
    
    // Check pending cart product after login
    const pendingProductId = sessionStorage.getItem('pendingCartProduct');
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    const userType = '{{ auth()->check() ? auth()->user()->type : '' }}';
    const authorizedTypes = ['distributor', 'member'];
    
    if (pendingProductId && isLoggedIn && authorizedTypes.includes(userType)) {
        sessionStorage.removeItem('pendingCartProduct');
        // Could auto-add to cart or show notification here
    } else if (pendingProductId && isLoggedIn && !authorizedTypes.includes(userType)) {
        sessionStorage.removeItem('pendingCartProduct');
        alert('Akses ditolak. Hanya Member dan Distributor yang dapat mengakses keranjang.');
    }
});
</script>