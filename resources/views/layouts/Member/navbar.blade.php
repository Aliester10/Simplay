@php
        // Fetch the first record from the compro_parameter table
        $compro = \App\Models\CompanyParameter::first();
    @endphp

    <!-- Topbar Start -->
    <div class="container-fluid bg-light d-none d-lg-block">
        <div class="row align-items-center top-bar">
            <div class="col-lg-3 col-md-12 text-center text-lg-start">
                <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center m-0 p-0">
                    <img src="{{ asset('assets/img/Logo.png') }}" alt="SIMPLAY Logo" class="img-fluid"
                        style="width: 50%;">
                    <img src="{{ asset('assets/img/catalogue.png') }}" alt="Logo" class="me-2"
                        style="height: auto; width: 150px; padding-left: 10px;">
                </a>
            </div>
            <div class="col-lg-9 col-md-12 text-end">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <!-- Maps / Office Location -->
                    @if (!empty($compro->maps))
                        <a href="{{ $compro->maps }}" class="text-gray me-4" target="_blank">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>Lokasi Kantor
                        </a>
                    @else
                        <p class="text-gray me-4">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>Office Location Not Available
                        </p>
                    @endif
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    @if (!empty($compro->email))
                        <a href="mailto:{{ $compro->email }}" class="text-gray me-0">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            {{ $compro->email }}
                        </a>
                    @else
                        <p class="text-gray me-0">
                            <i class="fas fa-envelope text-primary me-2"></i>Email Not Available
                        </p>
                    @endif
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    @if (!empty($compro->no_telepon))
                        <a href="tel:+62{{ $compro->no_telepon }}" class="text-gray me-4">
                            <i class="fas fa-phone-alt text-primary me-2"></i>
                            {{ $compro->no_telepon }}
                        </a>
                    @else
                        <p class="text-gray me-4">
                            <i class="fas fa-phone-alt text-primary me-2"></i>Phone Number Not Available
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    @php
        $activeMetas = \App\Models\Meta::where('start_date', '<=', today())
            ->where('end_date', '>=', today())
            ->get()
            ->groupBy('type');
    @endphp

    <!-- Navbar Start -->
    <div class="container-fluid nav-bar bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-white p-3 py-lg-0 px-lg-4">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center m-0 p-0 d-lg-none">
                <img src="{{ asset('assets/img/Logo.png') }}" alt="SIMPLAY Logo" class="img-fluid"
                    style="max-width: 100px;">
                <img src="{{ asset('assets/img/catalogue.png') }}" alt="Logo" class="me-2"
                    style="height: auto; width: 150px; padding-left: 15px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a href="{{ route('home') }}" class="nav-item nav-link">{{ __('messages.home') }}</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">{{ __('messages.about') }}</a>
                    <a href="{{ route('activity') }}" class="nav-item nav-link">{{ __('messages.activity') }}</a>
                    <a href="{{ route('product.index') }}" class="nav-item nav-link">{{ __('messages.products') }}</a>
                    @foreach ($activeMetas as $type => $metas)
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown-{{ $type }}"
                                aria-expanded="false" data-bs-toggle="dropdown">{{ ucfirst($type) }}</a>
                            <div class="dropdown-menu m-0" aria-labelledby="navbarDropdown-{{ $type }}">
                                @foreach ($metas as $meta)
                                    <a href="{{ route('member.meta.show', $meta->slug) }}"
                                        class="dropdown-item">{{ $meta->title }}</a>
                                @endforeach
                            </div>

                        </div>
                    @endforeach

                    @auth
                        <!-- Dropdown for Portal -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Portal</a>
                            <div class="dropdown-menu m-0">
                                <a href="{{ route('portal') }}"
                                    class="nav-item nav-link">{{ __('messages.portal_member') }}</a>
                                <a href="{{ route('distribution') }}"
                                    class="nav-item nav-link">{{ __('messages.portal_distribution') }}</a>
                            </div>
                        </div>

                    @endauth

                    @if (session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ __('messages.error_message') }}</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    <a href="{{ route('contact') }}" class="nav-item nav-link">{{ __('messages.contact') }}</a>

                    <!-- Dropdown for language selection -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            @if (LaravelLocalization::getCurrentLocale() == 'id')
                                <img src="{{ asset('assets/kai/assets/img/flags/id.png') }}" alt="Bahasa Indonesia"
                                    style="width: 25px; height: auto; margin-right: 5px;">
                            @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                <img src="{{ asset('assets/kai/assets/img/flags/us.png') }}" alt="English"
                                    style="width: 25px; height: auto; margin-right: 5px;">
                            @else
                                {{ LaravelLocalization::getCurrentLocaleNative() }}
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end m-0">
                            <a href="{{ LaravelLocalization::getLocalizedURL('id') }}" class="dropdown-item">
                                <img src="{{ asset('assets/kai/assets/img/flags/id.png') }}" alt="Bahasa Indonesia"
                                    style="width: 25px; height: auto; margin-right: 5px;">
                                {{ __('messages.bahasa') }}
                            </a>
                            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="dropdown-item">
                                <img src="{{ asset('assets/kai/assets/img/flags/us.png') }}" alt="English"
                                    style="width: 25px; height: auto; margin-right: 5px;">
                                {{ __('messages.english') }}
                            </a>

                        </div>

                    </div>
                    <!-- Shopping Cart Icon -->
                    @auth
                        @if (Auth::user()->type === 'distributor')
                            <div class="nav-item">
                                <a href="{{ route('quotations.cart') }}" class="nav-link">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span id="cart-count" class="badge bg-primary rounded-pill">
                                        {{ session('quotation_cart') ? count(session('quotation_cart')) : 0 }}
                                    </span>
                                </a>

                            </div>
                        @endif
                    @endauth
                </div>

