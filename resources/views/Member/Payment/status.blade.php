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
        padding: 4rem 0;
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
        gap: 3rem;
        align-items: center;
    }

    .header-content {
        max-width: 600px;
    }

    .premium-title {
        font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: 900;
        margin-bottom: 1rem;
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
        font-size: 1.125rem;
        color: var(--gray-600);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .header-badges {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .premium-badge {
        padding: 0.5rem 1rem;
        border-radius: 1.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .premium-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .premium-badge:hover::before {
        left: 100%;
    }

    .badge-payment { background: var(--gradient-accent); }
    .badge-secure { background: var(--gradient-primary); }
    .badge-history { background: var(--gradient-violet); }

    /* Header Visual with Floating Icons */
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
        border-color: var(--accent);
        animation: rotate-ring 20s linear infinite;
    }

    .ring-2 {
        width: 80%;
        height: 80%;
        top: 10%;
        left: 10%;
        border-color: var(--primary);
        animation: rotate-ring 15s linear infinite reverse;
    }

    .ring-3 {
        width: 60%;
        height: 60%;
        top: 20%;
        left: 20%;
        border-color: var(--violet);
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
        background: var(--gradient-accent);
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
        background: var(--gradient-primary);
        animation-delay: 0s;
        transform: translateX(-50%);
    }

    .icon-2 {
        top: 50%;
        right: 0;
        background: var(--gradient-violet);
        animation-delay: 1.5s;
        transform: translateY(-50%);
    }

    .icon-3 {
        bottom: 0;
        left: 50%;
        background: var(--gradient-rose);
        animation-delay: 3s;
        transform: translateX(-50%);
    }

    .icon-4 {
        top: 50%;
        left: 0;
        background: var(--gradient-success);
        animation-delay: 4.5s;
        transform: translateY(-50%);
    }

    @keyframes float-icon {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(180deg); }
    }

    /* Icon-1 specific animation */
    .icon-1 {
        animation: float-icon-1 6s ease-in-out infinite;
    }

    @keyframes float-icon-1 {
        0%, 100% { transform: translateX(-50%) translateY(0px) rotate(0deg); }
        50% { transform: translateX(-50%) translateY(-15px) rotate(180deg); }
    }

    /* Icon-2 specific animation */
    .icon-2 {
        animation: float-icon-2 6s ease-in-out infinite;
    }

    @keyframes float-icon-2 {
        0%, 100% { transform: translateY(-50%) translateX(0px) rotate(0deg); }
        50% { transform: translateY(-50%) translateX(-15px) rotate(180deg); }
    }

    /* Icon-3 specific animation */
    .icon-3 {
        animation: float-icon-3 6s ease-in-out infinite;
    }

    @keyframes float-icon-3 {
        0%, 100% { transform: translateX(-50%) translateY(0px) rotate(0deg); }
        50% { transform: translateX(-50%) translateY(15px) rotate(180deg); }
    }

    /* Icon-4 specific animation */
    .icon-4 {
        animation: float-icon-4 6s ease-in-out infinite;
    }

    @keyframes float-icon-4 {
        0%, 100% { transform: translateY(-50%) translateX(0px) rotate(0deg); }
        50% { transform: translateY(-50%) translateX(15px) rotate(180deg); }
    }

    /* Luxury Dashboard */
    .luxury-dashboard {
        padding: 3rem 0;
        background: transparent;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .luxury-stat-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        padding: 2rem;
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .luxury-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient-accent);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .luxury-stat-card:nth-child(2)::before { background: var(--gradient-warning); }
    .luxury-stat-card:nth-child(3)::before { background: var(--gradient-success); }
    .luxury-stat-card:nth-child(4)::before { background: var(--gradient-danger); }

    .luxury-stat-card:hover::before {
        transform: scaleX(1);
    }

    .luxury-stat-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: var(--shadow-2xl);
        border-color: rgba(249, 115, 22, 0.3);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }

    .stat-icon-luxury {
        width: 60px;
        height: 60px;
        border-radius: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        box-shadow: var(--shadow-lg);
        position: relative;
        z-index: 2;
    }

    .luxury-stat-card:nth-child(1) .stat-icon-luxury { background: var(--gradient-accent); }
    .luxury-stat-card:nth-child(2) .stat-icon-luxury { background: var(--gradient-warning); }
    .luxury-stat-card:nth-child(3) .stat-icon-luxury { background: var(--gradient-success); }
    .luxury-stat-card:nth-child(4) .stat-icon-luxury { background: var(--gradient-danger); }

    .stat-content {
        position: relative;
        z-index: 2;
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--gray-500);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--gray-900);
        line-height: 1;
        margin-bottom: 0.5rem;
        font-family: 'JetBrains Mono', monospace;
    }

    /* Premium Table */
    .luxury-table-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        position: relative;
    }

    .luxury-table-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
    }

    .table-header-luxury {
        padding: 2rem;
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        background: rgba(248, 250, 252, 0.8);
    }

    .table-title-luxury {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
    }

    .filter-buttons-luxury {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .btn-filter-luxury {
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        border: 2px solid rgba(226, 232, 240, 0.6);
        background: rgba(255, 255, 255, 0.8);
        color: var(--gray-600);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-filter-luxury:hover,
    .btn-filter-luxury.active {
        background: var(--gradient-primary);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-filter-luxury.filter-warning:hover,
    .btn-filter-luxury.filter-warning.active {
        background: var(--gradient-warning);
    }

    .btn-filter-luxury.filter-success:hover,
    .btn-filter-luxury.filter-success.active {
        background: var(--gradient-success);
    }

    .btn-filter-luxury.filter-danger:hover,
    .btn-filter-luxury.filter-danger.active {
        background: var(--gradient-danger);
    }

    .table-container-luxury {
        padding: 2rem;
    }

    .table-luxury {
        width: 100%;
        border-collapse: collapse;
        background: transparent;
    }

    .table-luxury th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--gray-700);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(226, 232, 240, 0.6);
    }

    .table-luxury td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid rgba(226, 232, 240, 0.4);
        vertical-align: middle;
    }

    .table-luxury tr {
        transition: all 0.3s ease;
    }

    .table-luxury tr:hover {
        background: rgba(249, 115, 22, 0.05);
        transform: translateX(5px);
    }

    .badge-luxury {
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow);
    }

    .badge-warning-luxury { background: var(--gradient-warning); }
    .badge-success-luxury { background: var(--gradient-success); }
    .badge-danger-luxury { background: var(--gradient-danger); }

    .progress-luxury {
        height: 8px;
        background: rgba(226, 232, 240, 0.6);
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .progress-bar-luxury {
        height: 100%;
        border-radius: 1rem;
        transition: width 0.6s ease;
    }

    .progress-warning { background: var(--gradient-warning); }
    .progress-success { background: var(--gradient-success); }
    .progress-danger { background: var(--gradient-danger); }

    .btn-action-luxury {
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .btn-primary-luxury {
        background: var(--gradient-primary);
        color: white;
        box-shadow: var(--shadow);
    }

    .btn-action-luxury:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
        text-decoration: none;
    }

    /* Sidebar Cards */
    .sidebar-card-luxury {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
        position: relative;
    }

    .sidebar-card-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-violet);
    }

    .sidebar-card-luxury:last-child::before {
        background: var(--gradient-secondary);
    }

    .card-header-luxury {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        background: rgba(248, 250, 252, 0.8);
    }

    .card-title-luxury {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
    }

    .card-body-luxury {
        padding: 2rem;
    }

    /* Timeline */
    .timeline-luxury {
        position: relative;
        padding-left: 1.5rem;
    }

    .timeline-luxury::before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(135deg, var(--accent), var(--primary));
    }

    .timeline-item-luxury {
        position: relative;
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .timeline-marker-luxury {
        position: absolute;
        left: -0.75rem;
        top: 0.25rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.5rem;
        box-shadow: var(--shadow);
    }

    .timeline-marker-success { background: var(--gradient-success); }
    .timeline-marker-warning { background: var(--gradient-warning); }
    .timeline-marker-danger { background: var(--gradient-danger); }

    .timeline-content-luxury {
        background: rgba(248, 250, 252, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 1rem;
        padding: 1rem;
        position: relative;
    }

    .timeline-title-luxury {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .timeline-description-luxury {
        font-size: 0.75rem;
        color: var(--gray-600);
        margin-bottom: 0.5rem;
    }

    .timeline-date-luxury {
        font-size: 0.6875rem;
        color: var(--gray-500);
        font-weight: 500;
    }

    /* Empty State */
    .empty-state-luxury {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(248, 250, 252, 0.8);
        border-radius: 1.5rem;
    }

    .empty-icon-luxury {
        width: 80px;
        height: 80px;
        background: var(--gradient-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
        box-shadow: var(--shadow-lg);
    }

    .empty-title-luxury {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .empty-description-luxury {
        font-size: 0.875rem;
        color: var(--gray-600);
        margin-bottom: 1.5rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-layout {
            grid-template-columns: 1fr;
            gap: 2rem;
            text-align: center;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .filter-buttons-luxury {
            justify-content: center;
        }

        .table-container-luxury {
            overflow-x: auto;
        }

        .btn-action-luxury {
            font-size: 0.6875rem;
            padding: 0.375rem 0.75rem;
        }
    }

    /* Alerts */
    .alert-luxury {
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
        border: 1px solid;
        position: relative;
        overflow: hidden;
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

    .alert-luxury::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: currentColor;
    }

    .alert-close-luxury {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: currentColor;
        cursor: pointer;
        font-size: 1.25rem;
    }

    /* Animations */
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
                    <h1 class="premium-title">Payment Status</h1>
                    <p class="premium-subtitle">
                        Track your payment history and manage your transactions with our secure payment system.
                    </p>
                    <div class="header-badges">
                        <div class="premium-badge badge-payment">
                            <i class="fa fa-credit-card"></i>
                            Secure Payments
                        </div>
                        <div class="premium-badge badge-secure">
                            <i class="fa fa-shield-alt"></i>
                            Protected
                        </div>
                        <div class="premium-badge badge-history">
                            <i class="fa fa-history"></i>
                            Complete History
                        </div>
                    </div>
                </div>
                <div class="header-visual">
                    <div class="visual-masterpiece">
                        <div class="visual-ring ring-1"></div>
                        <div class="visual-ring ring-2"></div>
                        <div class="visual-ring ring-3"></div>
                        <div class="visual-center">
                            <i class="fa fa-receipt"></i>
                        </div>
                        <div class="visual-icons">
                            <div class="floating-icon icon-1">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <div class="floating-icon icon-2">
                                <i class="fa fa-shield-alt"></i>
                            </div>
                            <div class="floating-icon icon-3">
                                <i class="fa fa-history"></i>
                            </div>
                            <div class="floating-icon icon-4">
                                <i class="fa fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Luxury Dashboard -->
    <div class="luxury-dashboard">
        <div class="container">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert-luxury alert-success-luxury fade-in">
                    {{ session('success') }}
                    <button type="button" class="alert-close-luxury" onclick="this.parentElement.remove()">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-luxury alert-danger-luxury fade-in">
                    {{ session('error') }}
                    <button type="button" class="alert-close-luxury" onclick="this.parentElement.remove()">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Statistics Dashboard -->
            <div class="dashboard-grid">
                <div class="luxury-stat-card fade-in">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class="fa fa-coins"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Payments</div>
                        <div class="stat-number">{{ $statistics['total_payments'] }}</div>
                    </div>
                </div>

                <div class="luxury-stat-card fade-in">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class="fa fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Pending Review</div>
                        <div class="stat-number">{{ $statistics['pending_payments'] }}</div>
                    </div>
                </div>

                <div class="luxury-stat-card fade-in">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class="fa fa-check"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Approved</div>
                        <div class="stat-number">{{ $statistics['approved_payments'] }}</div>
                    </div>
                </div>

                <div class="luxury-stat-card fade-in">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Rejected</div>
                        <div class="stat-number">{{ $statistics['rejected_payments'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div style="display: grid; grid-template-columns: 1fr 350px; gap: 2rem; align-items: start;">
                <!-- Payment History Table -->
                <div class="luxury-table-card fade-in">
                    <div class="table-header-luxury">
                        <h2 class="table-title-luxury">Payment History</h2>
                        <div class="filter-buttons-luxury">
                            <button type="button" class="btn-filter-luxury active" onclick="filterStatus('all')">
                                All
                            </button>
                            <button type="button" class="btn-filter-luxury filter-warning" onclick="filterStatus('pending')">
                                Pending
                            </button>
                            <button type="button" class="btn-filter-luxury filter-success" onclick="filterStatus('approved')">
                                Approved
                            </button>
                            <button type="button" class="btn-filter-luxury filter-danger" onclick="filterStatus('rejected')">
                                Rejected
                            </button>
                        </div>
                    </div>
                    <div class="table-container-luxury">
                        @if($payments->count() > 0)
                            <table class="table-luxury" id="payment-table">
                                <thead>
                                    <tr>
                                        <th>Invoice Details</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Progress</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr data-status="{{ $payment->status }}" class="slide-in">
                                            <td>
                                                <div style="font-weight: 600; color: var(--gray-900); margin-bottom: 0.25rem;">
                                                    {{ $payment->invoice_id }}
                                                </div>
                                                <div style="font-size: 0.75rem; color: var(--gray-500);">
                                                    {{ $payment->payment_method }}
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-weight: 700; font-family: 'JetBrains Mono', monospace; color: var(--gray-900);">
                                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $statusConfig = [
                                                        'pending' => ['class' => 'badge-warning-luxury', 'icon' => 'fa-clock', 'text' => 'Pending Review'],
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
                                            <td>
                                                @if($payment->payment_date)
                                                    <div style="font-weight: 600; color: var(--gray-900);">
                                                        {{ $payment->payment_date->format('d/m/Y') }}
                                                    </div>
                                                    <div style="font-size: 0.75rem; color: var(--gray-500);">
                                                        {{ $payment->payment_date->format('H:i') }}
                                                    </div>
                                                @else
                                                    <span style="color: var(--gray-400);">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $progress = [
                                                        'pending' => 50,
                                                        'approved' => 100,
                                                        'rejected' => 100
                                                    ];
                                                    $progressValue = $progress[$payment->status] ?? 25;
                                                    $progressClass = $payment->status == 'rejected' ? 'progress-danger' : ($progressValue == 100 ? 'progress-success' : 'progress-warning');
                                                @endphp
                                                <div class="progress-luxury">
                                                    <div class="progress-bar-luxury {{ $progressClass }}" 
                                                         style="width: {{ $progressValue }}%"></div>
                                                </div>
                                                <div style="font-size: 0.75rem; color: var(--gray-500); font-family: 'JetBrains Mono', monospace;">
                                                    {{ $progressValue }}%
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('member.payment.detail', $payment->id) }}" 
                                                   class="btn-action-luxury btn-primary-luxury"
                                                   title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                    View Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <!-- Pagination -->
                            <div style="display: flex; justify-content: center; margin-top: 2rem;">
                                {{ $payments->links() }}
                            </div>
                        @else
                            <div class="empty-state-luxury">
                                <div class="empty-icon-luxury">
                                    <i class="fa fa-receipt"></i>
                                </div>
                                <h3 class="empty-title-luxury">No Payment Records Found</h3>
                                <p class="empty-description-luxury">
                                    You haven't made any payments yet. Start shopping to see your payment history here.
                                </p>
                                <a href="{{ route('portal') }}" class="btn-action-luxury btn-primary-luxury">
                                    <i class="fa fa-shopping-cart"></i>
                                    Start Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div>
                    <!-- Recent Activity -->
                    <div class="sidebar-card-luxury fade-in">
                        <div class="card-header-luxury">
                            <h3 class="card-title-luxury">Recent Activity</h3>
                        </div>
                        <div class="card-body-luxury">
                            @if($recentActivity->count() > 0)
                                <div class="timeline-luxury">
                                    @foreach($recentActivity as $activity)
                                        <div class="timeline-item-luxury">
                                            <div class="timeline-marker-luxury timeline-marker-{{ $activity->status == 'approved' ? 'success' : ($activity->status == 'rejected' ? 'danger' : 'warning') }}">
                                                <i class="fa fa-circle"></i>
                                            </div>
                                            <div class="timeline-content-luxury">
                                                <div class="timeline-title-luxury">{{ $activity->invoice_id }}</div>
                                                <div class="timeline-description-luxury">
                                                    Status: <strong>{{ ucfirst($activity->status) }}</strong>
                                                    @if($activity->admin_notes)
                                                        <br>{{ $activity->admin_notes }}
                                                    @endif
                                                    @if($activity->reject_reason)
                                                        <br><span style="color: var(--danger);">{{ $activity->reject_reason }}</span>
                                                    @endif
                                                </div>
                                                <div class="timeline-date-luxury">{{ $activity->updated_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div style="text-align: center; padding: 2rem; color: var(--gray-500);">
                                    <i class="fa fa-history" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                    <div style="font-weight: 600;">No recent activity</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="sidebar-card-luxury fade-in">
                        <div class="card-header-luxury">
                            <h3 class="card-title-luxury">Quick Actions</h3>
                        </div>
                        <div class="card-body-luxury">
                            <div style="display: grid; gap: 0.75rem;">
                                <a href="{{ route('portal.cart') }}" class="btn-action-luxury btn-primary-luxury" style="justify-content: center;">
                                    <i class="fa fa-shopping-cart"></i>
                                    View Cart
                                </a>
                                <a href="{{ route('product.index') }}" class="btn-action-luxury" style="justify-content: center; background: var(--gradient-warning); color: white;">
                                    <i class="fa fa-search"></i>
                                    Browse Products
                                </a>
                                <a href="{{ route('portal') }}" class="btn-action-luxury" style="justify-content: center; background: rgba(148, 163, 184, 0.1); color: var(--gray-700);">
                                    <i class="fa fa-home"></i>
                                    Back to Portal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentFilter = 'all';

function filterStatus(status) {
    currentFilter = status;
    const rows = document.querySelectorAll('#payment-table tbody tr');
    
    // Update button states
    document.querySelectorAll('.btn-filter-luxury').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Filter rows with animation
    rows.forEach((row, index) => {
        const rowStatus = row.getAttribute('data-status');
        if (status === 'all' || rowStatus === status) {
            row.style.display = '';
            setTimeout(() => {
                row.classList.add('slide-in');
            }, index * 100);
        } else {
            row.style.display = 'none';
            row.classList.remove('slide-in');
        }
    });
    
    // Update counter
    const visibleRows = document.querySelectorAll('#payment-table tbody tr[style=""]').length;
    console.log(`🎯 Showing ${visibleRows} payments with status: ${status}`);
}

// Auto-refresh functionality
let refreshInterval;

function startAutoRefresh() {
    refreshInterval = setInterval(() => {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(response => {
            if (response.ok) {
                console.log('🔄 Status checked at:', new Date().toLocaleTimeString());
            }
        }).catch(error => {
            console.error('❌ Auto-refresh error:', error);
        });
    }, 30000); // 30 seconds
}

function stopAutoRefresh() {
    if (refreshInterval) {
        clearInterval(refreshInterval);
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 Premium payment status page loaded');
    console.log('📊 Statistics:', {
        total: {{ $statistics['total_payments'] }},
        pending: {{ $statistics['pending_payments'] }},
        approved: {{ $statistics['approved_payments'] }},
        rejected: {{ $statistics['rejected_payments'] }}
    });
    console.log('🕐 Timestamp: 2025-06-13 20:42:14 UTC');
    console.log('👤 User: Aliester10');
    
    // Start auto-refresh
    startAutoRefresh();
    
    // Add stagger animation to cards
    const cards = document.querySelectorAll('.fade-in');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
    
    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('.table-luxury tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
        });
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
});

// Stop auto-refresh when leaving page
window.addEventListener('beforeunload', stopAutoRefresh);

// Add smooth scrolling for internal links
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