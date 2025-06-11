@extends('layouts.Member.master')

@section('content')
<div class="career-page">
    <!-- Hero Section yang direvisi -->
    <section class="hero-section text-white position-relative">
        <div class="hero-background">
            <img src="{{ asset('assets/img/activity.jpg') }}" alt="Career Background" class="hero-image">
            <div class="hero-overlay"></div>
            <div class="hero-pattern-overlay"></div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="hero-decorations">
            <div class="decoration-circle decoration-1"></div>
            <div class="decoration-circle decoration-2"></div>
            <div class="decoration-circle decoration-3"></div>
        </div>
        
        <div class="container position-relative">
            <div class="hero-content">
                <div class="hero-badge" data-aos="fade-down">
                    <i class="fas fa-rocket"></i>
                    <span>We're Hiring</span>
                </div>
                
                <div class="hero-main-content">
                    <h1 class="hero-main-title" data-aos="fade-up" data-aos-delay="200">
                        Be a Part of Our 
                        <span class="gradient-text">Journey</span>
                    </h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="400">
                        Join our innovative team and help shape the future of technology
                    </p>
                    
                    <!-- CTA Button -->
                    <div class="hero-actions" data-aos="fade-up" data-aos-delay="600">
                        <button class="hero-btn primary" onclick="scrollToJobs()">
                            <span>Explore Jobs</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Scroll Indicator -->
        <div class="scroll-indicator" data-aos="fade-up" data-aos-delay="800">
            <div class="scroll-mouse">
                <div class="scroll-wheel"></div>
            </div>
            <div class="scroll-text">Scroll to explore</div>
        </div>
        
        <!-- Floating Particles -->
        <div class="floating-particles">
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>
            <div class="particle particle-4"></div>
            <div class="particle particle-5"></div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <!-- Section Header -->
            <div class="section-intro" data-aos="fade-up">
                <div class="intro-badge">
                    <i class="fas fa-users"></i>
                    <span>Join Our Team</span>
                </div>
                <h2 class="intro-title">Current Job Openings</h2>
                <p class="intro-description">
                    Discover exciting career opportunities and become part of our growing team. 
                    We're looking for passionate individuals who want to make a difference.
                </p>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="custom-alert success-alert" data-aos="fade-down">
                    <div class="alert-content">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button class="alert-dismiss" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="custom-alert error-alert" data-aos="fade-down">
                    <div class="alert-content">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button class="alert-dismiss" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Filter Section -->
            <div class="filter-section" data-aos="fade-up" data-aos-delay="300">
                <div class="filter-header">
                    <h3>Browse by Category</h3>
                    <p>Find the perfect role that matches your expertise</p>
                </div>
                <div class="filter-pills">
                    <button class="filter-pill active" data-category="all">
                        <span class="pill-icon">🎯</span>
                        <span class="pill-text">All Jobs</span>
                        <span class="pill-count">{{ $positions->count() }}</span>
                    </button>
                    <button class="filter-pill" data-category="Engineering">
                        <span class="pill-icon">💻</span>
                        <span class="pill-text">Engineering</span>
                        <span class="pill-count">{{ $positions->where('category', 'Engineering')->count() }}</span>
                    </button>
                    <button class="filter-pill" data-category="Marketing">
                        <span class="pill-icon">📈</span>
                        <span class="pill-text">Marketing</span>
                        <span class="pill-count">{{ $positions->where('category', 'Marketing')->count() }}</span>
                    </button>
                    <button class="filter-pill" data-category="Design">
                        <span class="pill-icon">🎨</span>
                        <span class="pill-text">Design</span>
                        <span class="pill-count">{{ $positions->where('category', 'Design')->count() }}</span>
                    </button>
                    <button class="filter-pill" data-category="Research">
                        <span class="pill-icon">🔬</span>
                        <span class="pill-text">Research</span>
                        <span class="pill-count">{{ $positions->where('category', 'Research')->count() }}</span>
                    </button>
                </div>
            </div>

            <!-- Jobs List -->
            <div class="jobs-container">
                @if($positions->isEmpty())
                    <div class="empty-jobs" data-aos="fade-up">
                        <div class="empty-illustration">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>No Positions Available</h3>
                        <p>We don't have any open positions at the moment, but great opportunities are coming soon!</p>
                        <button class="notify-btn">
                            <i class="fas fa-bell"></i>
                            Get Notified
                        </button>
                    </div>
                @else
                    @foreach($positions as $position)
                        <div class="job-item" data-category="{{ $position->category }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <!-- Job Preview -->
                            <div class="job-preview">
                                <div class="job-header">
                                    <div class="job-main-info">
                                        <div class="job-badges">
                                            <span class="category-badge {{ strtolower($position->category) }}">
                                                {{ $position->category }}
                                            </span>
                                            <span class="type-badge">
                                                {{ $position->type ?? 'Full Time' }}
                                            </span>
                                            <span class="new-badge">New</span>
                                        </div>
                                        <h3 class="job-title">{{ $position->title }}</h3>
                                        <div class="job-meta">
                                            <div class="meta-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>{{ $position->location ?? 'Bandung, Indonesia' }}</span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-clock"></i>
                                                <span>Posted {{ $position->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-dollar-sign"></i>
                                                <span>{{ $position->salary_range ?? '10000000', 0, ',', '.' }}</span>                                            </div>
                                        </div>
                                        <p class="job-summary">
                                            {{ Str::limit(strip_tags($position->description), 150) }}
                                        </p>
                                    </div>
                                    <div class="job-actions">
                                        <button class="action-btn bookmark-btn" onclick="toggleBookmark(this)">
                                            <i class="far fa-bookmark"></i>
                                        </button>
                                        <button class="action-btn expand-btn" onclick="toggleJobDetails('{{ $position->id }}')">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="job-footer">
                                    <div class="skills-preview">
                                        <span class="skill-tag">PHP</span>
                                        <span class="skill-tag">Laravel</span>
                                        <span class="skill-tag">JavaScript</span>
                                        <span class="skill-tag more-skills">+3 more</span>
                                    </div>
                                    <button class="apply-quick-btn" onclick="scrollToApplication('{{ $position->id }}')">
                                        <span>Quick Apply</span>
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Job Details (Expandable) -->
                            <div class="job-details" id="job-details-{{ $position->id }}">
                                <div class="details-grid">
                                    <!-- Job Information -->
                                    <div class="details-column">
                                        <div class="detail-section">
                                            <div class="section-title">
                                                <i class="fas fa-info-circle"></i>
                                                <h4>Job Description</h4>
                                            </div>
                                            <div class="section-content">
                                                {!! nl2br(e($position->description)) !!}
                                            </div>
                                        </div>

                                        <div class="detail-section">
                                            <div class="section-title">
                                                <i class="fas fa-list-check"></i>
                                                <h4>Requirements</h4>
                                            </div>
                                            <div class="section-content">
                                                {!! nl2br(e($position->requirements)) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Application Form -->
                                    <div class="application-column" id="application-{{ $position->id }}">
                                        <div class="application-card">
                                            <div class="app-header">
                                                <div class="app-icon">
                                                    <i class="fas fa-rocket"></i>
                                                </div>
                                                <div class="app-info">
                                                    <h4>Apply for this Position</h4>
                                                    <p>Join our team and start your journey with us today!</p>
                                                </div>
                                            </div>

                                            <form action="{{ route('member.career.apply') }}" method="POST" enctype="multipart/form-data" class="application-form">
                                                @csrf
                                                <input type="hidden" name="position_id" value="{{ $position->id }}">
                                                
                                                <div class="form-grid">
                                                    <div class="input-group">
                                                        <label for="name-{{ $position->id }}">
                                                            <i class="fas fa-user"></i>
                                                            Full Name
                                                        </label>
                                                        <input type="text" id="name-{{ $position->id }}" name="name" placeholder="Enter your full name" required>
                                                    </div>

                                                    <div class="input-group">
                                                        <label for="email-{{ $position->id }}">
                                                            <i class="fas fa-envelope"></i>
                                                            Email Address
                                                        </label>
                                                        <input type="email" id="email-{{ $position->id }}" name="email" placeholder="Enter your email" required>
                                                    </div>

                                                    <div class="input-group full-width">
                                                        <label for="position-{{ $position->id }}">
                                                            <i class="fas fa-briefcase"></i>
                                                            Position Applied
                                                        </label>
                                                        <input type="text" id="position-{{ $position->id }}" value="{{ $position->title }}" readonly>
                                                    </div>

                                                    <div class="input-group full-width">
                                                        <label for="cv-{{ $position->id }}">
                                                            <i class="fas fa-file-pdf"></i>
                                                            Resume/CV
                                                        </label>
                                                        <div class="file-input-wrapper">
                                                            <input type="file" id="cv-{{ $position->id }}" name="cv" accept=".pdf,.doc,.docx" required>
                                                            <div class="file-input-display">
                                                                <div class="file-icon">
                                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                                </div>
                                                                <div class="file-text">
                                                                    <span class="file-label">Click to upload or drag and drop</span>
                                                                    <span class="file-hint">PDF, DOC, DOCX (Max 5MB)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <button type="button" class="btn-secondary" onclick="toggleJobDetails('{{ $position->id }}')">
                                                        <i class="fas fa-arrow-left"></i>
                                                        Back to Details
                                                    </button>
                                                    <button type="submit" class="btn-primary">
                                                        <span>Submit Application</span>
                                                        <i class="fas fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Bottom CTA - Redesigned -->
            <div class="bottom-cta" data-aos="fade-up">
                <div class="talent-community-section">
                    <div class="community-header">
                        <div class="community-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="community-content">
                            <h3>Join Our Talent Community</h3>
                            <p>Don't see the perfect role right now? Stay connected and be the first to know about new opportunities that match your skills and interests.</p>
                        </div>
                    </div>
                    
                    <div class="community-benefits">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="benefit-text">
                                <h4>Early Access</h4>
                                <p>Get notified before positions go public</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-target"></i>
                            </div>
                            <div class="benefit-text">
                                <h4>Personalized Matches</h4>
                                <p>Receive opportunities tailored to your profile</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="benefit-text">
                                <h4>Direct Connection</h4>
                                <p>Connect directly with our hiring team</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="community-form">
                        <div class="form-header">
                            <h4>Stay In Touch</h4>
                            <p>Join thousands of professionals in our talent network</p>
                        </div>
                        
                        <form class="talent-form">
                            <div class="form-row">
                                <div class="input-wrapper">
                                    <i class="fas fa-user"></i>
                                    <input type="text" placeholder="Your Name" required>
                                </div>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="input-wrapper full-width">
                                    <i class="fas fa-briefcase"></i>
                                    <select required>
                                        <option value="">Select Your Field of Interest</option>
                                        <option value="engineering">Engineering</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="design">Design</option>
                                        <option value="research">Research</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="submit-btn">
                                    <span>Join Talent Community</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                                
                                <button type="button" class="upload-cv-btn">
                                    <i class="fas fa-upload"></i>
                                    <span>Upload Resume</span>
                                </button>
                            </div>
                        </form>
                        
                        <div class="form-footer">
                            <p><i class="fas fa-shield-alt"></i> We respect your privacy. Unsubscribe anytime.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    /* Import Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    /* Variables */
    :root {
        --primary-color: #4f46e5;
        --primary-light: #6366f1;
        --primary-dark: #3730a3;
        --secondary-color: #06b6d4;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --error-color: #ef4444;
        --dark-bg: #0f172a;
        --light-bg: #f8fafc;
        --white: #ffffff;
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
        
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-base: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        
        --radius-sm: 6px;
        --radius-base: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-full: 9999px;
        
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Global Styles */
    .career-page {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.6;
        color: var(--gray-900);
        background: var(--gray-50);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* Enhanced Hero Section */
    .hero-section {
        position: relative;
        height: 100vh;
        min-height: 700px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        filter: brightness(0.4) saturate(1.2);
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, 
            rgba(79, 70, 229, 0.8) 0%, 
            rgba(99, 102, 241, 0.7) 35%, 
            rgba(6, 182, 212, 0.6) 100%
        );
    }

    .hero-pattern-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 45%),
            radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.08) 0%, transparent 45%),
            radial-gradient(circle at 50% 10%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        animation: patternShift 20s ease-in-out infinite;
    }

    @keyframes patternShift {
        0%, 100% { opacity: 1; transform: translateY(0px); }
        50% { opacity: 0.8; transform: translateY(-10px); }
    }

    /* Decorative Elements */
    .hero-decorations {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    .decoration-circle {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .decoration-1 {
        width: 120px;
        height: 120px;
        top: 15%;
        left: 10%;
        animation: float 6s ease-in-out infinite;
    }

    .decoration-2 {
        width: 80px;
        height: 80px;
        top: 60%;
        right: 15%;
        animation: float 8s ease-in-out infinite reverse;
    }

    .decoration-3 {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation: float 7s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Hero Content */
    .hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        color: white;
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        padding: 12px 24px;
        border-radius: var(--radius-full);
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 32px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        animation: badgePulse 3s ease-in-out infinite;
    }

    @keyframes badgePulse {
        0%, 100% { transform: scale(1); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); }
        50% { transform: scale(1.05); box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15); }
    }

    .hero-main-title {
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 24px;
        letter-spacing: -0.02em;
    }

    .gradient-text {
        background: linear-gradient(135deg, #60a5fa 0%, #a78bfa 50%, #06b6d4 100%);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientFlow 4s ease-in-out infinite;
    }

    @keyframes gradientFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .hero-subtitle {
        font-size: 1.375rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 40px;
        font-weight: 400;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Hero Actions */
    .hero-actions {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 48px;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 18px 36px;
        border-radius: var(--radius-full);
        font-weight: 600;
        font-size: 1.1rem;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .hero-btn.primary {
        background: rgba(255, 255, 255, 0.9);
        color: var(--primary-color);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .hero-btn.primary:hover {
        background: white;
        transform: translateY(-3px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
    }

    /* Enhanced Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        color: rgba(255, 255, 255, 0.8);
        cursor: pointer;
        z-index: 10;
        transition: var(--transition);
    }

    .scroll-indicator:hover {
        color: white;
        transform: translateX(-50%) translateY(-5px);
    }

    .scroll-mouse {
        width: 24px;
        height: 40px;
        border: 2px solid currentColor;
        border-radius: 12px;
        position: relative;
        margin-bottom: 16px;
    }

    .scroll-wheel {
        width: 3px;
        height: 8px;
        background: currentColor;
        border-radius: 2px;
        position: absolute;
        top: 8px;
        left: 50%;
        transform: translateX(-50%);
        animation: scrollWheel 2s ease-in-out infinite;
    }

    @keyframes scrollWheel {
        0%, 20% { opacity: 1; transform: translateX(-50%) translateY(0); }
        100% { opacity: 0; transform: translateX(-50%) translateY(16px); }
    }

    .scroll-text {
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    /* Floating Particles */
    .floating-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        animation: particleFloat 8s linear infinite;
    }

    .particle-1 { left: 10%; animation-delay: 0s; }
    .particle-2 { left: 20%; animation-delay: 2s; }
    .particle-3 { left: 80%; animation-delay: 4s; }
    .particle-4 { left: 70%; animation-delay: 6s; }
    .particle-5 { left: 90%; animation-delay: 1s; }

    @keyframes particleFloat {
        0% { transform: translateY(100vh) scale(0); opacity: 0; }
        10% { opacity: 1; transform: scale(1); }
        90% { opacity: 1; }
        100% { transform: translateY(-100px) scale(0); opacity: 0; }
    }

    /* Content Section */
    .content-section {
        padding: 80px 0;
        background: var(--gray-50);
        margin-top: -20px;
        border-radius: 30px 30px 0 0;
        position: relative;
        z-index: 5;
    }

    /* Keep all existing content section styles */
    
    /* Section Intro */
    .section-intro {
        text-align: center;
        margin-bottom: 60px;
    }

    .intro-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        padding: 8px 20px;
        border-radius: var(--radius-full);
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
        box-shadow: var(--shadow-md);
    }

    .intro-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 16px;
        line-height: 1.2;
    }

    .intro-description {
        font-size: 1.125rem;
        color: var(--gray-600);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Custom Alerts */
    .custom-alert {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-radius: var(--radius-md);
        margin-bottom: 24px;
        border-left: 4px solid;
    }

    .success-alert {
        background: #ecfdf5;
        border-left-color: var(--success-color);
        color: #065f46;
    }

    .error-alert {
        background: #fef2f2;
        border-left-color: var(--error-color);
        color: #991b1b;
    }

    .alert-content {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
    }

    .alert-dismiss {
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.3s;
        padding: 4px;
    }

    .alert-dismiss:hover {
        opacity: 1;
    }

    /* Filter Section */
    .filter-section {
        margin-bottom: 40px;
    }

    .filter-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .filter-header h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 8px;
    }

    .filter-header p {
        color: var(--gray-600);
        font-size: 1rem;
    }

    .filter-pills {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .filter-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-full);
        padding: 10px 20px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
        color: var(--gray-700);
    }

    .filter-pill:hover {
        border-color: var(--primary-color);
        background: #f0f9ff;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .filter-pill.active {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        border-color: var(--primary-color);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .pill-icon {
        font-size: 16px;
    }

    .pill-count {
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 8px;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
    }

    .filter-pill:not(.active) .pill-count {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    /* Jobs Container */
    .jobs-container {
        margin-bottom: 60px;
    }

    .job-item {
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-base);
        border: 1px solid var(--gray-200);
        margin-bottom: 20px;
        overflow: hidden;
        transition: var(--transition);
    }

    .job-item:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    /* Job Preview */
    .job-preview {
        padding: 24px;
    }

    .job-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .job-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 12px;
    }

    .category-badge {
        padding: 4px 12px;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .category-badge.engineering {
        background: #dbeafe;
        color: #1e40af;
    }

    .category-badge.marketing {
        background: #ecfdf5;
        color: #059669;
    }

    .category-badge.design {
        background: #fef3c7;
        color: #d97706;
    }

    .category-badge.research {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .type-badge {
        background: var(--gray-100);
        color: var(--gray-700);
        padding: 4px 12px;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 500;
    }

    .new-badge {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 4px 12px;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
    }

    .job-title {
        font-size: 1.375rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 12px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    .meta-item i {
        color: var(--primary-color);
        width: 14px;
    }

    .job-summary {
        color: var(--gray-600);
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .job-actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        width: 40px;
        height: 40px;
        border: 1px solid var(--gray-200);
        background: var(--white);
        border-radius: var(--radius-base);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        color: var(--gray-500);
    }

    .action-btn:hover {
        border-color: var(--primary-color);
        background: #f0f9ff;
        color: var(--primary-color);
    }

    .bookmark-btn.active {
        background: #fef2f2;
        border-color: var(--error-color);
        color: var(--error-color);
    }

    .expand-btn.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: rotate(180deg);
    }

    /* Job Footer */
    .job-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid var(--gray-200);
    }

    .skills-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .skill-tag {
        background: var(--gray-100);
        color: var(--gray-700);
        padding: 4px 10px;
        border-radius: var(--radius-base);
        font-size: 0.75rem;
        font-weight: 500;
    }

    .more-skills {
        background: var(--primary-color);
        color: white;
    }

    .apply-quick-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: var(--radius-base);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
    }

    .apply-quick-btn:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    /* Job Details */
    .job-details {
        background: var(--gray-50);
        border-top: 1px solid var(--gray-200);
        display: none;
    }

    .job-details.active {
        display: block;
        animation: slideDown 0.3s ease;
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

    .details-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        padding: 32px;
    }

    .detail-section {
        margin-bottom: 32px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .section-title h4 {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0;
    }

    .section-title i {
        color: var(--primary-color);
        font-size: 16px;
    }

    .section-content {
        color: var(--gray-700);
        line-height: 1.7;
        font-size: 0.9rem;
    }

    /* Application Card */
    .application-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        position: sticky;
        top: 20px;
    }

    .app-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .app-icon {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .app-info h4 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .app-info p {
        font-size: 0.875rem;
        opacity: 0.9;
        margin: 0;
    }

    /* Application Form */
    .application-form {
        padding: 24px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    .input-group {
        display: flex;
        flex-direction: column;
    }

    .input-group.full-width {
        grid-column: 1 / -1;
    }

    .input-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 8px;
        font-size: 0.875rem;
    }

    .input-group label i {
        color: var(--primary-color);
        font-size: 14px;
    }

    .input-group input[type="text"],
    .input-group input[type="email"] {
        padding: 12px 16px;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-base);
        font-size: 0.875rem;
        transition: var(--transition);
        background: var(--white);
    }

    .input-group input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .input-group input[readonly] {
        background: var(--gray-50);
        color: var(--gray-600);
    }

    /* File Input */
    .file-input-wrapper {
        position: relative;
    }

    .file-input-wrapper input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-display {
        border: 2px dashed var(--gray-300);
        border-radius: var(--radius-base);
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        background: var(--gray-50);
    }

    .file-input-display:hover {
        border-color: var(--primary-color);
        background: #f0f9ff;
    }

    .file-icon {
        margin-bottom: 8px;
    }

    .file-icon i {
        font-size: 24px;
        color: var(--primary-color);
    }

    .file-label {
        display: block;
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 4px;
        font-size: 0.875rem;
    }

    .file-hint {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
    }

    .btn-secondary {
        flex: 1;
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
        padding: 12px 20px;
        border-radius: var(--radius-base);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.875rem;
    }

    .btn-secondary:hover {
        background: var(--gray-200);
    }

    .btn-primary {
        flex: 2;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: var(--radius-base);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.875rem;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-lg);
    }

    /* Empty State */
    .empty-jobs {
        text-align: center;
        padding: 80px 40px;
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
    }

    .empty-illustration {
        width: 80px;
        height: 80px;
        background: var(--gray-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        color: var(--gray-500);
        font-size: 32px;
    }

    .empty-jobs h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 12px;
    }

    .empty-jobs p {
        color: var(--gray-600);
        margin-bottom: 32px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .notify-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--radius-base);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .notify-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* New Talent Community Section */
    .talent-community-section {
        background: linear-gradient(135deg, var(--white) 0%, #f8fafc 100%);
        border-radius: var(--radius-xl);
        padding: 48px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-200);
        position: relative;
        overflow: hidden;
    }

    .talent-community-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 20%, rgba(79, 70, 229, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(6, 182, 212, 0.03) 0%, transparent 50%);
        pointer-events: none;
    }

    .community-header {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 40px;
        position: relative;
        z-index: 2;
    }

    .community-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        box-shadow: var(--shadow-md);
        flex-shrink: 0;
    }

    .community-content h3 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 12px;
        line-height: 1.2;
    }

    .community-content p {
        color: var(--gray-600);
        font-size: 1.125rem;
        line-height: 1.6;
        margin: 0;
    }

    .community-benefits {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 48px;
        position: relative;
        z-index: 2;
    }

    .benefit-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 24px;
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }

    .benefit-item:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .benefit-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #f0f9ff, #dbeafe);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 20px;
        flex-shrink: 0;
    }

    .benefit-text h4 {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 8px;
    }

    .benefit-text p {
        color: var(--gray-600);
        font-size: 0.875rem;
        margin: 0;
        line-height: 1.5;
    }

    .community-form {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 32px;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-md);
        position: relative;
        z-index: 2;
    }

    .form-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .form-header h4 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 8px;
    }

    .form-header p {
        color: var(--gray-600);
        font-size: 1rem;
        margin: 0;
    }

    .talent-form {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrapper.full-width {
        grid-column: 1 / -1;
    }

    .input-wrapper i {
        position: absolute;
        left: 16px;
        color: var(--gray-400);
        font-size: 16px;
        z-index: 2;
    }

    .input-wrapper input,
    .input-wrapper select {
        width: 100%;
        padding: 14px 16px 14px 48px;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-base);
        font-size: 1rem;
        transition: var(--transition);
        background: var(--white);
    }

    .input-wrapper input:focus,
    .input-wrapper select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .input-wrapper input:focus + i,
    .input-wrapper select:focus + i {
        color: var(--primary-color);
    }

    .form-actions {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
    }

    .submit-btn {
        flex: 2;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        border: none;
        padding: 16px 24px;
        border-radius: var(--radius-base);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 1rem;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .upload-cv-btn {
        flex: 1;
        background: var(--white);
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
        padding: 16px 24px;
        border-radius: var(--radius-base);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 1rem;
    }

    .upload-cv-btn:hover {
        background: var(--gray-50);
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-1px);
    }

    .form-footer {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid var(--gray-200);
    }

    .form-footer p {
        color: var(--gray-500);
        font-size: 0.875rem;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .form-footer i {
        color: var(--success-color);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .details-grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }
        
        .application-card {
            position: static;
        }

        .community-header {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .community-benefits {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        
        .content-section {
            padding: 60px 0;
        }
        
        .filter-pills {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 8px;
        }
        
        .filter-pill {
            flex-shrink: 0;
        }
        
        .job-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }
        
        .job-actions {
            align-self: flex-end;
        }
        
        .job-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        
        .details-grid {
            padding: 24px;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }

        .talent-community-section {
            padding: 32px 24px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .hero-actions {
            flex-direction: column;
            gap: 16px;
        }

        .hero-btn {
            width: 100%;
            max-width: 280px;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .job-preview {
            padding: 16px;
        }
        
        .application-form {
            padding: 16px;
        }
        
        .app-header {
            padding: 16px;
        }
        
        .talent-community-section {
            padding: 24px 16px;
        }

        .community-form {
            padding: 24px 16px;
        }

        .hero-main-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.125rem;
        }

        .community-content h3 {
            font-size: 1.5rem;
        }

        .form-header h4 {
            font-size: 1.25rem;
        }

        .benefit-item {
            padding: 16px;
        }
    }

    /* AOS Animation Styles */
    [data-aos] {
        transition-duration: 0.8s;
    }

    /* Additional Enhancement Styles */
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: rippleEffect 0.6s linear;
        pointer-events: none;
    }

    @keyframes rippleEffect {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .hero-btn {
        position: relative;
        overflow: hidden;
    }

    @keyframes bookmarkPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }

    /* Enhanced particle animations */
    .particle {
        box-shadow: 0 0 6px rgba(255, 255, 255, 0.5);
    }

    /* Smooth transitions for all interactive elements */
    .filter-pill,
    .job-item,
    .hero-btn,
    .action-btn,
    .apply-quick-btn,
    .submit-btn,
    .upload-cv-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Enhanced hover states */
    .job-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Loading state for better UX */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    /* Focus states for accessibility */
    .hero-btn:focus,
    .filter-pill:focus,
    .action-btn:focus,
    .submit-btn:focus,
    .upload-cv-btn:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* Enhanced scroll to top button styles */
    .scroll-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .scroll-to-top:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
    }

    .scroll-to-top:active {
        transform: translateY(-1px) scale(1.05);
    }

    .scroll-to-top.visible {
        opacity: 1;
        visibility: visible;
    }
