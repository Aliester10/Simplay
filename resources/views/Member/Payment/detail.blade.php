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
        --gradient-warning: linear-gradient(135deg, var(--warning), #f97316);
        --gradient-danger: linear-gradient(135deg, var(--danger), #dc2626);
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
        background: var(--gradient-primary);
        top: 15%;
        right: 10%;
        animation-delay: 0s;
    }

    .orb-2 {
        width: 200px;
        height: 200px;
        background: var(--gradient-accent);
        top: 65%;
        left: 15%;
        animation-delay: -10s;
    }

    .orb-3 {
        width: 150px;
        height: 150px;
        background: var(--gradient-violet);
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
        padding: 3rem 0;
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
            var(--accent), 
            var(--primary), 
            var(--violet), 
            var(--rose), 
            var(--secondary), 
            var(--success)
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
        gap: 2rem;
        align-items: center;
    }

    .header-content {
        max-width: 700px;
    }

    .premium-title {
        font-size: clamp(1.75rem, 3.5vw, 2.75rem);
        font-weight: 900;
        margin-bottom: 0.75rem;
        line-height: 1.1;
        letter-spacing: -0.02em;
        background: linear-gradient(135deg, 
            var(--gray-900) 0%, 
            var(--primary) 25%, 
            var(--accent) 50%, 
            var(--violet) 75%, 
            var(--rose) 100%
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
        font-size: 1rem;
        color: var(--gray-600);
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    .breadcrumb-luxury {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--gray-500);
    }

    .breadcrumb-luxury a {
        color: var(--primary);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-luxury a:hover {
        color: var(--accent);
    }

    .breadcrumb-separator {
        color: var(--gray-400);
    }

    /* Back Button */
    .btn-back-luxury {
        padding: 0.75rem 1.5rem;
        border-radius: 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        background: rgba(148, 163, 184, 0.1);
        color: var(--gray-700);
        border: 2px solid rgba(148, 163, 184, 0.2);
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow);
    }

    .btn-back-luxury:hover {
        background: var(--gradient-secondary);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        text-decoration: none;
    }

    /* Luxury Cards */
    .luxury-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .luxury-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .luxury-card:hover::before {
        transform: scaleX(1);
    }

    .luxury-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        border-color: rgba(99, 102, 241, 0.3);
    }

    .luxury-card:nth-child(2)::before { background: var(--gradient-accent); }
    .luxury-card:nth-child(3)::before { background: var(--gradient-violet); }
    .luxury-card:nth-child(4)::before { background: var(--gradient-success); }

    .card-header-luxury {
        padding: 2rem;
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        background: rgba(248, 250, 252, 0.8);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title-luxury {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
    }

    .card-body-luxury {
        padding: 2rem;
    }

    /* Premium Table */
    .table-luxury {
        width: 100%;
        border-collapse: collapse;
        background: transparent;
    }

    .table-luxury tr {
        border-bottom: 1px solid rgba(226, 232, 240, 0.4);
        transition: all 0.3s ease;
    }

    .table-luxury tr:hover {
        background: rgba(99, 102, 241, 0.05);
    }

    .table-luxury td {
        padding: 1rem 0;
        vertical-align: top;
    }

    .table-luxury td:first-child {
        font-weight: 600;
        color: var(--gray-700);
        width: 150px;
    }

    .table-luxury td:last-child {
        color: var(--gray-900);
    }

    /* Status Badges */
    .badge-luxury {
        padding: 0.75rem 1.25rem;
        border-radius: 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
    }

    .badge-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .badge-luxury:hover::before {
        left: 100%;
    }

    .badge-warning-luxury { background: var(--gradient-warning); }
    .badge-success-luxury { background: var(--gradient-success); }
    .badge-danger-luxury { background: var(--gradient-danger); }
    .badge-info-luxury { background: var(--gradient-primary); }

    /* Alert Messages */
    .alert-luxury {
        padding: 1.5rem;
        border-radius: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .alert-luxury::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: currentColor;
    }

    .alert-success-luxury {
        background: rgba(16, 185, 129, 0.1);
        border-color: rgba(16, 185, 129, 0.3);
        color: var(--success);
    }

    .alert-danger-luxury {
        background: rgba(239, 68, 68, 0.1);
        border-color: rgba(239, 68, 68, 0.3);
        color: var(--danger);
    }

    .alert-info-luxury {
        background: rgba(99, 102, 241, 0.1);
        border-color: rgba(99, 102, 241, 0.3);
        color: var(--primary);
    }

    .alert-warning-luxury {
        background: rgba(245, 158, 11, 0.1);
        border-color: rgba(245, 158, 11, 0.3);
        color: var(--warning);
    }

    .alert-secondary-luxury {
        background: rgba(148, 163, 184, 0.1);
        border-color: rgba(148, 163, 184, 0.3);
        color: var(--gray-600);
    }

    .alert-title-luxury {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Premium Timeline */
    .timeline-luxury {
        position: relative;
        padding-left: 2rem;
    }

    .timeline-luxury::before {
        content: '';
        position: absolute;
        left: 1rem;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        border-radius: 2px;
    }

    .timeline-step-luxury {
        position: relative;
        margin-bottom: 2.5rem;
        padding-left: 2rem;
    }

    .timeline-step-luxury:last-child {
        margin-bottom: 0;
    }

    .timeline-marker-luxury {
        position: absolute;
        left: -1.25rem;
        top: 0.25rem;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        border: 4px solid white;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        z-index: 2;
    }

    .timeline-step-luxury.completed .timeline-marker-luxury {
        transform: scale(1.1);
        animation: pulse-marker 2s infinite;
    }

    .timeline-step-luxury.pending .timeline-marker-luxury {
        background: var(--gray-400);
        opacity: 0.6;
    }

    @keyframes pulse-marker {
        0%, 100% { transform: scale(1.1); }
        50% { transform: scale(1.2); box-shadow: var(--shadow-lg); }
    }

    .timeline-content-luxury {
        background: rgba(248, 250, 252, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 1.5rem;
        padding: 1.5rem;
        position: relative;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .timeline-content-luxury:hover {
        background: rgba(255, 255, 255, 0.9);
        border-color: var(--primary);
        transform: translateX(5px);
    }

    .timeline-title-luxury {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .timeline-description-luxury {
        color: var(--gray-600);
        margin-bottom: 0.75rem;
        line-height: 1.6;
    }

    .timeline-date-luxury {
        font-size: 0.875rem;
        color: var(--gray-500);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'JetBrains Mono', monospace;
    }

    /* Action Buttons */
    .btn-action-luxury {
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        margin-bottom: 0.75rem;
        position: relative;
        overflow: hidden;
    }

    .btn-action-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-action-luxury:hover::before {
        left: 100%;
    }

    .btn-primary-luxury {
        background: var(--gradient-primary);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-warning-luxury {
        background: var(--gradient-warning);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-danger-luxury {
        background: var(--gradient-danger);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-success-luxury {
        background: var(--gradient-success);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-secondary-luxury {
        background: rgba(148, 163, 184, 0.1);
        color: var(--gray-700);
        border: 2px solid rgba(148, 163, 184, 0.2);
        box-shadow: var(--shadow);
    }

    .btn-action-luxury:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        color: white;
        text-decoration: none;
    }

    .btn-secondary-luxury:hover {
        background: var(--gradient-secondary);
        border-color: transparent;
    }

    /* Payment Proof Image */
    .payment-proof-container {
        position: relative;
        text-align: center;
    }

    .payment-proof-image {
        max-height: 350px;
        max-width: 100%;
        border-radius: 1.5rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(226, 232, 240, 0.6);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .payment-proof-image:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-xl);
    }

    /* Empty State */
    .empty-state-luxury {
        text-align: center;
        padding: 3rem 2rem;
        background: rgba(248, 250, 252, 0.8);
        border-radius: 1.5rem;
        border: 2px dashed rgba(226, 232, 240, 0.6);
    }

    .empty-icon-luxury {
        width: 100px;
        height: 100px;
        background: var(--gradient-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: white;
        box-shadow: var(--shadow-lg);
        animation: float-icon 3s ease-in-out infinite;
    }

    @keyframes float-icon {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .empty-title-luxury {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .empty-description-luxury {
        color: var(--gray-600);
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    /* Status Indicator */
    .status-indicator-luxury {
        text-align: center;
        padding: 2rem;
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .status-indicator-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.1;
        border-radius: 1.5rem;
    }

    .status-success {
        background: rgba(16, 185, 129, 0.1);
        border: 2px solid rgba(16, 185, 129, 0.3);
        color: var(--success);
    }

    .status-warning {
        background: rgba(245, 158, 11, 0.1);
        border: 2px solid rgba(245, 158, 11, 0.3);
        color: var(--warning);
    }

    .status-icon-luxury {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: block;
    }

    .status-title-luxury {
        font-weight: 700;
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
    }

    .status-description-luxury {
        font-size: 0.875rem;
        opacity: 0.8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-layout {
            grid-template-columns: 1fr;
            gap: 1rem;
            text-align: center;
        }

        .container {
            padding: 0 1rem;
        }

        .card-header-luxury {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .timeline-luxury {
            padding-left: 1.5rem;
        }

        .timeline-step-luxury {
            padding-left: 1.5rem;
        }

        .timeline-marker-luxury {
            left: -1rem;
            width: 2rem;
            height: 2rem;
            font-size: 0.875rem;
        }
    }

    /* Animation Classes */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes slideIn {
        from { transform: translateX(-20px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    .slide-in {
        animation: slideIn 0.4s ease-out;
    }

    /* Grid Layout */
    .main-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .main-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
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
                    <h1 class="premium-title">Payment Detail</h1>
                    <p class="premium-subtitle">{{ $payment->invoice_id }}</p>
                    <div class="breadcrumb-luxury">
                        <a href="{{ route('portal') }}">
                            <i class="fa fa-home"></i> Portal
                        </a>
                        <span class="breadcrumb-separator">/</span>
                        <a href="{{ route('member.payment.status') }}">Payment Status</a>
                        <span class="breadcrumb-separator">/</span>
                        <span>Detail</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('member.payment.status') }}" class="btn-back-luxury">
                        <i class="fa fa-arrow-left"></i>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div style="padding: 3rem 0;">
        <div class="container">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert-luxury alert-success-luxury fade-in">
                    <div class="alert-title-luxury">
                        <i class="fa fa-check-circle"></i>
                        Success
                    </div>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-luxury alert-danger-luxury fade-in">
                    <div class="alert-title-luxury">
                        <i class="fa fa-exclamation-triangle"></i>
                        Error
                    </div>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Main Grid -->
            <div class="main-grid">
                <!-- Left Column -->
                <div>
                    <!-- Payment Information -->
                    <div class="luxury-card fade-in">
                        <div class="card-header-luxury">
                            <h2 class="card-title-luxury">Payment Information</h2>
                        </div>
                        <div class="card-body-luxury">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                                <div>
                                    <table class="table-luxury">
                                        <tr>
                                            <td>Invoice ID:</td>
                                            <td>
                                                <span style="font-family: 'JetBrains Mono', monospace; font-weight: 600;">
                                                    {{ $payment->invoice_id }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Amount:</td>
                                            <td>
                                                <span style="font-family: 'JetBrains Mono', monospace; font-weight: 700; color: var(--primary); font-size: 1.125rem;">
                                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method:</td>
                                            <td>
                                                <span class="badge-luxury badge-info-luxury">
                                                    {{ strtoupper($payment->payment_method) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Customer:</td>
                                            <td>
                                                <div style="font-weight: 600;">{{ $payment->customer_name }}</div>
                                                <div style="font-size: 0.875rem; color: var(--gray-500);">{{ $payment->customer_email }}</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div>
                                    <table class="table-luxury">
                                        <tr>
                                            <td>Current Status:</td>
                                            <td>
                                                @php
                                                    $statusConfig = [
                                                        'pending' => ['class' => 'badge-warning-luxury', 'icon' => 'fa-clock', 'text' => 'Pending Review'],
                                                        'approved' => ['class' => 'badge-success-luxury', 'icon' => 'fa-check', 'text' => 'Payment Approved'],
                                                        'rejected' => ['class' => 'badge-danger-luxury', 'icon' => 'fa-times', 'text' => 'Payment Rejected']
                                                    ];
                                                    $config = $statusConfig[$payment->status] ?? ['class' => 'badge-warning-luxury', 'icon' => 'fa-question', 'text' => ucfirst($payment->status)];
                                                @endphp
                                                <span class="badge-luxury {{ $config['class'] }}">
                                                    <i class="fa {{ $config['icon'] }}"></i>
                                                    {{ $config['text'] }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Created:</td>
                                            <td>
                                                <span style="font-family: 'JetBrains Mono', monospace;">
                                                    {{ $payment->created_at->format('d/m/Y H:i:s') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Last Updated:</td>
                                            <td>
                                                <span style="font-family: 'JetBrains Mono', monospace;">
                                                    {{ $payment->updated_at->format('d/m/Y H:i:s') }}
                                                </span>
                                            </td>
                                        </tr>
                                        @if($payment->payment_date)
                                        <tr>
                                            <td>Payment Date:</td>
                                            <td>
                                                <span style="font-family: 'JetBrains Mono', monospace;">
                                                    {{ $payment->payment_date->format('d/m/Y H:i:s') }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <!-- Admin Notes -->
                            @if($payment->admin_notes)
                                <div class="alert-luxury alert-info-luxury">
                                    <div class="alert-title-luxury">
                                        <i class="fa fa-info-circle"></i>
                                        Admin Notes
                                    </div>
                                    {{ $payment->admin_notes }}
                                </div>
                            @endif

                            <!-- Rejection Reason -->
                            @if($payment->reject_reason)
                                <div class="alert-luxury alert-danger-luxury">
                                    <div class="alert-title-luxury">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        Rejection Reason
                                    </div>
                                    {{ $payment->reject_reason }}
                                </div>
                            @endif

                            <!-- Payment Notes -->
                            @if($payment->payment_notes)
                                <div class="alert-luxury alert-secondary-luxury">
                                    <div class="alert-title-luxury">
                                        <i class="fa fa-comment"></i>
                                        Your Payment Notes
                                    </div>
                                    {{ $payment->payment_notes }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Timeline -->
                    <div class="luxury-card slide-in">
                        <div class="card-header-luxury">
                            <h2 class="card-title-luxury">Payment Timeline</h2>
                        </div>
                        <div class="card-body-luxury">
                            <div class="timeline-luxury">
                                @foreach($timeline as $step)
                                    <div class="timeline-step-luxury {{ $step['completed'] ? 'completed' : 'pending' }}">
                                        <div class="timeline-marker-luxury" style="background: var(--{{ $step['color'] }});">
                                            <i class="fa {{ $step['icon'] }}"></i>
                                        </div>
                                        <div class="timeline-content-luxury">
                                            <h3 class="timeline-title-luxury">{{ $step['label'] }}</h3>
                                            <p class="timeline-description-luxury">{{ $step['description'] }}</p>
                                            @if($step['date'])
                                                <div class="timeline-date-luxury">
                                                    <i class="fa fa-calendar"></i>
                                                    {{ $step['date']->format('d/m/Y H:i:s') }}
                                                    <span style="color: var(--gray-400);">
                                                        ({{ $step['date']->diffForHumans() }})
                                                    </span>
                                                </div>
                                            @else
                                                <div class="timeline-date-luxury">
                                                    <i class="fa fa-clock"></i>
                                                    <span style="color: var(--gray-400);">Pending</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Payment Proof -->
                    <div class="luxury-card fade-in">
                        <div class="card-header-luxury">
                            <h2 class="card-title-luxury">Payment Proof</h2>
                        </div>
                        <div class="card-body-luxury">
                            @if($payment->payment_proof)
                                <div class="payment-proof-container">
                                    <img src="{{ asset('storage/' . $payment->payment_proof) }}" 
                                         alt="Payment Proof" 
                                         class="payment-proof-image"
                                         onload="console.log('✅ Payment proof loaded successfully')"
                                         onerror="console.error('❌ Payment proof failed to load'); this.style.display='none'; this.nextElementSibling.style.display='block';">
                                    
                                    <div style="display: none;" class="alert-luxury alert-warning-luxury">
                                        <i class="fa fa-exclamation-triangle"></i> Image failed to load
                                    </div>
                                    
                                    <div style="display: grid; gap: 0.75rem;">
                                        <a href="{{ asset('storage/' . $payment->payment_proof) }}" 
                                           target="_blank" 
                                           class="btn-action-luxury btn-primary-luxury">
                                            <i class="fa fa-external-link"></i>
                                            View Full Size
                                        </a>
                                        <a href="{{ asset('storage/' . $payment->payment_proof) }}" 
                                           download="payment_proof_{{ $payment->invoice_id }}.png" 
                                           class="btn-action-luxury btn-success-luxury">
                                            <i class="fa fa-download"></i>
                                            Download Proof
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="empty-state-luxury">
                                    <div class="empty-icon-luxury">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <h3 class="empty-title-luxury">No Payment Proof</h3>
                                    @if($payment->status == 'pending')
                                        <p class="empty-description-luxury">Please upload your payment proof to proceed with verification.</p>
                                    @elseif($payment->status == 'rejected')
                                        <p class="empty-description-luxury">Your previous proof was rejected. Please upload a new one.</p>
                                    @else
                                        <p class="empty-description-luxury">No payment proof uploaded yet.</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="luxury-card slide-in">
                        <div class="card-header-luxury">
                            <h2 class="card-title-luxury">Actions</h2>
                        </div>
                        <div class="card-body-luxury">
                            @if($payment->status == 'pending' && !$payment->payment_proof)
                                <a href="{{ route('member.payment.instructions', $payment->id) }}" 
                                   class="btn-action-luxury btn-warning-luxury">
                                    <i class="fa fa-upload"></i>
                                    Upload Payment Proof
                                </a>
                            @elseif($payment->status == 'pending' && $payment->payment_proof)
                                <div class="status-indicator-luxury status-warning">
                                    <i class="fa fa-clock status-icon-luxury"></i>
                                    <div class="status-title-luxury">Waiting for Admin Review</div>
                                    <div class="status-description-luxury">
                                        Your payment proof is being reviewed by our admin team.
                                    </div>
                                </div>
                            @endif
                            
                            @if($payment->status == 'rejected')
                                <a href="{{ route('member.payment.instructions', $payment->id) }}" 
                                   class="btn-action-luxury btn-danger-luxury">
                                    <i class="fa fa-redo"></i>
                                    Re-upload Payment Proof
                                </a>
                            @endif

                            @if($payment->status == 'approved')
                                <div class="status-indicator-luxury status-success">
                                    <i class="fa fa-check-circle status-icon-luxury"></i>
                                    <div class="status-title-luxury">Payment Approved!</div>
                                    <div class="status-description-luxury">
                                        Your payment has been successfully processed.
                                    </div>
                                </div>
                            @endif
                            
                            <a href="{{ route('member.payment.status') }}" 
                               class="btn-action-luxury btn-secondary-luxury">
                                <i class="fa fa-list"></i>
                                All Payments
                            </a>

                            <a href="{{ route('portal') }}" 
                               class="btn-action-luxury btn-secondary-luxury">
                                <i class="fa fa-home"></i>
                                Back to Portal
                            </a>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="luxury-card slide-in">
                        <div class="card-header-luxury">
                            <h2 class="card-title-luxury">Payment Summary</h2>
                        </div>
                        <div class="card-body-luxury">
                            <table class="table-luxury">
                                <tr>
                                    <td>Status:</td>
                                    <td>
                                        @php
                                            $statusConfig = [
                                                'pending' => ['class' => 'badge-warning-luxury', 'icon' => 'fa-clock', 'text' => 'Pending'],
                                                'approved' => ['class' => 'badge-success-luxury', 'icon' => 'fa-check', 'text' => 'Approved'],
                                                'rejected' => ['class' => 'badge-danger-luxury', 'icon' => 'fa-times', 'text' => 'Rejected']
                                            ];
                                            $config = $statusConfig[$payment->status] ?? ['class' => 'badge-warning-luxury', 'icon' => 'fa-question', 'text' => ucfirst($payment->status)];
                                        @endphp
                                        <span class="badge-luxury {{ $config['class'] }}">
                                            <i class="fa {{ $config['icon'] }}"></i>
                                            {{ $config['text'] }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Amount:</td>
                                    <td>
                                        <span style="font-family: 'JetBrains Mono', monospace; font-weight: 700; color: var(--primary);">
                                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Method:</td>
                                    <td>{{ strtoupper($payment->payment_method) }}</td>
                                </tr>
                                @if($payment->approvedBy)
                                    <tr>
                                        <td>Approved by:</td>
                                        <td>
                                            <span style="font-weight: 600;">{{ $payment->approvedBy->name }}</span>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 Premium payment detail page loaded');
    console.log('📊 Payment Details:', {
        id: {{ $payment->id }},
        invoice_id: '{{ $payment->invoice_id }}',
        status: '{{ $payment->status }}',
        amount: {{ $payment->amount }},
        has_proof: {{ $payment->payment_proof ? 'true' : 'false' }}
    });
    console.log('🕐 Timestamp: 2025-06-13 20:46:40 UTC');
    console.log('👤 User: Aliester10');
    
    // Add stagger animation to cards
    const cards = document.querySelectorAll('.fade-in, .slide-in');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
    
    // Add hover effects to timeline steps
    const timelineSteps = document.querySelectorAll('.timeline-step-luxury');
    timelineSteps.forEach(step => {
        step.addEventListener('mouseenter', function() {
            this.querySelector('.timeline-marker-luxury').style.transform = 'scale(1.2)';
        });
        step.addEventListener('mouseleave', function() {
            this.querySelector('.timeline-marker-luxury').style.transform = this.classList.contains('completed') ? 'scale(1.1)' : 'scale(1)';
        });
    });
    
    // Auto-refresh for pending payments
    @if($payment->status == 'pending')
        setInterval(() => {
            fetch(window.location.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(response => {
                console.log('🔄 Status check at:', new Date().toLocaleTimeString());
            }).catch(error => {
                console.error('❌ Auto-refresh error:', error);
            });
        }, 30000); // Check every 30 seconds
    @endif
    
    // Image lazy loading with error handling
    const images = document.querySelectorAll('img[data-src]');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const image = entry.target;
                    image.src = image.dataset.src;
                    image.classList.remove('lazy');
                    observer.unobserve(image);
                }
            });
        });
        
        images.forEach(image => imageObserver.observe(image));
    }
});

// Smooth scrolling for internal links
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
</script>
@endsection