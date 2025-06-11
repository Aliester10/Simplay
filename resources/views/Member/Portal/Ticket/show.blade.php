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
        background: var(--gradient-primary);
        top: 15%;
        right: 10%;
        animation-delay: 0s;
    }

    .orb-2 {
        width: 200px;
        height: 200px;
        background: var(--gradient-teal);
        top: 65%;
        left: 15%;
        animation-delay: -10s;
    }

    .orb-3 {
        width: 150px;
        height: 150px;
        background: var(--gradient-success);
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
            var(--primary), 
            var(--teal), 
            var(--success), 
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
            var(--primary) 25%, 
            var(--teal) 50%, 
            var(--success) 75%, 
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
        border-color: var(--primary);
        animation: rotate-ring 20s linear infinite;
    }

    .ring-2 {
        width: 80%;
        height: 80%;
        top: 10%;
        left: 10%;
        border-color: var(--teal);
        animation: rotate-ring 15s linear infinite reverse;
    }

    .ring-3 {
        width: 60%;
        height: 60%;
        top: 20%;
        left: 20%;
        border-color: var(--success);
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
        background: var(--gradient-primary);
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
        background: var(--gradient-teal);
        animation-delay: 0s;
    }

    .icon-2 {
        top: 50%;
        right: 0;
        background: var(--gradient-success);
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

    /* Premium Content Section */
    .premium-content-section {
        padding: 4rem 0 6rem;
    }

    .content-container-luxury {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .premium-ticket-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        position: relative;
    }

    .premium-ticket-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
    }

    .ticket-header-luxury {
        padding: 3rem 3rem 2rem;
        background: rgba(248, 250, 252, 0.8);
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        text-align: center;
        position: relative;
    }

    .ticket-title-luxury {
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .ticket-subtitle-luxury {
        font-size: 1rem;
        color: var(--gray-600);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .ticket-id-luxury {
        background: var(--gradient-primary);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 600;
        font-size: 0.875rem;
        box-shadow: var(--shadow-md);
    }

    .ticket-user-luxury {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .ticket-content-luxury {
        padding: 0;
    }

    .detail-table-luxury {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table-luxury tr {
        border-bottom: 1px solid rgba(226, 232, 240, 0.3);
        transition: all 0.3s ease;
    }

    .detail-table-luxury tr:last-child {
        border-bottom: none;
    }

    .detail-table-luxury tr:hover {
        background: rgba(99, 102, 241, 0.02);
        transform: translateX(4px);
    }

    .detail-table-luxury th {
        background: rgba(248, 250, 252, 0.8);
        padding: 2rem 3rem;
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--gray-800);
        text-align: left;
        width: 280px;
        border-right: 1px solid rgba(226, 232, 240, 0.6);
        vertical-align: top;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .detail-table-luxury th::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--gradient-primary);
    }

    .detail-table-luxury td {
        padding: 2rem 3rem;
        font-size: 1rem;
        color: var(--gray-700);
        vertical-align: top;
        background: rgba(255, 255, 255, 0.9);
    }

    .detail-icon-luxury {
        width: 40px;
        height: 40px;
        background: var(--gradient-primary);
        border-radius: 0.75rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        margin-right: 1rem;
        box-shadow: var(--shadow-md);
        vertical-align: middle;
    }

    /* Status Badges Luxury */
    .status-badge-luxury {
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-family: 'JetBrains Mono', monospace;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .status-badge-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .status-badge-luxury:hover::before {
        left: 100%;
    }

    .status-open-luxury {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-progress-luxury {
        background: rgba(245, 158, 11, 0.1);
        color: var(--accent);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-close-luxury {
        background: rgba(107, 114, 128, 0.1);
        color: var(--gray-500);
        border: 1px solid rgba(107, 114, 128, 0.2);
    }

    /* Document Links Luxury */
    .document-link-luxury {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--primary);
        text-decoration: none;
        padding: 1rem 1.5rem;
        background: rgba(99, 102, 241, 0.05);
        border: 1px solid rgba(99, 102, 241, 0.2);
        border-radius: 1.5rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .document-link-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .document-link-luxury:hover::before {
        left: 100%;
    }

    .document-link-luxury:hover {
        background: rgba(99, 102, 241, 0.1);
        text-decoration: none;
        color: var(--primary);
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .document-icon-luxury {
        width: 40px;
        height: 40px;
        background: var(--gradient-primary);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        box-shadow: var(--shadow-md);
    }

    /* Team Badge Luxury */
    .team-badge-luxury {
        padding: 0.75rem 1.5rem;
        background: var(--gradient-success);
        color: white;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
    }

    .team-badge-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .team-badge-luxury:hover::before {
        left: 100%;
    }

    .not-assigned-luxury {
        padding: 0.75rem 1.5rem;
        background: rgba(148, 163, 184, 0.1);
        color: var(--gray-500);
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
        font-style: italic;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid rgba(148, 163, 184, 0.2);
    }

    /* Description Text Luxury */
    .description-text-luxury {
        background: rgba(248, 250, 252, 0.8);
        padding: 1.5rem 2rem;
        border-radius: 1.5rem;
        border: 1px solid rgba(226, 232, 240, 0.6);
        font-size: 1rem;
        line-height: 1.7;
        color: var(--gray-700);
        position: relative;
        overflow: hidden;
    }

    .description-text-luxury::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--gradient-primary);
    }

    .no-content-luxury {
        color: var(--gray-500);
        font-style: italic;
        font-size: 1rem;
        background: rgba(248, 250, 252, 0.5);
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        border: 1px dashed rgba(148, 163, 184, 0.3);
        text-align: center;
    }

    .date-display-luxury {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 600;
        background: rgba(99, 102, 241, 0.05);
        color: var(--primary);
        padding: 0.75rem 1.25rem;
        border-radius: 1rem;
        border: 1px solid rgba(99, 102, 241, 0.2);
        display: inline-block;
        box-shadow: var(--shadow-sm);
    }

    /* Action Section Luxury */
    .action-section-luxury {
        padding: 2.5rem 3rem;
        background: rgba(248, 250, 252, 0.8);
        border-top: 1px solid rgba(226, 232, 240, 0.6);
    }

    .action-buttons-luxury {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-luxury {
        padding: 1.25rem 2rem;
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

    .btn-warning-luxury {
        background: rgba(245, 158, 11, 0.1);
        color: var(--accent);
        border-color: rgba(245, 158, 11, 0.2);
    }

    .btn-warning-luxury:hover {
        background: rgba(245, 158, 11, 0.2);
        transform: translateY(-2px);
        text-decoration: none;
        color: var(--accent);
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
        
        .content-container-luxury {
            padding: 0 1rem;
        }
        
        .ticket-header-luxury,
        .detail-table-luxury th,
        .detail-table-luxury td,
        .action-section-luxury {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
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

        .detail-table-luxury th {
            width: auto;
            display: block;
            border-right: none;
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            padding-bottom: 1rem;
        }
        
        .detail-table-luxury td {
            display: block;
            padding-top: 1rem;
            padding-bottom: 2rem;
        }
        
        .action-buttons-luxury {
            flex-direction: column;
        }
        
        .btn-luxury {
            width: 100%;
        }

        .ticket-subtitle-luxury {
            flex-direction: column;
            gap: 0.75rem;
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

    .premium-ticket-card {
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
                    <h1 class="premium-title">{{ __('messages.ticket_detail') }}</h1>
                    <p class="premium-subtitle">
                        {{ __('messages.view_ticket_info') }}
                    </p>
                </div>
                
                <div class="header-visual">
                    <div class="visual-masterpiece">
                        <div class="visual-ring ring-1"></div>
                        <div class="visual-ring ring-2"></div>
                        <div class="visual-ring ring-3"></div>
                        
                        <div class="visual-center">
                            <i class='bx bx-show'></i>
                        </div>
                        
                        <div class="visual-icons">
                            <div class="floating-icon icon-1">
                                <i class='bx bx-file-blank'></i>
                            </div>
                            <div class="floating-icon icon-2">
                                <i class='bx bx-time'></i>
                            </div>
                            <div class="floating-icon icon-3">
                                <i class='bx bx-check-circle'></i>
                            </div>
                            <div class="floating-icon icon-4">
                                <i class='bx bx-user'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Content Section -->
    <div class="premium-content-section">
        <div class="content-container-luxury">
            <div class="premium-ticket-card luxury-fade-up">
                <div class="ticket-header-luxury">
                    <h2 class="ticket-title-luxury">{{ __('messages.ticket_detail') }}</h2>
                    <div class="ticket-subtitle-luxury">
                        <span class="ticket-id-luxury">#{{ $ticket->id_after_sales }}</span>
                        <span class="ticket-user-luxury">
                            <i class='bx bx-user'></i>
                            Created by Aliester10
                        </span>
                    </div>
                </div>
                
                <div class="ticket-content-luxury">
                    <table class="detail-table-luxury">
                        <tr>
                            <th>
                                <div class="detail-icon-luxury">
                                    <i class='bx bx-cog'></i>
                                </div>
                                {{ __('messages.service_type') }}
                            </th>
                            <td>{{ $ticket->jenis_layanan }}</td>
                        </tr>
                        
                        <tr>
                            <th>
                                <div class="detail-icon-luxury">
                                    <i class='bx bx-detail'></i>
                                </div>
                                {{ __('messages.service_description') }}
                            </th>
                            <td>
                                <div class="description-text-luxury">
                                    {{ $ticket->keterangan_layanan }}
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>
                                <div class="detail-icon-luxury">
                                    <i class='bx bx-calendar-alt'></i>
                                </div>
                                {{ __('messages.submission_date') }}
                            </th>
                            <td>
                                <span class="date-display-luxury">
                                    {{ \Carbon\Carbon::parse($ticket->tgl_pengajuan)->format('l, F d, Y \a\t H:i') }}
                                </span>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>
                                <div class="detail-icon-luxury">
                                    <i class='bx bx-flag'></i>
                                </div>
                                {{ __('messages.status') }}
                            </th>
                            <td>
                                <span class="status-badge-luxury status-{{ $ticket->status }}-luxury">
                                    @if($ticket->status == 'open')
                                        <i class='bx bx-time'></i>
                                    @elseif($ticket->status == 'progress')
                                        <i class='bx bx-loader-alt bx-spin'></i>
                                    @else
                                        <i class='bx bx-check'></i>
                                    @endif
                                    {{ __('messages.' . $ticket->status) }}
                                </span>
                            </td>
                        </tr>
                        
                        @if ($ticket->file_pendukung_layanan)
                        <tr>
                            <th>
                                <div class="detail-icon-luxury">
                                    <i class='bx bx-paperclip'></i>
                                </div>
                                {{ __('messages.attached_document') }}
                            </th>
                            <td>
                                <a href="{{ asset($ticket->file_pendukung_layanan) }}" 
                                   target="_blank" 
                                   class="document-link-luxury">
                                    <div class="document-icon-luxury">
                                        <i class='bx bx-file'></i>
                                    </div>
                                    <span>{{ __('messages.view_document') }}</span>
                                </a>
                            </td>
                        </tr>
                        @endif
                        
                        <tr>
                            <th>
                                <div class="detail-icon-luxury">
                                    <i class='bx bx-group'></i>
                                </div>
                                {{ __('messages.technical_team') }}
                            </th>
                            <td>
                                @if ($ticket->tim_teknis)
                                    <span class="team-badge-luxury">
                                        <i class='bx bx-user-check'></i>
                                        {{ $ticket->tim_teknis }}
                                    </span>
                                @else
                                    <span class="not-assigned-luxury">
                                        <i class='bx bx-user-x'></i>
                                        {{ __('messages.not_assigned') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th>
                                <div class="detail-icon-luxury">
                                    <i class='bx bx-clipboard-list'></i>
                                </div>
                                {{ __('messages.action_description') }}
                            </th>
                            <td>
                                @if($ticket->keterangan_tindakan)
                                    <div class="description-text-luxury">
                                        {{ $ticket->keterangan_tindakan }}
                                    </div>
                                @else
                                    <span class="no-content-luxury">{{ __('messages.no_action_description') }}</span>
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th>
                                <div class="detail-icon-luxury">
                                    <i class='bx bx-file-blank'></i>
                                </div>
                                {{ __('messages.action_document') }}
                            </th>
                            <td>
                                @if ($ticket->dok_pendukung_tindakan)
                                    <a href="{{ asset($ticket->dok_pendukung_tindakan) }}" 
                                       target="_blank" 
                                       class="document-link-luxury">
                                        <div class="document-icon-luxury">
                                            <i class='bx bx-file-blank'></i>
                                        </div>
                                        <span>{{ __('messages.view_action_document') }}</span>
                                    </a>
                                @else
                                    <span class="no-content-luxury">{{ __('messages.no_action_document') }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="action-section-luxury">
                    <div class="action-buttons-luxury">
                        <a href="{{ route('tickets.index') }}" class="btn-luxury btn-secondary-luxury">
                            <i class='bx bx-arrow-left'></i>
                            <span>{{ __('messages.back') }}</span>
                        </a>
                        
                        @if($ticket->status == 'open')
                            <a href="{{ route('tickets.edit', $ticket->id_after_sales) }}" class="btn-luxury btn-warning-luxury">
                                <i class='bx bx-edit'></i>
                                <span>{{ __('messages.edit_ticket') }}</span>
                            </a>
                        @endif
                    </div>
                </div>
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

    // Enhanced table row interactions with 3D effect
    document.querySelectorAll('.detail-table-luxury tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
            this.style.transform = 'translateX(0) rotateY(0)';
        });
        
        row.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const mouseX = e.clientX - centerX;
            
            const rotateY = (mouseX / rect.width) * 2;
            
            this.style.transform = `translateX(4px) rotateY(${rotateY}deg)`;
        });
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

    // Enhanced document link interactions
    document.querySelectorAll('.document-link-luxury').forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Premium parallax effect for background orbs
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const orbs = document.querySelectorAll('.bg-gradient-orb');
        
        orbs.forEach((orb, index) => {
            const speed = (index + 1) * 0.3;
            orb.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
        });
    });

    // Enhanced status badge interactions
    document.querySelectorAll('.status-badge-luxury').forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Enhanced team badge interactions
    document.querySelectorAll('.team-badge-luxury').forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) rotate(2deg)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });
});
</script>
@endsection