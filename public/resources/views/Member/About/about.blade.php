@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header mb-5 py-5"
        style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/about.jpg') }}') center center no-repeat; background-size: cover; height: 600px; position: relative;">
        <!-- Enhanced White Overlay with More Opacity -->
        <div class="white-overlay"></div>
        <div class=" d-flex align-items-center justify-content-center h-100" style="position: relative; z-index: 3;">
            <div class="text-center">
                <h1 class="display-3 text-dark mb-0 animated slideInDown header-title">{{ __('messages.about_us') }}</h1>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5 scroll-reveal">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp scroll-item fade-in-left" data-wow-delay="0.1s">
                    <h5 class="text-secondary text-uppercase">{{ __('messages.about_us') }}</h5>
                    <h1 class="mb-4">{{ $compro->nama_perusahaan ?? 'PT Simplay Abyakta Mediatek' }}</h1>
                    <p class="mb-4" style="text-align: justify;">{{ $company->sejarah_singkat ?? ' ' }}</p>
                </div>
                <div class="col-lg-6 pt-4 scroll-item fade-in-right" style="min-height: 500px;">
                    <div class="position-relative h-100 wow fadeInUp" data-wow-delay="0.5s">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets/img/building.jpeg') }}"
                            style="object-fit: cover; padding: 0 0 50px 100px;" alt="">
                        <img class="position-absolute start-0 bottom-0 img-fluid bg-white pt-2 pe-2 w-50 h-50"
                            src="{{ asset('assets/img/profil2.png') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Modern Vision & Mission Start -->
    <div class="container-fluid py-5 vision-mission-section scroll-reveal">
        <div class="container">
            <!-- Title Section -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <div class="section-title scroll-item fade-in-up">
                        <span class="subtitle">Excellence & Innovation</span>
                        <h2 class="main-title">Our Vision And Mission</h2>
                        <div class="title-decoration"></div>
                    </div>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="row g-4 justify-content-center">
                <!-- QUALITY Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="modern-card quality-card scroll-item fade-in-up" data-delay="0.1">
                        <div class="card-header">
                            <div class="icon-box">
                                <i class="fas fa-gem"></i>
                            </div>
                            <h3 class="card-title">QUALITY</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                We provide a variety of high-quality Electronic Equipment and Supporting Equipment according to the needs of consumer needs.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- SERVICES Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="modern-card services-card scroll-item fade-in-up" data-delay="0.3">
                        <div class="card-header">
                            <div class="icon-box">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h3 class="card-title">SERVICES</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Incredible speakers, top-tier networking, and cutting-edge discussions all in one place.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- SATISFACTION Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="modern-card satisfaction-card scroll-item fade-in-up" data-delay="0.5">
                        <div class="card-header">
                            <div class="icon-box">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3 class="card-title">SATISFACTION</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                From hands-on workshops to visionary talks, this summit is a must-attend for AI professionals.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modern Vision & Mission End -->

    <!-- Brand Start (Revised for vertical scroll) -->
    <div id="brand" class="container-xxl py-5 scroll-reveal" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="text-center wow fadeInUp scroll-item fade-in-up" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">{{ __('messages.our_brand') }}</h6>
                <h1 class="mb-5">{{ __('messages.brands_product') }}</h1>
            </div>
            @if ($partners->isEmpty())
                <div class="carousel-container-vertical scroll-item fade-in-scale" style="height: 250px; overflow: hidden; position: relative;">
                    <div class="carousel-content-vertical" style="text-align: center; padding: 20px;">
                        <p class="text-dark" style="letter-spacing: 2px; margin: 0;">
                            {{ __('messages.brand_not_available') }}
                        </p>
                    </div>
                </div>
            @else
                <div class="carousel-container-vertical scroll-item fade-in-scale">
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

    <!-- Customer Start - Ultra Modern Design -->
    <div id="user" class="container-fluid py-5 customer-section scroll-reveal">
        <div class="container py-5">
            <div class="customer-container scroll-item fade-in-scale">
                <!-- Decorative Elements -->
                <div class="floating-particle particle-1"></div>
                <div class="floating-particle particle-2"></div>
                <div class="floating-particle particle-3"></div>
                <div class="floating-particle particle-4"></div>
                
                <!-- Left Column - Text Content (Purple) -->
                <div class="customer-text-column">
                    <div class="text-content-wrapper">
                        <h2 class="customer-title">Our Loyal <span class="highlight-text">Customers</span></h2>
                        <div class="title-underline"></div>
                        
                        <p class="customer-description">
                            You've stayed with us through every step — and for that we're endlessly grateful. Thank you for your loyalty.
                        </p>
                    </div>
                </div>
                
                <!-- Right Column - 3D Rotating Showcase -->
                <div class="customer-logos-column">
                    <div class="logos-showcase-container">
                        <div class="logos-rotator">
                            @if ($principals->isEmpty())
                                <div class="customer-empty-state">
                                    <p>{{ __('messages.user_not_available') }}</p>
                                </div>
                            @else
                                @foreach ($principals as $principal)
                                    <div class="logo-showcase-item">
                                        <div class="logo-card">
                                            <div class="logo-card-inner">
                                                <div class="logo-card-front">
                                                    <img src="{{ asset($principal->gambar) }}" alt="{{ $principal->nama }}">
                                                </div>
                                                <div class="logo-card-back">
                                                    <div class="logo-shine"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        <!-- Pagination Indicators -->
                        <div class="showcase-indicators">
                            @if (!$principals->isEmpty())
                                @foreach ($principals->chunk(4) as $index => $chunk)
                                    <span class="indicator {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
                                @endforeach
                            @endif
                        </div>
                        
                        <!-- Navigation Controls -->
                        <div class="showcase-controls">
                            <button class="control-prev">
                                <i class="fa fa-chevron-left"></i>
                            </button>
                            <button class="control-next">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer End -->

    <!-- Contact Us Start - Clean Layout -->
    <div class="container-fluid py-5 scroll-reveal" style="background-color: #ffffff;">
        <div class="container">
            <!-- Section Title -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h6 class="text-secondary text-uppercase wow fadeInUp scroll-item fade-in-up" data-wow-delay="0.1s">Get In Touch</h6>
                    <h2 class="contact-heading wow fadeInUp scroll-item fade-in-up" data-wow-delay="0.3s">Contact Us</h2>
                    <div class="contact-title-underline wow fadeInUp scroll-item fade-in-up" data-wow-delay="0.5s"></div>
                </div>
            </div>

            <div class="row">
                <!-- Left Column - Contact Form -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="scroll-item fade-in-left">
                        <div class="simple-form-container">
                            <h3>GET IN TOUCH</h3>
                            <p class="mb-4">Reach out with inquiries about tickets, partnerships or event details.</p>
                            
                            <form action="#" method="POST" id="contactForm">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                    <label for="name">Your Name</label>
                                    <div class="focus-border"></div>
                                </div>
                                
                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    <label for="email">Your Email</label>
                                    <div class="focus-border"></div>
                                </div>
                                
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                    <div class="focus-border"></div>
                                </div>
                                
                                <div class="form-floating mb-4">
                                    <textarea class="form-control" id="message" name="message" placeholder="Message" style="height: 120px"></textarea>
                                    <label for="message">Your Message</label>
                                    <div class="focus-border"></div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn-submit">
                                        <span>Send Message</span>
                                        <div class="btn-hover-effect"></div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Contact Information -->
                <div class="col-lg-6">
                    <div class="contact-info-container scroll-item fade-in-right">
                        <div class="contact-info-header">
                            <div class="contact-header-pattern"></div>
                            <div class="contact-header-content">
                                <h2 class="text-white fw-bold">We're Here To Connect And Assist You</h2>
                                <p class="text-white opacity-75">Have questions about the summit? Need help with registration or travel? Our team is ready to assist you.</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-cards">
                            <!-- Phone Card -->
                            <div class="contact-card">
                                <div class="contact-card-icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                </div>
                                <div class="contact-card-content">
                                    <h5>CONTACT US</h5>
                                    <p>+62 812 9006-9099</p>
                                </div>
                            </div>
                            
                            <!-- Location Card -->
                            <div class="contact-card">
                                <div class="contact-card-icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <div class="contact-card-content">
                                    <h5>LOCATION</h5>
                                    <p>BCPNK Jakarta Jl. Raya Bekasi KM.25<br>
                                    Blok D2 No.5 & 6, Pilar Raya, Cakung<br>
                                    Jakarta Timur (Jakarta Barat), Indonesia (13960)</p>
                                </div>
                            </div>
                            
                            <!-- Email Card -->
                            <div class="contact-card">
                                <div class="contact-card-icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="contact-card-content">
                                    <h5>EMAIL</h5>
                                    <p>info@epacommerce.com</p>
                                </div>
                            </div>
                            
                            <!-- Social Media Card -->
                            <div class="contact-card">
                                <div class="contact-card-icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-share-alt"></i>
                                    </div>
                                </div>
                                <div class="contact-card-content">
                                    <h5>FOLLOW US</h5>
                                    <div class="social-icons">
                                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="floating-circle circle-1"></div>
                        <div class="floating-circle circle-2"></div>
                        <div class="floating-dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Us End -->

    <style>
        /* Enhanced White Overlay - More Opaque at Bottom for Better Blending */
        .white-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                to top,
                rgb(255, 255, 255) 0%,
                rgba(255, 255, 255, 0.98) 10%,
                rgba(255, 255, 255, 0.85) 20%,
                rgba(255, 255, 255, 0.7) 35%,
                rgba(255, 255, 255, 0.5) 50%,
                rgba(255, 255, 255, 0.3) 65%,
                rgba(255, 255, 255, 0.15) 80%,
                rgba(255, 255, 255, 0.05) 90%,
                rgba(255, 255, 255, 0) 100%
            );
            z-index: 2;
            opacity: 0;
            animation: overlayFadeIn 1.5s ease-out forwards;
        }

        .header-title {
            font-weight: 700;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            animation: headerTitleFloat 3s ease-in-out infinite;
        }

        /* Enhanced Scroll Reveal Animations */
        .scroll-reveal {
            overflow-x: hidden;
        }

        .scroll-item {
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Fade In Up Animation */
        .scroll-item.fade-in-up {
            transform: translateY(60px);
        }

        .scroll-item.fade-in-up.reveal {
            opacity: 1;
            transform: translateY(0);
        }

        /* Fade In Left Animation */
        .scroll-item.fade-in-left {
            transform: translateX(-60px);
        }

        .scroll-item.fade-in-left.reveal {
            opacity: 1;
            transform: translateX(0);
        }

        /* Fade In Right Animation */
        .scroll-item.fade-in-right {
            transform: translateX(60px);
        }

        .scroll-item.fade-in-right.reveal {
            opacity: 1;
            transform: translateX(0);
        }

        /* Fade In Scale Animation */
        .scroll-item.fade-in-scale {
            transform: scale(0.8);
        }

        .scroll-item.fade-in-scale.reveal {
            opacity: 1;
            transform: scale(1);
        }

        /* Staggered Animation Delays */
        .scroll-item[data-delay="0.1"].reveal {
            transition-delay: 0.1s;
        }

        .scroll-item[data-delay="0.3"].reveal {
            transition-delay: 0.3s;
        }

        .scroll-item[data-delay="0.5"].reveal {
            transition-delay: 0.5s;
        }

        /* Modern Vision & Mission Section */
        .vision-mission-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
        }

        /* Section Title with Enhanced Animation */
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title.reveal .subtitle {
            animation: slideInFromTop 0.8s ease-out forwards;
        }

        .section-title.reveal .main-title {
            animation: slideInFromBottom 0.8s ease-out 0.2s forwards;
        }

        .section-title.reveal .title-decoration {
            animation: expandWidth 0.8s ease-out 0.4s forwards;
        }

        .subtitle {
            display: block;
            color: #6c757d;
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            opacity: 0;
            transform: translateY(-20px);
        }

        .main-title {
            font-size: 48px;
            font-weight: 800;
            color: #1a0942;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #1a0942, #6935D3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0;
            transform: translateY(20px);
        }

        .title-decoration {
            width: 0;
            height: 4px;
            background: linear-gradient(135deg, #1a0942, #6935D3);
            margin: 0 auto;
            border-radius: 2px;
        }

        /* Modern Cards with Enhanced Hover Effects */
        .modern-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            height: 100%;
            overflow: hidden;
            position: relative;
            border: 1px solid #f0f0f0;
            transform: translateY(0);
        }

        .modern-card.reveal {
            animation: cardSlideIn 0.8s ease-out forwards;
        }

        .modern-card:hover {
            transform: translateY(-15px) rotateX(2deg);
            box-shadow: 0 25px 70px rgba(0,0,0,0.2);
        }

        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #1a0942, #6935D3);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modern-card:hover::before {
            opacity: 1;
        }

        /* Card Header */
        .card-header {
            padding: 40px 30px 20px;
            text-align: center;
            position: relative;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1a0942, #6935D3);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 8px 25px rgba(26, 9, 66, 0.3);
            position: relative;
            overflow: hidden;
        }

        .icon-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .modern-card:hover .icon-box {
            transform: scale(1.1) rotateY(5deg);
            box-shadow: 0 15px 40px rgba(26, 9, 66, 0.4);
        }

        .modern-card:hover .icon-box::before {
            left: 100%;
        }

        .icon-box i {
            font-size: 32px;
            color: white;
            transition: all 0.3s ease;
        }

        .modern-card:hover .icon-box i {
            transform: scale(1.1);
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a0942;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
            transition: all 0.3s ease;
        }

        .modern-card:hover .card-title {
            color: #6935D3;
        }

        /* Card Body */
        .card-body {
            padding: 0 30px 40px;
            text-align: center;
        }

        .card-text {
            color: #6c757d;
            font-size: 16px;
            line-height: 1.7;
            margin: 0;
            transition: all 0.3s ease;
        }

        .modern-card:hover .card-text {
            color: #495057;
        }

        /* Brand Section Styles */
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
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            padding: 15px;
            height: 80px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            background: white;
        }

        .brand-item:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
            border-color: #1a0942;
        }

        .brand-item img {
            max-height: 60px;
            width: auto;
            transition: all 0.4s ease;
            filter: grayscale(100%);
        }

        .brand-item:hover img {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        /* Customer Section */
        .customer-section {
            background: linear-gradient(135deg, #f0f2f5 0%, #e8edf2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .customer-container {
            display: flex;
            background-color: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.12);
            height: 642px;
            position: relative;
            transition: all 0.5s ease;
        }

        .customer-container.reveal {
            animation: containerSlideIn 1s ease-out forwards;
        }
        
        /* Floating particles - Enhanced Movement */
        .floating-particle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.6), rgba(255,255,255,0.1));
            filter: blur(2px);
            opacity: 0.4;
            z-index: 1;
        }
        
        .particle-1 {
            width: 60px;
            height: 60px;
            top: 10%;
            left: 5%;
            animation: floatEnhanced1 8s ease-in-out infinite;
        }
        
        .particle-2 {
            width: 40px;
            height: 40px;
            top: 20%;
            right: 10%;
            animation: floatEnhanced2 10s ease-in-out infinite 2s;
        }
        
        .particle-3 {
            width: 25px;
            height: 25px;
            bottom: 15%;
            left: 15%;
            animation: floatEnhanced3 7s ease-in-out infinite 1s;
        }
        
        .particle-4 {
            width: 35px;
            height: 35px;
            bottom: 25%;
            right: 5%;
            animation: floatEnhanced4 9s ease-in-out infinite 3s;
        }
        
        /* Text Column Styles */
        .customer-text-column {
            flex: 0 0 auto;
            width: calc(100% - 695px);
            background: linear-gradient(135deg, #1a0942, #3a1168);
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
            z-index: 3;
        }
        
        .text-content-wrapper {
            position: relative;
            z-index: 5;
        }
        
        .customer-title {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
            color: white;
        }
        
        .highlight-text {
            position: relative;
            display: inline-block;
            color: white;
        }
        
        .title-underline {
            width: 60px;
            height: 4px;
            background: white;
            margin-bottom: 25px;
            border-radius: 2px;
        }
        
        .customer-description {
            font-size: 16px;
            line-height: 1.8;
            color: rgba(255,255,255,0.9);
            max-width: 450px;
        }
        
        /* Logos Column Styles */
        .customer-logos-column {
            flex: 0 0 auto;
            width: 695px;
            height: 642px;
            position: relative;
            background-color: white;
            overflow: hidden;
            z-index: 3;
        }
        
        /* Logos Showcase Container */
        .logos-showcase-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1200px;
            z-index: 10;
        }
        
        .logos-rotator {
            position: relative;
            width: 80%;
            height: 80%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 30px;
        }
        
        .logo-showcase-item {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1000px;
        }
        
        .logo-card {
            width: 200px;
            height: 200px;
            position: relative;
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .logo-card:hover {
            transform: rotateY(180deg) scale(1.05);
        }
        
        .logo-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.6s ease;
        }
        
        .logo-card-front,
        .logo-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .logo-card-front {
            background: transparent;
            z-index: 2;
            transform: rotateY(0deg);
            padding: 20px;
            border: 1px solid #eee;
            transition: all 0.3s ease;
        }

        .logo-card:hover .logo-card-front {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .logo-card-front img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            transition: all 0.4s ease;
        }
        
        .logo-card:hover .logo-card-front img {
            transform: scale(1.15);
        }
        
        .logo-card-back {
            background: transparent;
            transform: rotateY(180deg);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eee;
        }
        
        .logo-shine {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(255,255,255,0) 0%, 
                rgba(255,255,255,0.1) 50%, 
                rgba(255,255,255,0) 100%);
        }
        
        /* Pagination */
        .showcase-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 5;
        }
        
        .indicator {
            width: 30px;
            height: 5px;
            background-color: #ddd;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.4s ease;
        }
        
        .indicator.active {
            background: linear-gradient(to right, #1a0942, #3a1168);
            width: 40px;
        }
        
        /* Controls */
        .showcase-controls {
            position: absolute;
            bottom: 80px;
            right: 40px;
            display: flex;
            gap: 15px;
            z-index: 5;
        }
        
        .control-prev,
        .control-next {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            color: #1a0942;
        }
        
        .control-prev:hover,
        .control-next:hover {
            background: #1a0942;
            color: white;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .customer-empty-state {
            grid-column: span 2;
            grid-row: span 2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-style: italic;
            height: 100%;
            width: 100%;
            font-size: 18px;
        }
        
        /* Contact Section Enhanced Styles */
        .contact-section {
            position: relative;
            overflow: hidden;
        }
        
        /* Section Header */
        .contact-heading {
            font-size: 42px;
            font-weight: 700;
            background: linear-gradient(to right, #1a0942, #6935D3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }
        
        .contact-title-underline {
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #1a0942, #6935D3);
            margin: 0 auto;
            border-radius: 2px;
        }
        
        /* Contact Info Container */
        .contact-info-container {
            position: relative;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            height: 100%;
            overflow: hidden;
            background-color: #1a0942;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .contact-info-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }
        
        .contact-info-header {
            position: relative;
            padding: 3rem;
            overflow: hidden;
        }
        
        .contact-header-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle at 10% 10%, rgba(255,255,255,0.1) 1px, transparent 2px);
            background-size: 20px 20px;
            background-position: 0 0;
            pointer-events: none;
            opacity: 0.3;
        }
        
        .contact-header-content {
            position: relative;
            z-index: 2;
        }
        
        .contact-header-content h2 {
            font-size: 32px;
            margin-bottom: 20px;
            position: relative;
        }
        
        .contact-header-content h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: white;
            border-radius: 3px;
        }
        
        .contact-info-cards {
            padding: 0 3rem 3rem;
        }
        
        /* Contact Cards */
        .contact-card {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            position: relative;
            transition: all 0.4s ease;
            padding: 1rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
        }
        
        .contact-card:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(8px);
        }
        
        .contact-card-icon {
            flex: 0 0 60px;
            margin-right: 15px;
        }
        
        .icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }
        
        .contact-card:hover .icon-wrapper {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }
        
        .contact-card-content {
            flex: 1;
        }
        
        .contact-card-content h5 {
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        
        .contact-card-content p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 0;
        }
        
        /* Social Icons */
        .social-icons {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }
        
        .social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
            font-size: 15px;
        }
        
        .social-icon:hover {
            background: #6935D3;
            transform: translateY(-3px) scale(1.1);
            color: white;
        }
        
        /* Floating elements */
        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            z-index: 1;
        }
        
        .circle-1 {
            width: 200px;
            height: 200px;
            bottom: -60px;
            right: -60px;
        }
        
        .circle-2 {
            width: 150px;
            height: 150px;
            top: 40px;
            right: -60px;
        }
        
        .floating-dots {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: 1;
            pointer-events: none;
            opacity: 0.3;
        }
        
        /* Simplified Contact Form */
        .simple-form-container {
            padding: 40px 0;
            background: transparent;
        }
        
        .simple-form-container h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1a0942;
        }
        
        /* Form styling */
        .form-floating {
            position: relative;
        }
        
        .form-control {
            height: 55px;
            border: 2px solid #e9ecef !important;
            border-radius: 15px !important;
            background-color: transparent !important;
            padding: 1.2rem 1rem 0.6rem !important;
            font-size: 16px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: none;
            padding-top: 1.5rem !important;
        }
        
        .form-control:focus {
            border-color: #6935D3 !important;
            box-shadow: 0 0 0 0.2rem rgba(105, 53, 211, 0.25) !important;
            transform: translateY(-2px);
            background-color: transparent !important;
        }
        
        .form-floating label {
            padding: 1rem 1rem 0 !important;
            color: #72767b;
            opacity: 0.8;
            transition: all 0.3s ease;
        }
        
        .form-floating > .form-control:focus ~ label {
            color: #6935D3;
            opacity: 1;
            transform: scale(0.9) translateY(-0.5rem) translateX(0.15rem);
        }
        
        .focus-border {
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #6935D3;
            transition: all 0.4s ease;
        }
        
        .form-control:focus ~ .focus-border {
            width: 100%;
            left: 0;
        }
        
        .form-floating .form-control:not(:placeholder-shown) ~ label {
            opacity: 0.8;
            transform: scale(0.9) translateY(-0.5rem) translateX(0.15rem);
        }
        
        /* Submit button */
        .btn-submit {
            position: relative;
            padding: 14px 30px;
            background: linear-gradient(135deg, #6935D3 0%, #5725c0 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 5px 15px rgba(105, 53, 211, 0.3);
            width: 200px;
        }
        
        .btn-submit span {
            position: relative;
            z-index: 2;
        }
        
        .btn-hover-effect {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 120%;
            height: 120%;
            background: linear-gradient(135deg, #5725c0 0%, #6935D3 100%);
            border-radius: 50%;
            transform: scale(0);
            transition: all 0.4s ease;
            z-index: 1;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(105, 53, 211, 0.4);
        }
        
        .btn-submit:hover .btn-hover-effect {
            transform: scale(1);
        }

        /* Enhanced Keyframes Animations */
        @keyframes overlayFadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes headerTitleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        @keyframes scrollVertical {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }

        @keyframes slideInFromTop {
            0% { 
                opacity: 0; 
                transform: translateY(-30px); 
            }
            100% { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        @keyframes slideInFromBottom {
            0% { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            100% { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        @keyframes expandWidth {
            0% { width: 0; }
            100% { width: 80px; }
        }

        @keyframes cardSlideIn {
            0% { 
                opacity: 0; 
                transform: translateY(50px) scale(0.9); 
            }
            100% { 
                opacity: 1; 
                transform: translateY(0) scale(1); 
            }
        }

        @keyframes containerSlideIn {
            0% { 
                opacity: 0; 
                transform: scale(0.95) translateY(30px); 
            }
            100% { 
                opacity: 1; 
                transform: scale(1) translateY(0); 
            }
        }

        /* Enhanced floating particle animations */
        @keyframes floatEnhanced1 {
            0%, 100% { transform: translateY(0px) translateX(0px) rotate(0deg); }
            25% { transform: translateY(-20px) translateX(10px) rotate(90deg); }
            50% { transform: translateY(-15px) translateX(-5px) rotate(180deg); }
            75% { transform: translateY(-25px) translateX(15px) rotate(270deg); }
        }

        @keyframes floatEnhanced2 {
            0%, 100% { transform: translateY(0px) translateX(0px) scale(1); }
            25% { transform: translateY(-15px) translateX(-10px) scale(1.1); }
            50% { transform: translateY(-30px) translateX(5px) scale(0.9); }
            75% { transform: translateY(-10px) translateX(-15px) scale(1.05); }
        }

        @keyframes floatEnhanced3 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-25px) rotate(120deg); }
            66% { transform: translateY(-10px) rotate(240deg); }
        }

        @keyframes floatEnhanced4 {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            20% { transform: translateY(-18px) translateX(8px); }
            40% { transform: translateY(-25px) translateX(-12px); }
            60% { transform: translateY(-15px) translateX(15px); }
            80% { transform: translateY(-30px) translateX(-8px); }
        }
        
        /* Responsive styles */
        @media (max-width: 1200px) {
            .customer-container {
                flex-direction: column;
                height: auto;
            }
            
            .customer-text-column,
            .customer-logos-column {
                width: 100%;
                height: auto;
                min-height: 400px;
                padding: 40px;
            }
            
            .logo-card {
                width: 150px;
                height: 150px;
            }

            .main-title {
                font-size: 42px;
            }
        }

        @media (max-width: 768px) {
            .customer-title {
                font-size: 32px;
            }
            
            .customer-text-column,
            .customer-logos-column {
                padding: 30px;
                min-height: 350px;
            }
            
            .logo-card {
                width: 120px;
                height: 120px;
            }
            
            .contact-heading {
                font-size: 32px;
            }

            .header-title {
                font-size: 2.5rem !important;
            }

            .main-title {
                font-size: 36px;
            }

            /* Reduce animation intensity on mobile */
            .scroll-item.fade-in-up {
                transform: translateY(30px);
            }

            .scroll-item.fade-in-left,
            .scroll-item.fade-in-right {
                transform: translateY(30px);
            }
        }

        @media (max-width: 576px) {
            .customer-title {
                font-size: 24px;
            }
            
            .simple-form-container {
                padding: 25px 0;
            }

            .header-title {
                font-size: 2rem !important;
            }

            .main-title {
                font-size: 32px;
            }

            .subtitle {
                font-size: 14px;
                letter-spacing: 1px;
            }

            .card-header {
                padding: 30px 20px 15px;
            }

            .card-body {
                padding: 0 20px 30px;
            }

            /* Simplify animations on small screens */
            .scroll-item {
                transition: all 0.6s ease;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Enhanced Scroll Reveal with Better Performance
            const createScrollObserver = () => {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const delay = entry.target.getAttribute('data-delay') || 0;
                            
                            setTimeout(() => {
                                entry.target.classList.add('reveal');
                                
                                // Trigger special animations for specific elements
                                if (entry.target.classList.contains('section-title')) {
                                    triggerTitleAnimations(entry.target);
                                }
                                
                                if (entry.target.classList.contains('modern-card')) {
                                    triggerCardAnimation(entry.target);
                                }
                            }, parseFloat(delay) * 1000);
                            
                            // Stop observing this element once it's revealed
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                // Observe all scroll items
                document.querySelectorAll('.scroll-item').forEach(item => {
                    observer.observe(item);
                });
            };

            // Enhanced title animations
            const triggerTitleAnimations = (titleElement) => {
                const subtitle = titleElement.querySelector('.subtitle');
                const mainTitle = titleElement.querySelector('.main-title');
                const decoration = titleElement.querySelector('.title-decoration');

                if (subtitle) {
                    setTimeout(() => subtitle.style.opacity = '1', 100);
                }
                if (mainTitle) {
                    setTimeout(() => mainTitle.style.opacity = '1', 300);
                }
                if (decoration) {
                    setTimeout(() => decoration.style.width = '80px', 500);
                }
            };

            // Enhanced card animations
            const triggerCardAnimation = (cardElement) => {
                const iconBox = cardElement.querySelector('.icon-box');
                const title = cardElement.querySelector('.card-title');
                const text = cardElement.querySelector('.card-text');

                if (iconBox) {
                    setTimeout(() => {
                        iconBox.style.transform = 'scale(1.05)';
                        setTimeout(() => {
                            iconBox.style.transform = 'scale(1)';
                        }, 200);
                    }, 100);
                }
            };

            // Logo Showcase with Enhanced Performance
            const setupLogoShowcase = () => {
                const logoItems = document.querySelectorAll('.logo-showcase-item');
                const indicators = document.querySelectorAll('.indicator');
                const totalSlides = {{ $principals->count() ?? 0 }};
                const slidesPerPage = 4;
                const totalPages = Math.ceil(totalSlides / slidesPerPage);
                
                if (totalPages <= 1) return;
                
                let currentPage = 0;
                let autoPlayTimer;
                let isTransitioning = false;
                
                const goToPage = (page) => {
                    if (isTransitioning) return;
                    isTransitioning = true;
                    currentPage = page;
                    
                    logoItems.forEach((item, index) => {
                        const inCurrentPage = index >= page * slidesPerPage && index < (page + 1) * slidesPerPage;
                        
                        if (inCurrentPage) {
                            const positionInPage = index - (page * slidesPerPage);
                            const row = Math.floor(positionInPage / 2) + 1;
                            const col = positionInPage % 2 + 1;
                            
                            item.style.gridRow = `${row}`;
                            item.style.gridColumn = `${col}`;
                            item.style.display = 'flex';
                            item.style.opacity = '0';
                            item.style.transform = 'scale(0.8)';
                            
                            // Staggered animation for each logo
                            setTimeout(() => {
                                item.style.transition = 'all 0.4s ease';
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, positionInPage * 100);
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    indicators.forEach((dot, i) => {
                        dot.classList.toggle('active', i === page);
                    });
                    
                    setTimeout(() => {
                        isTransitioning = false;
                    }, 800);
                };
                
                const startAutoPlay = () => {
                    autoPlayTimer = setInterval(() => {
                        const nextPage = (currentPage + 1) % totalPages;
                        goToPage(nextPage);
                    }, 6000); // Longer interval for better UX
                };
                
                const stopAutoPlay = () => {
                    clearInterval(autoPlayTimer);
                };
                
                goToPage(0);
                setTimeout(startAutoPlay, 3000);
                
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        if (currentPage === index || isTransitioning) return;
                        stopAutoPlay();
                        goToPage(index);
                        setTimeout(startAutoPlay, 2000);
                    });
                });
                
                const prevBtn = document.querySelector('.control-prev');
                const nextBtn = document.querySelector('.control-next');
                
                prevBtn?.addEventListener('click', () => {
                    if (isTransitioning) return;
                    stopAutoPlay();
                    const prevPage = (currentPage - 1 + totalPages) % totalPages;
                    goToPage(prevPage);
                    setTimeout(startAutoPlay, 2000);
                });
                
                nextBtn?.addEventListener('click', () => {
                    if (isTransitioning) return;
                    stopAutoPlay();
                    const nextPage = (currentPage + 1) % totalPages;
                    goToPage(nextPage);
                    setTimeout(startAutoPlay, 2000);
                });
            };

            // Enhanced Vision Cards Interaction
            const setupVisionCards = () => {
                const visionCards = document.querySelectorAll('.modern-card');
                
                visionCards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        const icon = this.querySelector('.icon-box i');
                        if (icon) {
                            icon.style.transform = 'scale(1.2) rotate(5deg)';
                        }
                    });
                    
                    card.addEventListener('mouseleave', function() {
                        const icon = this.querySelector('.icon-box i');
                        if (icon) {
                            icon.style.transform = 'scale(1) rotate(0deg)';
                        }
                    });
                });
            };

            // Enhanced Form Interactions
            const setupFormAnimations = () => {
                const formControls = document.querySelectorAll('.form-control');
                
                formControls.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentNode.classList.add('focused');
                        this.style.transform = 'translateY(-2px)';
                    });
                    
                    input.addEventListener('blur', function() {
                        this.parentNode.classList.remove('focused');
                        this.style.transform = 'translateY(0)';
                    });
                });

                // Form validation with animation
                const contactForm = document.getElementById('contactForm');
                if (contactForm) {
                    contactForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const submitBtn = this.querySelector('.btn-submit');
                        
                        // Success animation
                        submitBtn.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            submitBtn.innerHTML = `<i class="fas fa-check"></i> Sent Successfully`;
                            submitBtn.style.transform = 'scale(1)';
                            submitBtn.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
                        }, 100);
                        
                        setTimeout(() => {
                            submitBtn.innerHTML = `<span>Send Message</span><div class="btn-hover-effect"></div>`;
                            submitBtn.style.background = 'linear-gradient(135deg, #6935D3 0%, #5725c0 100%)';
                            this.reset();
                        }, 3000);
                    });
                }
            };

            // Parallax effect for floating particles
            const setupParallaxEffect = () => {
                window.addEventListener('scroll', () => {
                    const scrolled = window.pageYOffset;
                    const parallaxElements = document.querySelectorAll('.floating-particle');
                    
                    parallaxElements.forEach((element, index) => {
                        const speed = 0.5 + (index * 0.1);
                        const yPos = -(scrolled * speed);
                        element.style.transform = `translate3d(0, ${yPos}px, 0)`;
                    });
                });
            };

            // Smooth scroll enhancement
            const setupSmoothScrolling = () => {
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            };

            // Performance optimization - Throttle scroll events
            const throttle = (func, limit) => {
                let inThrottle;
                return function() {
                    const args = arguments;
                    const context = this;
                    if (!inThrottle) {
                        func.apply(context, args);
                        inThrottle = true;
                        setTimeout(() => inThrottle = false, limit);
                    }
                }
            };

            // Initialize all features with proper timing
            const initializeAnimations = () => {
                // Core scroll animations
                createScrollObserver();
                
                // Interactive elements
                setupVisionCards();
                setupFormAnimations();
                setupSmoothScrolling();
                
                // Performance-optimized effects
                setupParallaxEffect();
                
                // Logo showcase with delay to ensure DOM is ready
                setTimeout(() => {
                    if (document.querySelector('.logos-rotator')) {
                        setupLogoShowcase();
                    }
                }, 1000);
                
                // Add entrance animation to header
                setTimeout(() => {
                    const header = document.querySelector('.header-title');
                    if (header) {
                        header.style.opacity = '1';
                        header.style.transform = 'translateY(0)';
                    }
                }, 500);
            };

            // Add loading state management
            const manageLoadingState = () => {
                // Add subtle loading animation
                document.body.style.opacity = '0';
                document.body.style.transition = 'opacity 0.5s ease';
                
                setTimeout(() => {
                    document.body.style.opacity = '1';
                }, 100);
            };

            // Initialize everything
            manageLoadingState();
            initializeAnimations();
            
            // Add resize handler for responsive animations
            window.addEventListener('resize', throttle(() => {
                // Recalculate animations on resize if needed
                const isMobile = window.innerWidth <= 768;
                document.documentElement.style.setProperty('--animation-duration', isMobile ? '0.4s' : '0.8s');
            }, 100));
        });
    </script>
@endsection