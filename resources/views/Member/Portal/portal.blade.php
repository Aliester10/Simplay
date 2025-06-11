@extends('layouts.Member.master-black')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap');
    
    :root {
        --primary-50: #eff6ff;
        --primary-100: #dbeafe;
        --primary-500: #3b82f6;
        --primary-600: #2563eb;
        --primary-700: #1d4ed8;
        
        --emerald-50: #ecfdf5;
        --emerald-500: #10b981;
        --emerald-600: #059669;
        
        --purple-50: #faf5ff;
        --purple-500: #a855f7;
        --purple-600: #9333ea;
        
        --orange-50: #fff7ed;
        --orange-500: #f97316;
        --orange-600: #ea580c;
        
        --pink-50: #fdf2f8;
        --pink-500: #ec4899;
        --pink-600: #db2777;
        
        --teal-50: #f0fdfa;
        --teal-500: #14b8a6;
        --teal-600: #0d9488;
        
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        
        --white: #ffffff;
        --surface: #fefefe;
        
        --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        
        --radius-sm: 6px;
        --radius-md: 8px;
        --radius-lg: 12px;
        --radius-xl: 16px;
        --radius-2xl: 20px;
        --radius-3xl: 24px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        background: var(--gray-50);
        color: var(--gray-900);
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .page-wrapper {
        min-height: 100vh;
        background: 
            linear-gradient(135deg, rgba(59, 130, 246, 0.02) 0%, transparent 30%),
            linear-gradient(225deg, rgba(168, 85, 247, 0.02) 0%, transparent 30%),
            var(--gray-50);
        padding-top: 2.5rem; /* Updated to 2.5rem */
    }

    /* Hero Section */
    .hero-section {
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        padding: 64px 0;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.04) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.04) 0%, transparent 50%);
        pointer-events: none;
    }

    .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        position: relative;
        z-index: 2;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .hero-content {
        max-width: 500px;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 20px;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .hero-description {
        font-size: 18px;
        color: var(--gray-600);
        margin-bottom: 32px;
        line-height: 1.7;
    }

    .hero-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--gray-500);
    }

    .hero-breadcrumb a {
        color: var(--primary-600);
        text-decoration: none;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: var(--radius-md);
        background: var(--gray-100);
        border: 1px solid var(--gray-200);
        transition: all 0.2s ease;
    }

    .hero-breadcrumb a:hover {
        background: var(--primary-50);
        border-color: var(--primary-200);
    }

    .hero-visual {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .visual-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        transform: perspective(800px) rotateY(-10deg) rotateX(5deg);
    }

    .visual-card {
        width: 80px;
        height: 100px;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        background: var(--white);
        box-shadow: var(--shadow-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--white);
        position: relative;
        overflow: hidden;
    }

    .visual-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        opacity: 0.9;
    }

    .visual-card:nth-child(1)::before { background: linear-gradient(135deg, var(--primary-500), var(--primary-600)); }
    .visual-card:nth-child(2)::before { background: linear-gradient(135deg, var(--emerald-500), var(--emerald-600)); }
    .visual-card:nth-child(3)::before { background: linear-gradient(135deg, var(--orange-500), var(--orange-600)); }
    .visual-card:nth-child(4)::before { background: linear-gradient(135deg, var(--purple-500), var(--purple-600)); }
    .visual-card:nth-child(5)::before { background: linear-gradient(135deg, var(--pink-500), var(--pink-600)); }
    .visual-card:nth-child(6)::before { background: linear-gradient(135deg, var(--teal-500), var(--teal-600)); }

    .visual-card i {
        position: relative;
        z-index: 2;
        animation: float 3s ease-in-out infinite;
    }

    .visual-card:nth-child(1) { animation-delay: 0s; }
    .visual-card:nth-child(2) { animation-delay: 0.5s; }
    .visual-card:nth-child(3) { animation-delay: 1s; }
    .visual-card:nth-child(4) { animation-delay: 1.5s; }
    .visual-card:nth-child(5) { animation-delay: 2s; }
    .visual-card:nth-child(6) { animation-delay: 2.5s; }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    /* Services Section */
    .services-section {
        padding: 80px 0;
    }

    .services-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .services-header {
        text-align: center;
        margin-bottom: 56px;
    }

    .services-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 16px;
    }

    .services-description {
        font-size: 18px;
        color: var(--gray-600);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Masonry Grid */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
        gap: 24px;
        grid-auto-rows: min-content;
    }

    .service-item {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-3xl);
        padding: 28px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .service-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--primary-500);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .service-item:hover::before {
        transform: scaleX(1);
    }

    .service-item:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-xl);
        border-color: var(--gray-300);
    }

    .service-item:nth-child(1)::before { background: var(--primary-500); }
    .service-item:nth-child(2)::before { background: var(--emerald-500); }
    .service-item:nth-child(3)::before { background: var(--orange-500); }
    .service-item:nth-child(4)::before { background: var(--purple-500); }
    .service-item:nth-child(5)::before { background: var(--pink-500); }
    .service-item:nth-child(6)::before { background: var(--teal-500); }

    .service-top {
        margin-bottom: 20px;
    }

    .service-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: var(--white);
        margin-bottom: 16px;
        box-shadow: var(--shadow-md);
    }

    .service-item:nth-child(1) .service-icon { background: linear-gradient(135deg, var(--primary-500), var(--primary-600)); }
    .service-item:nth-child(2) .service-icon { background: linear-gradient(135deg, var(--emerald-500), var(--emerald-600)); }
    .service-item:nth-child(3) .service-icon { background: linear-gradient(135deg, var(--orange-500), var(--orange-600)); }
    .service-item:nth-child(4) .service-icon { background: linear-gradient(135deg, var(--purple-500), var(--purple-600)); }
    .service-item:nth-child(5) .service-icon { background: linear-gradient(135deg, var(--pink-500), var(--pink-600)); }
    .service-item:nth-child(6) .service-icon { background: linear-gradient(135deg, var(--teal-500), var(--teal-600)); }

    .service-header h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 6px;
    }

    .service-category {
        font-size: 13px;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        background: var(--gray-100);
        padding: 4px 8px;
        border-radius: var(--radius-sm);
        display: inline-block;
    }

    .service-description {
        font-size: 15px;
        color: var(--gray-600);
        line-height: 1.7;
        margin: 20px 0;
        flex-grow: 1;
    }

    .service-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 20px;
    }

    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-600);
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .service-item:nth-child(1) .service-link { color: var(--primary-600); }
    .service-item:nth-child(2) .service-link { color: var(--emerald-600); }
    .service-item:nth-child(3) .service-link { color: var(--orange-600); }
    .service-item:nth-child(4) .service-link { color: var(--purple-600); }
    .service-item:nth-child(5) .service-link { color: var(--pink-600); }
    .service-item:nth-child(6) .service-link { color: var(--teal-600); }

    .service-link:hover {
        transform: translateX(3px);
    }

    .service-link i {
        transition: transform 0.2s ease;
    }

    .service-link:hover i {
        transform: translateX(2px);
    }

    .service-badge {
        font-size: 12px;
        color: var(--gray-500);
        background: var(--gray-100);
        padding: 4px 8px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200);
        font-family: 'JetBrains Mono', monospace;
    }

    /* Dashboard Preview */
    .dashboard-preview {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-3xl);
        padding: 32px;
        margin-top: 60px;
        box-shadow: var(--shadow-sm);
    }

    .preview-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .preview-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 8px;
    }

    .preview-subtitle {
        font-size: 16px;
        color: var(--gray-600);
    }

    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 24px;
    }

    .metric-card {
        text-align: center;
        padding: 20px;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
    }

    .metric-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--gray-900);
        font-family: 'JetBrains Mono', monospace;
        margin-bottom: 8px;
        display: block;
    }

    .metric-label {
        font-size: 14px;
        color: var(--gray-600);
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-wrapper {
            padding-top: 1.5rem; /* Adjusted for mobile */
        }
        
        .hero-grid {
            grid-template-columns: 1fr;
            gap: 40px;
            text-align: center;
        }
        
        .hero-section {
            padding: 48px 0;
        }
        
        .services-section {
            padding: 60px 0;
        }
        
        .hero-container,
        .services-container {
            padding: 0 16px;
        }
        
        .services-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .service-item {
            padding: 24px;
        }
        
        .visual-grid {
            transform: none;
        }
        
        .metrics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .service-bottom {
            flex-direction: column;
            gap: 12px;
            align-items: stretch;
        }
        
        .service-link {
            justify-content: center;
        }
        
        .metrics-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Animations */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 0.6s ease forwards;
    }

    .service-item:nth-child(1) { animation-delay: 0.1s; }
    .service-item:nth-child(2) { animation-delay: 0.15s; }
    .service-item:nth-child(3) { animation-delay: 0.2s; }
    .service-item:nth-child(4) { animation-delay: 0.25s; }
    .service-item:nth-child(5) { animation-delay: 0.3s; }
    .service-item:nth-child(6) { animation-delay: 0.35s; }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="page-wrapper">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-container">
            <div class="hero-grid">
                <div class="hero-content">
                    <h1 class="hero-title">{{ __('messages.portal_member') }}</h1>
                    <p class="hero-description">
                        Platform terpadu untuk mengakses semua layanan digital dengan pengalaman yang seamless, modern, dan efisien untuk produktivitas maksimal.
                    </p>
                    
                    <div class="hero-breadcrumb">
                        <a href="{{ url('/') }}">{{ __('messages.home') }}</a>
                        <span>•</span>
                        <span>{{ __('messages.portal_member') }}</span>
                    </div>
                </div>
                
                <div class="hero-visual">
                    <div class="visual-grid">
                        <div class="visual-card">
                            <i class='bx bx-package'></i>
                        </div>
                        <div class="visual-card">
                            <i class='bx bx-book'></i>
                        </div>
                        <div class="visual-card">
                            <i class='bx bx-file'></i>
                        </div>
                        <div class="visual-card">
                            <i class='bx bx-video'></i>
                        </div>
                        <div class="visual-card">
                            <i class='bx bx-help-circle'></i>
                        </div>
                        <div class="visual-card">
                            <i class='bx bx-receipt'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section">
        <div class="services-container">
            <div class="services-header">
                <h2 class="services-title">Layanan Digital Terintegrasi</h2>
                <p class="services-description">
                    Jelajahi koleksi lengkap layanan digital yang dirancang untuk memenuhi kebutuhan produktivitas dan efisiensi Anda
                </p>
            </div>

            <div class="services-grid">
                <!-- My Product -->
                <div class="service-item fade-in">
                    <div class="service-top">
                        <div class="service-icon">
                            <i class='bx bx-package'></i>
                        </div>
                        <div class="service-header">
                            <h3>{{ __('messages.my_product') }}</h3>
                            <span class="service-category">Product Management</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Kelola dan monitor seluruh portfolio produk digital Anda dengan dashboard analytics yang komprehensif, real-time insights, dan tools optimasi untuk performa maksimal yang dapat diakses kapan saja.
                    </p>
                    <div class="service-bottom">
                        <a href="{{ route('portal.user-product') }}" class="service-link">
                            <span>Kelola Produk</span>
                            <i class='bx bx-arrow-right'></i>
                        </a>
                        <span class="service-badge">ACTIVE</span>
                    </div>
                </div>

                <!-- User Manual -->
                <div class="service-item fade-in">
                    <div class="service-top">
                        <div class="service-icon">
                            <i class='bx bx-book'></i>
                        </div>
                        <div class="service-header">
                            <h3>{{ __('messages.user_manual') }}</h3>
                            <span class="service-category">Documentation Hub</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Akses dokumentasi lengkap dengan search engine canggih, bookmark personal, panduan step-by-step, dan tutorial interaktif untuk memaksimalkan penggunaan platform.
                    </p>
                    <div class="service-bottom">
                        <a href="{{ route('portal.instructions') }}" class="service-link">
                            <span>Baca Panduan</span>
                            <i class='bx bx-arrow-right'></i>
                        </a>
                        <span class="service-badge">UPDATED</span>
                    </div>
                </div>

                <!-- Document -->
                <div class="service-item fade-in">
                    <div class="service-top">
                        <div class="service-icon">
                            <i class='bx bx-file'></i>
                        </div>
                        <div class="service-header">
                            <h3>{{ __('messages.document') }}</h3>
                            <span class="service-category">File Storage</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Pusat dokumen dengan kategorisasi otomatis, version control yang robust, sharing capabilities, dan sistem pencarian untuk kolaborasi tim yang efektif dan terorganisir.
                    </p>
                    <div class="service-bottom">
                        <a href="{{ route('portal.document') }}" class="service-link">
                            <span>Akses Dokumen</span>
                            <i class='bx bx-arrow-right'></i>
                        </a>
                        <span class="service-badge">SYNCED</span>
                    </div>
                </div>

                <!-- Tutorials -->
                <div class="service-item fade-in">
                    <div class="service-top">
                        <div class="service-icon">
                            <i class='bx bx-video'></i>
                        </div>
                        <div class="service-header">
                            <h3>{{ __('messages.tutorials') }}</h3>
                            <span class="service-category">Learning Center</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Video pembelajaran interaktif dengan progress tracking, quiz terintegrasi, sertifikat completion, dan learning path yang dipersonalisasi untuk skill development optimal.
                    </p>
                    <div class="service-bottom">
                        <a href="{{ route('portal.tutorials') }}" class="service-link">
                            <span>Mulai Belajar</span>
                            <i class='bx bx-arrow-right'></i>
                        </a>
                        <span class="service-badge">NEW</span>
                    </div>
                </div>

                <!-- Q&A -->
                <div class="service-item fade-in">
                    <div class="service-top">
                        <div class="service-icon">
                            <i class='bx bx-help-circle'></i>
                        </div>
                        <div class="service-header">
                            <h3>{{ __('messages.qna') }}</h3>
                            <span class="service-category">Knowledge Base</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Sistem tanya jawab dengan AI-powered search, komunitas expert, database solusi lengkap, dan sistem rating untuk mendapatkan jawaban yang akurat dan cepat.
                    </p>
                    <div class="service-bottom">
                        <a href="{{ route('portal.qna') }}" class="service-link">
                            <span>Cari Jawaban</span>
                            <i class='bx bx-arrow-right'></i>
                        </a>
                        <span class="service-badge">LIVE</span>
                    </div>
                </div>

                <!-- Ticketing -->
                <div class="service-item fade-in">
                    <div class="service-top">
                        <div class="service-icon">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <div class="service-header">
                            <h3>Support Ticketing</h3>
                            <span class="service-category">Technical Support</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Sistem dukungan teknis profesional dengan SLA tracking, escalation otomatis, komunikasi real-time, dan dashboard analytics untuk resolusi yang efisien.
                    </p>
                    <div class="service-bottom">
                        <a href="{{ route('tickets.index') }}" class="service-link">
                            <span>Buat Tiket</span>
                            <i class='bx bx-arrow-right'></i>
                        </a>
                        <span class="service-badge">24/7</span>
                    </div>
                </div>
            </div>

            <!-- Dashboard Preview -->
            <div class="dashboard-preview">
                <div class="preview-header">
                    <h3 class="preview-title">Platform Metrics</h3>
                    <p class="preview-subtitle">Overview performa dan statistik platform secara real-time</p>
                </div>
                <div class="metrics-grid">
                    <div class="metric-card">
                        <span class="metric-value">06</span>
                        <span class="metric-label">Total Services</span>
                    </div>
                    <div class="metric-card">
                        <span class="metric-value">24/7</span>
                        <span class="metric-label">Support Available</span>
                    </div>
                    <div class="metric-card">
                        <span class="metric-value">99.9%</span>
                        <span class="metric-label">Platform Uptime</span>
                    </div>
                    <div class="metric-card">
                        <span class="metric-value">∞</span>
                        <span class="metric-label">Possibilities</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe fade-in elements
