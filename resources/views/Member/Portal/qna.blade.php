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
        background: var(--gradient-secondary);
        top: 15%;
        right: 10%;
        animation-delay: 0s;
    }

    .orb-2 {
        width: 200px;
        height: 200px;
        background: var(--gradient-violet);
        top: 65%;
        left: 15%;
        animation-delay: -10s;
    }

    .orb-3 {
        width: 150px;
        height: 150px;
        background: var(--gradient-rose);
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
            var(--secondary), 
            var(--violet), 
            var(--rose), 
            var(--accent), 
            var(--primary), 
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
            var(--secondary) 25%, 
            var(--violet) 50%, 
            var(--rose) 75%, 
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

    .header-badges {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .premium-badge {
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
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

    .badge-ai { background: var(--gradient-secondary); }
    .badge-expert { background: var(--gradient-violet); }
    .badge-database { background: var(--gradient-rose); }

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
        border-color: var(--secondary);
        animation: rotate-ring 20s linear infinite;
    }

    .ring-2 {
        width: 80%;
        height: 80%;
        top: 10%;
        left: 10%;
        border-color: var(--violet);
        animation: rotate-ring 15s linear infinite reverse;
    }

    .ring-3 {
        width: 60%;
        height: 60%;
        top: 20%;
        left: 20%;
        border-color: var(--rose);
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
        background: var(--gradient-secondary);
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
        background: var(--gradient-violet);
        animation-delay: 0s;
    }

    .icon-2 {
        top: 50%;
        right: 0;
        background: var(--gradient-rose);
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
        background: var(--gradient-success);
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
        background: var(--gradient-secondary);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .luxury-stat-card:nth-child(2)::before { background: var(--gradient-violet); }
    .luxury-stat-card:nth-child(3)::before { background: var(--gradient-rose); }

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
        background: radial-gradient(circle, rgba(6, 182, 212, 0.05) 0%, transparent 70%);
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
        border-color: rgba(6, 182, 212, 0.3);
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

    .luxury-stat-card:nth-child(1) .stat-icon-luxury { background: var(--gradient-secondary); }
    .luxury-stat-card:nth-child(2) .stat-icon-luxury { background: var(--gradient-violet); }
    .luxury-stat-card:nth-child(3) .stat-icon-luxury { background: var(--gradient-rose); }

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
        background: var(--secondary);
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
        color: var(--secondary);
        background: rgba(6, 182, 212, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Premium QnA Section */
    .premium-qna {
        padding: 3rem 0 6rem;
    }

    .qna-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Premium Search Box */
    .premium-search-container {
        margin-bottom: 3rem;
        position: relative;
    }

    .premium-search-box {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        padding: 1.5rem 2rem 1.5rem 4rem;
        width: 100%;
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--gray-900);
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .premium-search-box:focus {
        outline: none;
        border-color: var(--secondary);
        box-shadow: var(--shadow-xl);
        transform: translateY(-2px);
    }

    .premium-search-box::placeholder {
        color: var(--gray-500);
        font-weight: 400;
    }

    .search-icon-luxury {
        position: absolute;
        left: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.5rem;
        color: var(--secondary);
        z-index: 3;
    }

    .premium-search-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-secondary);
        border-radius: 2rem 2rem 0 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .premium-search-container:focus-within::before {
        opacity: 1;
    }

    /* Premium FAQ Items */
    .premium-faq-grid {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .premium-faq-item {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        box-shadow: var(--shadow);
    }

    .premium-faq-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--gradient-secondary);
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.4s ease;
    }

    .premium-faq-item:nth-child(2)::before { background: var(--gradient-violet); }
    .premium-faq-item:nth-child(3)::before { background: var(--gradient-rose); }
    .premium-faq-item:nth-child(4)::before { background: var(--gradient-accent); }
    .premium-faq-item:nth-child(5)::before { background: var(--gradient-success); }
    .premium-faq-item:nth-child(6)::before { background: var(--gradient-primary); }

    .premium-faq-item.active::before {
        transform: scaleY(1);
    }

    .premium-faq-item:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: var(--shadow-2xl);
        border-color: rgba(6, 182, 212, 0.3);
    }

    .accordion-luxury {
        border: none;
        background: transparent;
    }

    .accordion-item-luxury {
        background: transparent;
        border: none;
    }

    .accordion-header-luxury {
        margin-bottom: 0;
    }

    .accordion-button-luxury {
        background: transparent;
        border: none;
        border-radius: 0;
        padding: 2rem 2.5rem;
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-900);
        text-align: left;
        width: 100%;
        position: relative;
        transition: all 0.3s ease;
        box-shadow: none;
        font-family: 'Outfit', sans-serif;
    }

    .accordion-button-luxury:not(.collapsed) {
        background: transparent;
        color: var(--gray-900);
        box-shadow: none;
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
    }

    .accordion-button-luxury::after {
        content: '';
        position: absolute;
        right: 2.5rem;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: var(--gradient-secondary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
    }

    .accordion-button-luxury::after {
        background-image: none;
        content: '+';
        font-weight: 300;
    }

    .accordion-button-luxury:not(.collapsed)::after {
        content: '−';
        transform: translateY(-50%) rotate(180deg);
        background: var(--gradient-rose);
    }

    .premium-faq-item:nth-child(2) .accordion-button-luxury::after { background: var(--gradient-violet); }
    .premium-faq-item:nth-child(3) .accordion-button-luxury::after { background: var(--gradient-rose); }
    .premium-faq-item:nth-child(4) .accordion-button-luxury::after { background: var(--gradient-accent); }
    .premium-faq-item:nth-child(5) .accordion-button-luxury::after { background: var(--gradient-success); }
    .premium-faq-item:nth-child(6) .accordion-button-luxury::after { background: var(--gradient-primary); }

    .accordion-button-luxury:focus {
        box-shadow: none;
        border-color: transparent;
    }

    .accordion-collapse-luxury {
        border: none;
    }

    .accordion-body-luxury {
        padding: 0 2.5rem 2.5rem;
        font-size: 1rem;
        line-height: 1.8;
        color: var(--gray-600);
        position: relative;
        z-index: 2;
    }

    .faq-answer-luxury {
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .faq-image-luxury {
        max-width: 100%;
        height: auto;
        border-radius: 1.5rem;
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .faq-image-luxury:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-xl);
    }

    /* Premium Empty State */
    .premium-empty-state {
        text-align: center;
        padding: 6rem 3rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        max-width: 700px;
        margin: 0 auto;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .premium-empty-state::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-secondary);
    }

    .empty-icon-luxury {
        width: 140px;
        height: 140px;
        background: var(--gradient-secondary);
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
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 1rem;
        background: var(--gradient-secondary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-subtitle-luxury {
        font-size: 1.2rem;
        color: var(--gray-600);
        line-height: 1.6;
        margin-bottom: 2.5rem;
    }

    .empty-action-luxury {
        background: var(--gradient-secondary);
        color: white;
        text-decoration: none;
        padding: 1.25rem 2.5rem;
        border-radius: 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .empty-action-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .empty-action-luxury:hover::before {
        left: 100%;
    }

    .empty-action-luxury:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        color: white;
        text-decoration: none;
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
        
        .qna-container {
            padding: 0 1rem;
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

        .accordion-button-luxury {
            padding: 1.5rem 1.5rem 1.5rem 2rem;
            font-size: 1rem;
        }

        .accordion-button-luxury::after {
            right: 1.5rem;
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }

        .accordion-body-luxury {
            padding: 0 2rem 2rem;
        }

        .premium-search-box {
            padding: 1.25rem 1.5rem 1.25rem 3.5rem;
            font-size: 1rem;
        }

        .search-icon-luxury {
            left: 1.25rem;
            font-size: 1.25rem;
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

    .premium-faq-item:nth-child(1) { animation-delay: 0.1s; }
    .premium-faq-item:nth-child(2) { animation-delay: 0.15s; }
    .premium-faq-item:nth-child(3) { animation-delay: 0.2s; }
    .premium-faq-item:nth-child(4) { animation-delay: 0.25s; }
    .premium-faq-item:nth-child(5) { animation-delay: 0.3s; }
    .premium-faq-item:nth-child(6) { animation-delay: 0.35s; }

    /* Hidden State for Search */
    .faq-hidden {
        display: none !important;
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
                    <h1 class="premium-title">{{ __('messages.qna') }}</h1>
                    <p class="premium-subtitle">
                        Sistem tanya jawab dengan AI-powered search, komunitas expert, dan database solusi lengkap untuk mendapatkan jawaban yang akurat dan cepat
                    </p>
                    
                    <div class="header-badges">
                        <div class="premium-badge badge-ai">
                            <i class='bx bx-brain'></i>
                            AI-Powered Search
                        </div>
                        <div class="premium-badge badge-expert">
                            <i class='bx bx-user-check'></i>
                            Expert Community
                        </div>
                        <div class="premium-badge badge-database">
                            <i class='bx bx-data'></i>
                            Complete Database
                        </div>
                    </div>
                </div>
                
                <div class="header-visual">
                    <div class="visual-masterpiece">
                        <div class="visual-ring ring-1"></div>
                        <div class="visual-ring ring-2"></div>
                        <div class="visual-ring ring-3"></div>
                        
                        <div class="visual-center">
                            <i class='bx bx-help-circle'></i>
                        </div>
                        
                        <div class="visual-icons">
                            <div class="floating-icon icon-1">
                                <i class='bx bx-brain'></i>
                            </div>
                            <div class="floating-icon icon-2">
                                <i class='bx bx-search'></i>
                            </div>
                            <div class="floating-icon icon-3">
                                <i class='bx bx-data'></i>
                            </div>
                            <div class="floating-icon icon-4">
                                <i class='bx bx-user-check'></i>
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
                            <i class='bx bx-help-circle'></i>
                        </div>
                        <button class="stat-menu">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Questions</div>
                        <div class="stat-number">{{ isset($faqs) ? str_pad($faqs->count(), 2, '0', STR_PAD_LEFT) : '00' }}</div>
                        <div class="stat-trend">
                            <div class="trend-positive">
                                <i class='bx bx-trending-up'></i>
                                Available answers
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="luxury-stat-card">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class='bx bx-image'></i>
                        </div>
                        <button class="stat-menu">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">With Images</div>
                        <div class="stat-number">{{ isset($faqs) ? str_pad($faqs->whereNotNull('image')->count(), 2, '0', STR_PAD_LEFT) : '00' }}</div>
                        <div class="stat-trend">
                            <div class="trend-neutral">
                                <i class='bx bx-check-circle'></i>
                                Visual support
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
                        <div class="stat-label">Avg. Response</div>
                        <div class="stat-number">2m</div>
                        <div class="stat-trend">
                            <div class="trend-positive">
                                <i class='bx bx-time-five'></i>
                                Quick answers
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium QnA Section -->
    <div class="premium-qna">
        <div class="qna-container">
            <!-- Premium Search Box -->
            <div class="premium-search-container">
                <div class="position-relative">
                    <i class='bx bx-search search-icon-luxury'></i>
                    <input type="text" class="premium-search-box" placeholder="Search questions..." id="searchFaq">
                </div>
            </div>

            <!-- FIXED: Removed nested loops -->
            @if(isset($faqs) && $faqs->count() > 0)
                <div class="premium-faq-grid">
                    @foreach($faqs as $faq)
                        <div class="premium-faq-item luxury-fade-up" data-question="{{ strtolower($faq->pertanyaan) }}">
                            <div class="accordion accordion-luxury" id="qnaAccordion-{{ $faq->id }}">
                                <div class="accordion-item accordion-item-luxury">
                                    <h2 class="accordion-header accordion-header-luxury" id="heading{{ $faq->id }}">
                                        <button class="accordion-button accordion-button-luxury collapsed" 
                                                type="button" 
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $faq->id }}" 
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->pertanyaan }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" 
                                         class="accordion-collapse accordion-collapse-luxury collapse"
                                         aria-labelledby="heading{{ $faq->id }}"
                                         data-bs-parent="#qnaAccordion-{{ $faq->id }}">
                                        <div class="accordion-body accordion-body-luxury">
                                            <div class="faq-answer-luxury">
                                                {{ $faq->jawaban }}
                                            </div>
                                            @if ($faq->image)
                                                <img src="{{ asset($faq->image) }}" 
                                                     alt="FAQ Supporting Image" 
                                                     class="faq-image-luxury">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="premium-empty-state">
                    <div class="empty-icon-luxury">
                        <i class='bx bx-help-circle'></i>
                    </div>
                    <h2 class="empty-title-luxury">No FAQs Available</h2>
                    <p class="empty-subtitle-luxury">
                        There are currently no frequently asked questions available. Please check back later or contact support for assistance.
                    </p>
                    <a href="{{ route('portal') }}" class="empty-action-luxury">
                        <i class='bx bx-home'></i>
                        <span>Back to Portal</span>
                    </a>
                </div>
            @endif
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
                    
                    if (finalValue.includes('m')) {
                        // Skip animation for time values
                        return;
                    } else if (!isNaN(parseInt(finalValue))) {
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

    // Premium accordion state tracking with luxury effects
    document.querySelectorAll('.accordion-button-luxury').forEach(button => {
        button.addEventListener('click', function() {
            const faqItem = this.closest('.premium-faq-item');
            const allItems = document.querySelectorAll('.premium-faq-item');
            
            setTimeout(() => {
                // Remove active state from all items
                allItems.forEach(item => item.classList.remove('active'));
                
                // Add active state to current item if expanded
                if (!this.classList.contains('collapsed')) {
                    faqItem.classList.add('active');
                }
            }, 100);
        });
    });

    // Premium search functionality with luxury animations
    const searchBox = document.getElementById('searchFaq');
    const faqItems = document.querySelectorAll('.premium-faq-item');

    if (searchBox && faqItems.length > 0) {
        searchBox.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let visibleCount = 0;
            
            faqItems.forEach((item, index) => {
                const question = item.getAttribute('data-question');
                if (question && question.includes(searchTerm)) {
                    item.classList.remove('faq-hidden');
                    item.style.animationDelay = (visibleCount * 0.05) + 's';
                    visibleCount++;
                } else {
                    item.classList.add('faq-hidden');
                }
            });
        });
    }

    // Enhanced FAQ item interactions with 3D effect
    document.querySelectorAll('.premium-faq-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            if (this.querySelector('.accordion-button-luxury').classList.contains('collapsed')) {
                this.style.zIndex = '10';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
            this.style.transform = 'translateY(0) scale(1) rotateX(0) rotateY(0)';
        });
        
        item.addEventListener('mousemove', function(e) {
            if (!this.querySelector('.accordion-button-luxury').classList.contains('collapsed')) {
                return;
            }
            
            const rect = this.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const mouseX = e.clientX - centerX;
            const mouseY = e.clientY - centerY;
            
            const rotateX = (mouseY / rect.height) * 3;
            const rotateY = (mouseX / rect.width) * 3;
            
            this.style.transform = `translateY(-8px) scale(1.01) rotateX(${-rotateX}deg) rotateY(${rotateY}deg)`;
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

    // Enhanced stat card interactions
    document.querySelectorAll('.luxury-stat-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-18px) scale(1.03)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Enhanced image interactions
    document.querySelectorAll('.faq-image-luxury').forEach(img => {
        img.addEventListener('click', function() {
            // Create luxury image modal (optional)
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 1000;
                backdrop-filter: blur(20px);
            `;
            
            const modalImg = this.cloneNode();
            modalImg.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                border-radius: 1.5rem;
                box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.5);
            `;
            
            modal.appendChild(modalImg);
            document.body.appendChild(modal);
            
            modal.addEventListener('click', () => {
                modal.remove();
            });
        });
    });

    // Add search enhancement with typing indicator
    let searchTimeout;
    if (searchBox) {
        searchBox.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            this.style.background = 'rgba(255, 255, 255, 0.8)';
            
            searchTimeout = setTimeout(() => {
                this.style.background = 'rgba(255, 255, 255, 0.95)';
            }, 300);
        });
    }
});
</script>
@endsection