</style>

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 100
    });

    // Filter functionality
    const filterPills = document.querySelectorAll('.filter-pill');
    const jobItems = document.querySelectorAll('.job-item');

    filterPills.forEach(pill => {
        pill.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            
            // Update active filter
            filterPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            
            // Filter jobs
            jobItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (category === 'all' || itemCategory === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Scroll indicator click
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            document.querySelector('.content-section').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    // File upload handling
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const wrapper = this.closest('.file-input-wrapper');
            const display = wrapper.querySelector('.file-input-display');
            const label = wrapper.querySelector('.file-label');
            
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                label.textContent = fileName;
                display.style.borderColor = 'var(--success-color)';
                display.style.background = '#f0fdf4';
            }
        });
    });

    // Form submission loading state
    const forms = document.querySelectorAll('.application-form, .talent-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-primary, .submit-btn');
            if (submitBtn) {
                const originalHTML = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
                submitBtn.disabled = true;
                
                // Reset after timeout if still on page
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        submitBtn.innerHTML = originalHTML;
                        submitBtn.disabled = false;
                    }
                }, 10000);
            }
        });
    });

    // Parallax effect for hero decorations
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const decorations = document.querySelectorAll('.decoration-circle');
        
        decorations.forEach((decoration, index) => {
            const speed = 0.3 + (index * 0.1);
            const yPos = -(scrolled * speed);
            decoration.style.transform = `translateY(${yPos}px)`;
        });

        // Parallax for floating particles
        const particles = document.querySelectorAll('.particle');
        particles.forEach((particle, index) => {
            const speed = 0.2 + (index * 0.05);
            const yPos = -(scrolled * speed);
            particle.style.transform = `translateY(${yPos}px)`;
        });
    });

    // Enhanced mouse movement effects
    document.addEventListener('mousemove', function(e) {
        const heroSection = document.querySelector('.hero-section');
        if (!heroSection) return;

        const rect = heroSection.getBoundingClientRect();
        if (rect.bottom < 0 || rect.top > window.innerHeight) return;

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const deltaX = (x - centerX) / centerX;
        const deltaY = (y - centerY) / centerY;

        // Move decorative elements based on mouse position
        const decorations = document.querySelectorAll('.decoration-circle');
        decorations.forEach((decoration, index) => {
            const moveX = deltaX * (10 + index * 5);
            const moveY = deltaY * (10 + index * 5);
            decoration.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });

        // Move hero pattern overlay
        const patternOverlay = document.querySelector('.hero-pattern-overlay');
        if (patternOverlay) {
            const moveX = deltaX * 5;
            const moveY = deltaY * 5;
            patternOverlay.style.transform = `translate(${moveX}px, ${moveY}px)`;
        }
    });

    // Button ripple effect
    function createRipple(event) {
        const button = event.currentTarget;
        const circle = document.createElement('span');
        const diameter = Math.max(button.clientWidth, button.clientHeight);
        const radius = diameter / 2;

        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
        circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
        circle.classList.add('ripple');

        const ripple = button.getElementsByClassName('ripple')[0];
        if (ripple) {
            ripple.remove();
        }

        button.appendChild(circle);
    }

    // Add ripple effect to hero buttons
    const heroBtns = document.querySelectorAll('.hero-btn, .submit-btn');
    heroBtns.forEach(btn => {
        btn.addEventListener('click', createRipple);
    });

    // Smooth reveal animations for job cards
    const jobCards = document.querySelectorAll('.job-item');
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                cardObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    jobCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        cardObserver.observe(card);
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.custom-alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.parentNode) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-100%)';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }, 5000);
    });

    // Enhanced scroll to top functionality
    let scrollToTopBtn = document.createElement('button');
    scrollToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
    scrollToTopBtn.className = 'scroll-to-top';
    document.body.appendChild(scrollToTopBtn);

    // Show/hide scroll to top button
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 500) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    });

    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Talent form handling
    const talentForm = document.querySelector('.talent-form');
    if (talentForm) {
        talentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate form submission
            const submitBtn = this.querySelector('.submit-btn');
            const originalHTML = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Joining...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                // Show success message
                const successAlert = document.createElement('div');
                successAlert.className = 'custom-alert success-alert';
                successAlert.innerHTML = `
                    <div class="alert-content">
                        <i class="fas fa-check-circle"></i>
                        <span>Welcome to our talent community! We'll be in touch soon.</span>
                    </div>
                    <button class="alert-dismiss" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                const container = document.querySelector('.container');
                container.insertBefore(successAlert, container.firstChild);
                
                // Reset form
                this.reset();
                submitBtn.innerHTML = originalHTML;
                submitBtn.disabled = false;
                
                // Auto-hide success message
                setTimeout(() => {
                    if (successAlert.parentNode) {
                        successAlert.style.opacity = '0';
                        successAlert.style.transform = 'translateY(-100%)';
                        setTimeout(() => {
                            successAlert.remove();
                        }, 300);
                    }
                }, 3000);
            }, 2000);
        });
    }

    // Upload CV button functionality
    const uploadCvBtn = document.querySelector('.upload-cv-btn');
    if (uploadCvBtn) {
        uploadCvBtn.addEventListener('click', function() {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = '.pdf,.doc,.docx';
            fileInput.style.display = 'none';
            
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    uploadCvBtn.innerHTML = `
                        <i class="fas fa-check"></i>
                        <span>${fileName}</span>
                    `;
                    uploadCvBtn.style.background = '#f0fdf4';
                    uploadCvBtn.style.borderColor = 'var(--success-color)';
                    uploadCvBtn.style.color = 'var(--success-color)';
                }
            });
            
            document.body.appendChild(fileInput);
            fileInput.click();
            document.body.removeChild(fileInput);
        });
    }

    // Enhanced input focus effects
    const inputWrappers = document.querySelectorAll('.input-wrapper');
    inputWrappers.forEach(wrapper => {
        const input = wrapper.querySelector('input, select');
        const icon = wrapper.querySelector('i');
        
        if (input && icon) {
            input.addEventListener('focus', function() {
                wrapper.style.transform = 'translateY(-2px)';
                wrapper.style.boxShadow = '0 4px 12px rgba(79, 70, 229, 0.15)';
            });
            
            input.addEventListener('blur', function() {
                wrapper.style.transform = 'translateY(0)';
                wrapper.style.boxShadow = 'none';
            });
        }
    });

    // Console welcome message with current session info
    console.log(`
    🚀 Career Page Enhanced Successfully!
    
    ✨ New Features:
    • Beautiful hero section with parallax effects
    • Interactive talent community section
    • Enhanced user experience
    • Responsive design optimizations
    • Modern visual effects
    
    👤 Current User: Aliester10
    📅 Session Date: 2025-06-04 16:23:08 UTC
    🎯 Ready for applications!
    
    Enjoy the enhanced career page! 💼
    `);
});

// Global functions for button interactions
function scrollToJobs() {
    const jobsSection = document.querySelector('.content-section');
    if (jobsSection) {
        jobsSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Toggle bookmark function
function toggleBookmark(button) {
    const icon = button.querySelector('i');
    button.classList.toggle('active');
    
    if (button.classList.contains('active')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        
        // Add bookmark animation
        button.style.animation = 'bookmarkPulse 0.3s ease';
        setTimeout(() => {
            button.style.animation = '';
        }, 300);
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
    }
}

// Toggle job details function
function toggleJobDetails(positionId) {
    const jobDetails = document.getElementById(`job-details-${positionId}`);
    const expandBtn = event.target.closest('.expand-btn');
    
    // Close other open details with smooth animation
    document.querySelectorAll('.job-details.active').forEach(details => {
        if (details.id !== `job-details-${positionId}`) {
            details.style.animation = 'slideUp 0.3s ease';
            setTimeout(() => {
                details.classList.remove('active');
                details.style.animation = '';
            }, 300);
        }
    });
    
    document.querySelectorAll('.expand-btn.active').forEach(btn => {
        if (btn !== expandBtn) {
            btn.classList.remove('active');
        }
    });
    
    // Toggle current details
    if (jobDetails.classList.contains('active')) {
        jobDetails.style.animation = 'slideUp 0.3s ease';
        setTimeout(() => {
            jobDetails.classList.remove('active');
            jobDetails.style.animation = '';
        }, 300);
        expandBtn.classList.remove('active');
    } else {
        jobDetails.classList.add('active');
        expandBtn.classList.add('active');
        
        setTimeout(() => {
            jobDetails.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }, 150);
    }
}

// Scroll to application function
function scrollToApplication(positionId) {
    const jobDetails = document.getElementById(`job-details-${positionId}`);
    const applicationSection = document.getElementById(`application-${positionId}`);
    
    if (!jobDetails.classList.contains('active')) {
        toggleJobDetails(positionId);
        setTimeout(() => {
            applicationSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 400);
    } else {
        applicationSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}
</script>
@endsection