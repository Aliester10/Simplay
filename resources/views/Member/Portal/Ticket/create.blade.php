@extends('layouts.Member.master-black')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap');
    
    :root {
        --primary: #6366f1;
        --primary-light: #8b5cf6;
        --primary-dark: #4f46e5;
        --secondary: #06b6d4;
        --accent: #f59e0b;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --emerald: #059669;
        --violet: #7c3aed;
        --rose: #f43f5e;
        --teal: #14b8a6;
        
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --white: #ffffff;
        
        --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        --shadow-2xl: 0 50px 100px -20px rgb(0 0 0 / 0.25);
        
        --gradient-primary: linear-gradient(135deg, var(--primary), var(--primary-light));
        --gradient-secondary: linear-gradient(135deg, var(--secondary), #0891b2);
        --gradient-accent: linear-gradient(135deg, var(--accent), #f97316);
        --gradient-success: linear-gradient(135deg, var(--success), var(--emerald));
        --gradient-violet: linear-gradient(135deg, var(--violet), #a855f7);
        --gradient-rose: linear-gradient(135deg, var(--rose), #fb7185);
        --gradient-teal: linear-gradient(135deg, var(--teal), #0d9488);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Outfit', system-ui, -apple-system, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
        color: var(--gray-900);
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        overflow-x: hidden;
    }

    .page-wrapper {
        min-height: 100vh;
        padding-top: 5rem;
        position: relative;
    }

    /* Premium Background Effects */
    .bg-effects {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
    }

    .bg-gradient-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.3;
        animation: float-orb 20s infinite ease-in-out;
    }

    .orb-1 {
        width: 300px;
        height: 300px;
        background: var(--gradient-teal);
        top: 15%;
        right: 10%;
        animation-delay: 0s;
    }

    .orb-2 {
        width: 200px;
        height: 200px;
        background: var(--gradient-success);
        top: 65%;
        left: 15%;
        animation-delay: -10s;
    }

    .orb-3 {
        width: 150px;
        height: 150px;
        background: var(--gradient-primary);
        bottom: 15%;
        right: 60%;
        animation-delay: -5s;
    }

    @keyframes float-orb {
        0%, 100% { 
            transform: translateY(0px) translateX(0px) scale(1); 
        }
        33% { 
            transform: translateY(-30px) translateX(20px) scale(1.1); 
        }
        66% { 
            transform: translateY(20px) translateX(-15px) scale(0.9); 
        }
    }

    /* Luxury Header */
    .luxury-header {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
        margin-top: 0;
    }

    .luxury-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, 
            var(--teal), 
            var(--success), 
            var(--primary), 
            var(--accent), 
            var(--violet), 
            var(--rose)
        );
        background-size: 300% 100%;
        animation: rainbow-flow 8s linear infinite;
    }

    @keyframes rainbow-flow {
        0% { background-position: 0% 50%; }
        100% { background-position: 300% 50%; }
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .header-layout {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 4rem;
        align-items: center;
    }

    .header-content {
        max-width: 700px;
    }

    .premium-title {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 900;
        margin-bottom: 1.5rem;
        line-height: 1.1;
        letter-spacing: -0.02em;
        background: linear-gradient(135deg, 
            var(--gray-900) 0%, 
            var(--teal) 25%, 
            var(--success) 50%, 
            var(--primary) 75%, 
            var(--accent) 100%
        );
        background-size: 300% 100%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: title-flow 8s linear infinite;
    }

    @keyframes title-flow {
        0% { background-position: 0% 50%; }
        100% { background-position: 300% 50%; }
    }

    .premium-subtitle {
        font-size: 1.25rem;
        color: var(--gray-600);
        line-height: 1.7;
    }

    /* Premium Visual */
    .header-visual {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .visual-masterpiece {
        position: relative;
        width: 280px;
        height: 280px;
    }

    .visual-ring {
        position: absolute;
        border-radius: 50%;
        border: 2px solid;
        opacity: 0.3;
    }

    .ring-1 {
        width: 100%;
        height: 100%;
        border-color: var(--teal);
        animation: rotate-ring 20s linear infinite;
    }

    .ring-2 {
        width: 80%;
        height: 80%;
        top: 10%;
        left: 10%;
        border-color: var(--success);
        animation: rotate-ring 15s linear infinite reverse;
    }

    .ring-3 {
        width: 60%;
        height: 60%;
        top: 20%;
        left: 20%;
        border-color: var(--primary);
        animation: rotate-ring 25s linear infinite;
    }

    @keyframes rotate-ring {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .visual-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120px;
        height: 120px;
        background: var(--gradient-teal);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        box-shadow: var(--shadow-xl);
        animation: center-pulse 4s ease-in-out infinite;
    }

    @keyframes center-pulse {
        0%, 100% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-50%, -50%) scale(1.1); }
    }

    .visual-icons {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .floating-icon {
        position: absolute;
        width: 50px;
        height: 50px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        box-shadow: var(--shadow-lg);
        animation: float-icon 6s ease-in-out infinite;
    }

    .icon-1 {
        top: 0;
        left: 50%;
        background: var(--gradient-success);
        animation-delay: 0s;
    }

    .icon-2 {
        top: 50%;
        right: 0;
        background: var(--gradient-primary);
        animation-delay: 1.5s;
    }

    .icon-3 {
        bottom: 0;
        left: 50%;
        background: var(--gradient-accent);
        animation-delay: 3s;
    }

    .icon-4 {
        top: 50%;
        left: 0;
        background: var(--gradient-violet);
        animation-delay: 4.5s;
    }

    @keyframes float-icon {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(180deg); }
    }

    /* Premium Form Section */
    .premium-form-section {
        padding: 4rem 0 6rem;
    }

    .form-container-luxury {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .premium-form-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        padding: 3rem;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .premium-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-teal);
    }

    .form-title-luxury {
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
        text-align: center;
        background: var(--gradient-teal);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .form-subtitle-luxury {
        font-size: 1.1rem;
        color: var(--gray-600);
        text-align: center;
        margin-bottom: 3rem;
        line-height: 1.6;
    }

    .form-group-luxury {
        margin-bottom: 2.5rem;
    }

    .form-label-luxury {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .label-icon-luxury {
        width: 24px;
        height: 24px;
        background: var(--gradient-teal);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
    }

    .form-control-luxury {
        width: 100%;
        padding: 1.25rem 1.5rem;
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 1.5rem;
        font-size: 1rem;
        font-family: 'Outfit', sans-serif;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        resize: vertical;
        box-shadow: var(--shadow-sm);
    }

    .form-control-luxury:focus {
        outline: none;
        border-color: var(--teal);
        box-shadow: var(--shadow-lg);
        background: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
    }

    .form-control-luxury::placeholder {
        color: var(--gray-500);
        font-weight: 400;
    }

    select.form-control-luxury {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2314b8a6' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1rem center;
        background-repeat: no-repeat;
        background-size: 1rem;
        padding-right: 3rem;
        appearance: none;
    }

    textarea.form-control-luxury {
        min-height: 150px;
        resize: vertical;
        line-height: 1.6;
    }

    .file-input-wrapper-luxury {
        position: relative;
        overflow: hidden;
        display: block;
        width: 100%;
    }

    .file-input-luxury {
        position: absolute;
        left: -9999px;
        opacity: 0;
    }

    .file-input-label-luxury {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        width: 100%;
        padding: 2.5rem;
        border: 2px dashed rgba(20, 184, 166, 0.3);
        border-radius: 1.5rem;
        background: rgba(20, 184, 166, 0.05);
        color: var(--teal);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .file-input-label-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .file-input-label-luxury:hover::before {
        left: 100%;
    }

    .file-input-label-luxury:hover {
        border-color: var(--teal);
        background: rgba(20, 184, 166, 0.1);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .file-input-luxury:focus + .file-input-label-luxury {
        border-color: var(--teal);
        box-shadow: var(--shadow-lg);
    }

    .file-icon-luxury {
        width: 60px;
        height: 60px;
        background: var(--gradient-teal);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: var(--shadow-md);
    }

    .help-text-luxury {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-top: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(248, 250, 252, 0.8);
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.6);
    }

    .form-actions-luxury {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(226, 232, 240, 0.6);
        flex-wrap: wrap;
    }

    .btn-luxury {
        padding: 1.25rem 2.5rem;
        border-radius: 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        justify-content: center;
        min-width: 160px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .btn-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-luxury:hover::before {
        left: 100%;
    }

    .btn-primary-luxury {
        background: var(--gradient-teal);
        color: white;
        border-color: var(--teal);
    }

    .btn-primary-luxury:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        text-decoration: none;
        color: white;
    }

    .btn-secondary-luxury {
        background: rgba(148, 163, 184, 0.1);
        color: var(--gray-700);
        border-color: rgba(148, 163, 184, 0.3);
    }

    .btn-secondary-luxury:hover {
        background: rgba(148, 163, 184, 0.2);
        transform: translateY(-2px);
        text-decoration: none;
        color: var(--gray-700);
        box-shadow: var(--shadow-lg);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-wrapper {
            padding-top: 4rem;
        }
        
        .luxury-header {
            padding: 2.5rem 0;
        }
        
        .container {
            padding: 0 1rem;
        }
        
        .header-layout {
            grid-template-columns: 1fr;
            gap: 2rem;
            text-align: center;
        }
        
        .form-container-luxury {
            padding: 0 1rem;
        }
        
        .premium-form-card {
            padding: 2rem 1.5rem;
        }
        
        .visual-masterpiece {
            width: 220px;
            height: 220px;
        }
        
        .visual-center {
            width: 90px;
            height: 90px;
            font-size: 2rem;
        }
        
        .floating-icon {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .form-actions-luxury {
            flex-direction: column;
        }

        .btn-luxury {
            width: 100%;
        }
    }

    /* Advanced Animations */
    .luxury-fade-up {
        opacity: 0;
        transform: translateY(40px) scale(0.95);
        animation: luxuryFadeUp 0.8s ease forwards;
    }

    @keyframes luxuryFadeUp {
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .premium-form-card {
        animation-delay: 0.1s;
    }
</style>

<div class="page-wrapper">
    <!-- Premium Background Effects -->
    <div class="bg-effects">
        <div class="bg-gradient-orb orb-1"></div>
        <div class="bg-gradient-orb orb-2"></div>
        <div class="bg-gradient-orb orb-3"></div>
    </div>

    <!-- Luxury Header -->
    <div class="luxury-header">
        <div class="container">
            <div class="header-layout">
                <div class="header-content">
                    <h1 class="premium-title">{{ __('messages.title') }}</h1>
                    <p class="premium-subtitle">
                        {{ __('messages.description_ticket') }}
                    </p>
                </div>
                
                <div class="header-visual">
                    <div class="visual-masterpiece">
                        <div class="visual-ring ring-1"></div>
                        <div class="visual-ring ring-2"></div>
                        <div class="visual-ring ring-3"></div>
                        
                        <div class="visual-center">
                            <i class='bx bx-plus'></i>
                        </div>
                        
                        <div class="visual-icons">
                            <div class="floating-icon icon-1">
                                <i class='bx bx-cog'></i>
                            </div>
                            <div class="floating-icon icon-2">
                                <i class='bx bx-detail'></i>
                            </div>
                            <div class="floating-icon icon-3">
                                <i class='bx bx-paperclip'></i>
                            </div>
                            <div class="floating-icon icon-4">
                                <i class='bx bx-paper-plane'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Form Section -->
    <div class="premium-form-section">
        <div class="form-container-luxury">
            <div class="premium-form-card luxury-fade-up">
                <h2 class="form-title-luxury">Create Support Ticket</h2>
                <p class="form-subtitle-luxury">
                    Submit your support request with detailed information to help us provide the best assistance possible.
                </p>
                
                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Service Type -->
                    <div class="form-group-luxury">
                        <label for="jenis_layanan" class="form-label-luxury">
                            <div class="label-icon-luxury">
                                <i class='bx bx-cog'></i>
                            </div>
                            {{ __('messages.service_type') }}
                        </label>
                        <select name="jenis_layanan" id="jenis_layanan" class="form-control-luxury" required>
                            <option value="">Select service type...</option>
                            <option value="Permintaan Data">{{ __('messages.service_type') }} 1 - Data Request</option>
                            <option value="Maintanance">{{ __('messages.service_type') }} 2 - Maintenance</option>
                            <option value="Visit">{{ __('messages.service_type') }} 3 - Site Visit</option>
                            <option value="Installasi">{{ __('messages.service_type') }} 4 - Installation</option>
                        </select>
                        <div class="help-text-luxury">
                            <i class='bx bx-info-circle'></i>
                            <span>Choose the type of service you need assistance with</span>
                        </div>
                    </div>

                    <!-- Service Description -->
                    <div class="form-group-luxury">
                        <label for="keterangan_layanan" class="form-label-luxury">
                            <div class="label-icon-luxury">
                                <i class='bx bx-detail'></i>
                            </div>
                            {{ __('messages.service_description') }}
                        </label>
                        <textarea name="keterangan_layanan" 
                                  id="keterangan_layanan" 
                                  class="form-control-luxury" 
                                  rows="5"
                                  placeholder="Please describe your issue or request in detail..."
                                  required></textarea>
                        <div class="help-text-luxury">
                            <i class='bx bx-info-circle'></i>
                            <span>Provide as much detail as possible to help us understand your request</span>
                        </div>
                    </div>

                    <!-- Supporting Documents -->
                    <div class="form-group-luxury">
                        <label for="file_pendukung_layanan" class="form-label-luxury">
                            <div class="label-icon-luxury">
                                <i class='bx bx-paperclip'></i>
                            </div>
                            {{ __('messages.supporting_documents') }}
                        </label>
                        <div class="file-input-wrapper-luxury">
                            <input type="file" 
                                   name="file_pendukung_layanan" 
                                   id="file_pendukung_layanan" 
                                   class="file-input-luxury"
                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <label for="file_pendukung_layanan" class="file-input-label-luxury">
                                <div class="file-icon-luxury">
                                    <i class='bx bx-cloud-upload'></i>
                                </div>
                                <span>Click to upload file or drag and drop</span>
                                <small>Maximum file size: 10MB</small>
                            </label>
                        </div>
                        <div class="help-text-luxury">
                            <i class='bx bx-info-circle'></i>
                            <span>Supported formats: PDF, DOC, DOCX, JPG, PNG (Max: 10MB)</span>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions-luxury">
                        <a href="{{ route('tickets.index') }}" class="btn-luxury btn-secondary-luxury">
                            <i class='bx bx-arrow-left'></i>
                            <span>{{ __('messages.cancel') }}</span>
                        </a>
                        <button type="submit" class="btn-luxury btn-primary-luxury">
                            <i class='bx bx-paper-plane'></i>
                            <span>{{ __('messages.submit') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Advanced intersection observer for luxury animations
    const luxuryObserverOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -80px 0px'
    };

    const luxuryObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                luxuryObserver.unobserve(entry.target);
            }
        });
    }, luxuryObserverOptions);

    // Observe luxury animated elements
    document.querySelectorAll('.luxury-fade-up').forEach(el => {
        el.style.animationPlayState = 'paused';
        luxuryObserver.observe(el);
    });

    // Enhanced file input functionality
    const fileInput = document.getElementById('file_pendukung_layanan');
    const fileLabel = document.querySelector('.file-input-label-luxury span');
    const fileIcon = document.querySelector('.file-icon-luxury i');

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
            fileLabel.innerHTML = `Selected: ${fileName} (${fileSize}MB)`;
            fileIcon.className = 'bx bx-check';
            
            // Add success animation
            const label = document.querySelector('.file-input-label-luxury');
            label.style.borderColor = 'var(--success)';
            label.style.background = 'rgba(16, 185, 129, 0.1)';
            label.style.color = 'var(--success)';
        } else {
            fileLabel.textContent = 'Click to upload file or drag and drop';
            fileIcon.className = 'bx bx-cloud-upload';
        }
    });

    // Enhanced form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const serviceType = document.getElementById('jenis_layanan');
        const description = document.getElementById('keterangan_layanan');
        
        if (!serviceType.value) {
            e.preventDefault();
            serviceType.focus();
            serviceType.style.borderColor = 'var(--danger)';
            setTimeout(() => {
                serviceType.style.borderColor = '';
            }, 3000);
            alert('Please select a service type.');
            return false;
        }
        
        if (!description.value.trim()) {
            e.preventDefault();
            description.focus();
            description.style.borderColor = 'var(--danger)';
            setTimeout(() => {
                description.style.borderColor = '';
            }, 3000);
            alert('Please provide a service description.');
            return false;
        }
        
        if (description.value.trim().length < 10) {
            e.preventDefault();
            description.focus();
            description.style.borderColor = 'var(--danger)';
            setTimeout(() => {
                description.style.borderColor = '';
            }, 3000);
            alert('Please provide a more detailed description (at least 10 characters).');
            return false;
        }

        // Show loading state
        const submitBtn = document.querySelector('.btn-primary-luxury');
        const originalHTML = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> <span>Submitting...</span>';
        submitBtn.disabled = true;
    });

    // Auto-resize textarea with animation
    const textarea = document.getElementById('keterangan_layanan');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.max(150, this.scrollHeight) + 'px';
    });

    // Premium button interactions with ripple effect
    document.querySelectorAll('.btn-luxury').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Create luxury ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.6)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'luxuryRipple 0.8s linear';
            ripple.style.pointerEvents = 'none';
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 800);
        });
    });

    // Add luxury ripple animation CSS
    const luxuryStyle = document.createElement('style');
    luxuryStyle.textContent = `
        @keyframes luxuryRipple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(luxuryStyle);

    // Premium parallax effect for background orbs
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const orbs = document.querySelectorAll('.bg-gradient-orb');
        
        orbs.forEach((orb, index) => {
            const speed = (index + 1) * 0.3;
            orb.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
        });
    });

    // Enhanced form field interactions
    document.querySelectorAll('.form-control-luxury').forEach(field => {
        field.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        field.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection