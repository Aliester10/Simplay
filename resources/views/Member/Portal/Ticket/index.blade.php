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
        background: var(--gradient-primary);
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
            var(--teal), 
            var(--primary), 
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
            var(--teal) 25%, 
            var(--primary) 50%, 
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
        margin-bottom: 2rem;
    }

    .premium-breadcrumb {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .breadcrumb-link {
        background: rgba(20, 184, 166, 0.1);
        color: var(--teal);
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 600;
        border: 1px solid rgba(20, 184, 166, 0.2);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .breadcrumb-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .breadcrumb-link:hover::before {
        left: 100%;
    }

    .breadcrumb-link:hover {
        background: rgba(20, 184, 166, 0.2);
        color: var(--teal);
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .breadcrumb-separator {
        color: var(--gray-400);
        font-weight: 600;
    }

    .breadcrumb-current {
        color: var(--gray-600);
        font-weight: 600;
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
        border-color: var(--primary);
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
        background: var(--gradient-primary);
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

    /* Luxury Dashboard */
    .luxury-dashboard {
        padding: 4rem 0;
        background: transparent;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        margin-bottom: 4rem;
    }

    .luxury-stat-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        padding: 2.5rem;
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
        background: var(--gradient-teal);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .luxury-stat-card:nth-child(2)::before { background: var(--gradient-primary); }
    .luxury-stat-card:nth-child(3)::before { background: var(--gradient-success); }

    .luxury-stat-card:hover::before {
        transform: scaleX(1);
    }

    .luxury-stat-card::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(20, 184, 166, 0.05) 0%, transparent 70%);
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .luxury-stat-card:hover::after {
        opacity: 1;
    }

    .luxury-stat-card:hover {
        transform: translateY(-16px) scale(1.02);
        box-shadow: var(--shadow-2xl);
        border-color: rgba(20, 184, 166, 0.3);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .stat-icon-luxury {
        width: 80px;
        height: 80px;
        border-radius: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: var(--shadow-lg);
        position: relative;
        z-index: 2;
    }

    .luxury-stat-card:nth-child(1) .stat-icon-luxury { background: var(--gradient-teal); }
    .luxury-stat-card:nth-child(2) .stat-icon-luxury { background: var(--gradient-primary); }
    .luxury-stat-card:nth-child(3) .stat-icon-luxury { background: var(--gradient-success); }

    .stat-menu {
        width: 40px;
        height: 40px;
        background: rgba(148, 163, 184, 0.1);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        z-index: 2;
    }

    .stat-menu:hover {
        background: var(--teal);
        color: white;
        transform: scale(1.1);
    }

    .stat-content {
        position: relative;
        z-index: 2;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--gray-500);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 900;
        color: var(--gray-900);
        line-height: 1;
        margin-bottom: 1rem;
        font-family: 'JetBrains Mono', monospace;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .trend-positive {
        color: var(--success);
        background: rgba(16, 185, 129, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .trend-neutral {
        color: var(--teal);
        background: rgba(20, 184, 166, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Premium Action Bar */
    .premium-action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .btn-create-luxury {
        background: var(--gradient-teal);
        color: white;
        text-decoration: none;
        padding: 1.25rem 2rem;
        border-radius: 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .btn-create-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-create-luxury:hover::before {
        left: 100%;
    }

    .btn-create-luxury:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        color: white;
        text-decoration: none;
    }

    /* Premium Table Container */
    .premium-table-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        position: relative;
    }

    .premium-table-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-teal);
    }

    .table-header-luxury {
        padding: 2rem 2.5rem;
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        background: rgba(248, 250, 252, 0.8);
        position: relative;
    }

    .table-title-luxury {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .table-icon-luxury {
        width: 50px;
        height: 50px;
        background: var(--gradient-teal);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: var(--shadow-md);
    }

    .table-wrapper-luxury {
        overflow-x: auto;
    }

    .custom-table-luxury {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        font-family: 'Outfit', sans-serif;
    }

    .custom-table-luxury th {
        background: rgba(248, 250, 252, 0.8);
        color: var(--gray-700);
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1.5rem 1.5rem;
        text-align: left;
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        white-space: nowrap;
        position: relative;
    }

    .custom-table-luxury th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, var(--teal), var(--primary));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .custom-table-luxury th:hover::after {
        transform: scaleX(1);
    }

    .custom-table-luxury td {
        padding: 1.5rem 1.5rem;
        border-bottom: 1px solid rgba(226, 232, 240, 0.3);
        font-size: 0.875rem;
        color: var(--gray-600);
        vertical-align: top;
        transition: all 0.3s ease;
    }

    .custom-table-luxury tr:last-child td {
        border-bottom: none;
    }

    .custom-table-luxury tbody tr {
        transition: all 0.3s ease;
        position: relative;
    }

    .custom-table-luxury tbody tr::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--gradient-teal);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .custom-table-luxury tbody tr:hover::before {
        transform: scaleY(1);
    }

    .custom-table-luxury tbody tr:hover {
        background: rgba(20, 184, 166, 0.02);
        transform: translateX(8px);
        box-shadow: var(--shadow-sm);
    }

    .custom-table-luxury tbody tr:hover td {
        color: var(--gray-800);
    }

    /* Status Badges Luxury */
    .status-badge-luxury {
        padding: 0.75rem 1.25rem;
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
        box-shadow: var(--shadow-sm);
    }

    .status-progress-luxury {
        background: rgba(245, 158, 11, 0.1);
        color: var(--accent);
        border: 1px solid rgba(245, 158, 11, 0.2);
        box-shadow: var(--shadow-sm);
    }

    .status-close-luxury {
        background: rgba(107, 114, 128, 0.1);
        color: var(--gray-500);
        border: 1px solid rgba(107, 114, 128, 0.2);
        box-shadow: var(--shadow-sm);
    }

    /* Action Buttons Luxury */
    .action-buttons-luxury {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-action-luxury {
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 80px;
        justify-content: center;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        box-shadow: var(--shadow-sm);
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

    .btn-view-luxury {
        background: rgba(99, 102, 241, 0.1);
        color: var(--primary);
        border-color: rgba(99, 102, 241, 0.2);
    }

    .btn-view-luxury:hover {
        background: rgba(99, 102, 241, 0.2);
        text-decoration: none;
        color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-edit-luxury {
        background: rgba(245, 158, 11, 0.1);
        color: var(--accent);
        border-color: rgba(245, 158, 11, 0.2);
    }

    .btn-edit-luxury:hover {
        background: rgba(245, 158, 11, 0.2);
        text-decoration: none;
        color: var(--accent);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-cancel-luxury {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
        border-color: rgba(239, 68, 68, 0.2);
    }

    .btn-cancel-luxury:hover {
        background: rgba(239, 68, 68, 0.2);
        color: var(--danger);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Date Display Luxury */
    .date-display-luxury {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        background: rgba(20, 184, 166, 0.1);
        color: var(--teal);
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        border: 1px solid rgba(20, 184, 166, 0.2);
        display: inline-block;
        box-shadow: var(--shadow-xs);
    }

    .date-details-luxury {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        line-height: 1.5;
        background: rgba(248, 250, 252, 0.8);
        padding: 1rem;
        border-radius: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.6);
    }

    .date-details-luxury strong {
        color: var(--gray-700);
        display: block;
        margin-bottom: 0.25rem;
    }

    /* Premium Empty State */
    .premium-empty-state {
        text-align: center;
        padding: 6rem 3rem;
        position: relative;
    }

    .empty-icon-luxury {
        width: 140px;
        height: 140px;
        background: var(--gradient-teal);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2.5rem;
        font-size: 4rem;
        color: white;
        box-shadow: var(--shadow-xl);
        position: relative;
        overflow: hidden;
    }

    .empty-icon-luxury::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: icon-shine 4s infinite;
    }

    @keyframes icon-shine {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    .empty-title-luxury {
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 1rem;
        background: var(--gradient-teal);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-description-luxury {
        font-size: 1.1rem;
        color: var(--gray-600);
        line-height: 1.6;
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
        
        .dashboard-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
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

        .premium-action-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .table-header-luxury {
            padding: 1.5rem;
        }

        .custom-table-luxury th,
        .custom-table-luxury td {
            padding: 1rem;
            font-size: 0.75rem;
        }

        .action-buttons-luxury {
            flex-direction: column;
        }

        .btn-action-luxury {
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

    .premium-table-container {
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
                    <h1 class="premium-title">{{ __('messages.ticket_list') }}</h1>
                    <p class="premium-subtitle">
                        Sistem dukungan teknis profesional dengan SLA tracking, escalation otomatis, dan komunikasi real-time untuk resolusi yang efisien
                    </p>
                    
                    <div class="premium-breadcrumb">
                        <a href="{{ url('/') }}" class="breadcrumb-link">
                            <i class='bx bx-home'></i>
                            {{ __('messages.home') }}
                        </a>
                        <span class="breadcrumb-separator">•</span>
                        <span class="breadcrumb-current">{{ __('messages.ticket_list') }}</span>
                    </div>
                </div>
                
                <div class="header-visual">
                    <div class="visual-masterpiece">
                        <div class="visual-ring ring-1"></div>
                        <div class="visual-ring ring-2"></div>
                        <div class="visual-ring ring-3"></div>
                        
                        <div class="visual-center">
                            <i class='bx bx-receipt'></i>
                        </div>
                        
                        <div class="visual-icons">
                            <div class="floating-icon icon-1">
                                <i class='bx bx-support'></i>
                            </div>
                            <div class="floating-icon icon-2">
                                <i class='bx bx-time'></i>
                            </div>
                            <div class="floating-icon icon-3">
                                <i class='bx bx-check-circle'></i>
                            </div>
                            <div class="floating-icon icon-4">
                                <i class='bx bx-message-dots'></i>
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
            <div class="dashboard-grid">
                <div class="luxury-stat-card">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <button class="stat-menu">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Tickets</div>
                        <div class="stat-number">{{ str_pad($tickets->count(), 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="stat-trend">
                            <div class="trend-positive">
                                <i class='bx bx-trending-up'></i>
                                All requests tracked
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="luxury-stat-card">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class='bx bx-time'></i>
                        </div>
                        <button class="stat-menu">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">In Progress</div>
                        <div class="stat-number">{{ str_pad($tickets->where('status', 'progress')->count(), 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="stat-trend">
                            <div class="trend-neutral">
                                <i class='bx bx-loader-alt'></i>
                                Being processed
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="luxury-stat-card">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class='bx bx-check-circle'></i>
                        </div>
                        <button class="stat-menu">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Completed</div>
                        <div class="stat-number">{{ str_pad($tickets->where('status', 'close')->count(), 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="stat-trend">
                            <div class="trend-positive">
                                <i class='bx bx-trophy'></i>
                                Successfully resolved
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="luxury-dashboard">
        <div class="container">
            <div class="premium-action-bar">
                <div></div>
                <a href="{{ route('tickets.create') }}" class="btn-create-luxury">
                    <i class='bx bx-plus'></i>
                    <span>{{ __('messages.create_ticket') }}</span>
                </a>
            </div>

            <div class="premium-table-container luxury-fade-up">
                <div class="table-header-luxury">
                    <h3 class="table-title-luxury">
                        <div class="table-icon-luxury">
                            <i class='bx bx-receipt'></i>
                        </div>
                        {{ __('messages.ticket_list') }}
                    </h3>
                </div>
                
                <div class="table-wrapper-luxury">
                    <table class="custom-table-luxury">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('messages.service_type') }}</th>
                                <th>{{ __('messages.service_description') }}</th>
                                <th>{{ __('messages.submission_date') }}</th>
                                <th>{{ __('messages.status') }}</th>
                                <th>{{ __('messages.action_date') }}</th>
                                <th>{{ __('messages.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $key => $ticket)
                                <tr>
                                    <td><strong>{{ $key + 1 }}</strong></td>
                                    <td>{{ $ticket->jenis_layanan }}</td>
                                    <td>{{ Str::limit($ticket->keterangan_layanan, 50) }}</td>
                                    <td>
                                        <span class="date-display-luxury">
                                            {{ \Carbon\Carbon::parse($ticket->tgl_pengajuan)->format('M d, Y') }}
                                        </span>
                                    </td>
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
                                    <td>
                                        @if($ticket->status == 'open')
                                            <span style="color: var(--gray-500); font-style: italic; font-size: 0.875rem;">{{ __('messages.not_processed') }}</span>
                                        @elseif($ticket->status == 'progress' && $ticket->tgl_mulai_tindakan)
                                            <div class="date-details-luxury">
                                                <strong>{{ __('messages.start_date') }}:</strong>
                                                {{ \Carbon\Carbon::parse($ticket->tgl_mulai_tindakan)->format('M d, Y') }}
                                            </div>
                                        @elseif($ticket->status == 'close' && $ticket->tgl_mulai_tindakan && $ticket->tgl_selesai_tindakan)
                                            <div class="date-details-luxury">
                                                <strong>{{ __('messages.start_date') }}:</strong>
                                                {{ \Carbon\Carbon::parse($ticket->tgl_mulai_tindakan)->format('M d, Y') }}
                                                <br>
                                                <strong>{{ __('messages.end_date') }}:</strong>
                                                {{ \Carbon\Carbon::parse($ticket->tgl_selesai_tindakan)->format('M d, Y') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons-luxury">
                                            <a href="{{ route('tickets.show', $ticket->id_after_sales) }}" class="btn-action-luxury btn-view-luxury">
                                                <i class='bx bx-show'></i>
                                                <span>{{ __('messages.view') }}</span>
                                            </a>

                                            @if($ticket->status == 'open')
                                                <a href="{{ route('tickets.edit', $ticket->id_after_sales) }}" class="btn-action-luxury btn-edit-luxury">
                                                    <i class='bx bx-edit'></i>
                                                    <span>{{ __('messages.edit') }}</span>
                                                </a>

                                                <form action="{{ route('tickets.cancel', $ticket->id_after_sales) }}" method="POST" style="display:inline;" 
                                                      onsubmit="return confirm('Are you sure you want to cancel this ticket?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn-action-luxury btn-cancel-luxury">
                                                        <i class='bx bx-x'></i>
                                                        <span>{{ __('messages.cancel') }}</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="premium-empty-state">
                                            <div class="empty-icon-luxury">
                                                <i class='bx bx-receipt'></i>
                                            </div>
                                            <h3 class="empty-title-luxury">{{ __('messages.no_tickets') }}</h3>
                                            <p class="empty-description-luxury">
                                                You haven't created any support tickets yet. Click the "Create Ticket" button to get started.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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

    // Premium counter animation with enhanced easing
    function animateLuxuryCounters() {
        const counters = document.querySelectorAll('.stat-number');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const finalValue = target.textContent.trim();
                    
                    if (!isNaN(parseInt(finalValue))) {
                        animateLuxuryNumber(target, 0, parseInt(finalValue), '');
                    }
                    
                    counterObserver.unobserve(target);
                }
            });
        }, { threshold: 0.6 });

        counters.forEach(counter => counterObserver.observe(counter));
    }

    function animateLuxuryNumber(element, start, end, suffix) {
        const duration = 2500;
        const startTime = performance.now();
        
        function updateNumber(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Luxury easing function (ease-out-back with bounce)
            const easeOutBack = 1 + 2.7 * Math.pow(progress - 1, 3) + 1.7 * Math.pow(progress - 1, 2);
            const current = Math.round(start + (end - start) * Math.min(easeOutBack, 1));
            
            element.textContent = current.toString().padStart(2, '0') + suffix;
            
            if (progress < 1) {
                requestAnimationFrame(updateNumber);
            }
        }
        
        requestAnimationFrame(updateNumber);
    }

    // Initialize luxury animations
    animateLuxuryCounters();

    // Enhanced table row interactions with 3D effect
    document.querySelectorAll('.custom-table-luxury tbody tr').forEach(row => {
        if (row.querySelector('td') && !row.querySelector('.premium-empty-state')) {
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
                
                this.style.transform = `translateX(8px) rotateY(${rotateY}deg)`;
            });
        }
    });

    // Premium button interactions with ripple effect
    document.querySelectorAll('.btn-action-luxury, .btn-create-luxury').forEach(btn => {
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

    // Enhanced stat card interactions
    document.querySelectorAll('.luxury-stat-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-18px) scale(1.03)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>
@endsection