document.querySelectorAll('.fade-in').forEach(element => {
    element.style.animationPlayState = 'paused';
    observer.observe(element);
});

// Enhanced service card interactions
document.querySelectorAll('.service-item').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px) scale(1.01)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});

// Visual cards floating animation
document.querySelectorAll('.visual-card').forEach((card, index) => {
    card.style.animationDelay = `${index * 0.5}s`;
});

// Smooth scrolling
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

// Metrics counter animation
function animateMetrics() {
    const metrics = document.querySelectorAll('.metric-value');
    metrics.forEach(metric => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const finalValue = entry.target.textContent;
                    
                    // Skip animation for non-numeric values
                    if (finalValue.includes('/') || finalValue.includes('%') || finalValue === '∞') {
                        return;
                    }
                    
                    const numericValue = parseInt(finalValue);
                    if (!isNaN(numericValue) && numericValue <= 100) {
                        let currentValue = 0;
                        const increment = Math.ceil(numericValue / 20);
                        const timer = setInterval(() => {
                            currentValue += increment;
                            if (currentValue >= numericValue) {
                                currentValue = numericValue;
                                clearInterval(timer);
                            }
                            entry.target.textContent = currentValue.toString().padStart(2, '0');
                        }, 100);
                    }
                    observer.unobserve(entry.target);
                }
            });
        });
        observer.observe(metric);
    });
}

// Initialize metrics animation
animateMetrics();
</script>
@endsection