<!-- Profile and Logout for Members -->
<div class="mt-4 mt-lg-0 me-lg-n4 py-3 px-4 bg-primary d-flex align-items-center">
    @if (auth()->check())
        <div class="dropdown text-light">
            <a href="#" class="dropdown-toggle text-light d-flex align-items-center" id="companyDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <small class="text-light d-flex align-items-center">
                    <i class="fa fa-user text-primary me-2"></i> {{ auth()->user()->nama_perusahaan }}
                </small>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="companyDropdown">
                <!-- Profile -->
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2"
                        href="{{ auth()->user()->type == 'member' ? route('profile.show') : (auth()->user()->type == 'distributor' ? route('distributor.profile.show') : '#') }}"
                        id="profileLink">
                        <i class="fa fa-user me-2"></i> Profil
                    </a>
                </li>
                <!-- Logout -->
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt me-2"></i> Keluar
                    </a>
                </li>
            </ul>
        </div>
        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @else
        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill text-white py-1 px-3">
            <i class="fa fa-sign-in-alt text-white me-2"></i> Masuk Member
        </a>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const profileLink = document.getElementById("profileLink");

        if (profileLink) {
            profileLink.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent default action
                const url = profileLink.getAttribute("href");
                window.open(url, '_blank'); 
            });
        }
    });
</script>


            </div>

        </nav>
    </div>
    <!-- Navbar End -->

    <style>
        .navbar-nav .nav-link.active {
            color: #6196FF !important;
            border-bottom: 2px solid #6196FF;
            padding-bottom: 5px;
        }

        .navbar-nav .nav-link:hover {
            border-bottom: 2px solid #6196FF;
            padding-bottom: 5px;
        }

        .nav-item .dropdown-item.active {
            color: #6196FF !important;
            font-weight: bold;
        }

        .nav-item .dropdown-toggle.active {
            color: #6196FF !important;
            border-bottom: 2px solid #6196FF;
        }

        .nav-item .dropdown-menu {
            min-width: 220px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .nav-item .dropdown-menu .dropdown-item {
            padding-left: 15px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.navbar-nav .nav-link');
            const metaDropdownItems = document.querySelectorAll('.dropdown-item');
            const currentUrl = window.location.href;

            // Set the active link on page load
            function setActiveLink() {
                let foundActive = false;

                // Iterate through .nav-link to check for the active URL
                links.forEach(link => {
                    if (link.href === currentUrl) {
                        link.classList.add('active');
                        foundActive = true;
                    } else {
                        link.classList.remove('active');
                    }
                });

                if (!foundActive && links.length > 0) {
                    links[0].classList.add('active');
                }
            }

            // Event listener for dropdown meta items
            metaDropdownItems.forEach(item => {
                item.addEventListener('click', function (event) {
                    event.preventDefault();

                    // Remove active class from all links
                    links.forEach(link => link.classList.remove('active'));

                    // Add active class to the parent dropdown link
                    const dropdownElement = this.closest('.dropdown');
                    if (dropdownElement) {
                        const dropdownLink = dropdownElement.querySelector('.nav-link');
                        dropdownLink.classList.add('active');
                    }

                    // Navigate to the clicked URL after a short delay
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 100);
                });
            });

            // Ensure the active link is set when the page loads
            setActiveLink();
        });
    </script>
    </body>