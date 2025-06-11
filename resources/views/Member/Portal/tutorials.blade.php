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
            var(--secondary), 
            var(--violet), 
            var(--success), 
            var(--accent), 
            var(--primary), 
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
            var(--secondary) 25%, 
            var(--violet) 50%, 
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

    .badge-interactive { background: var(--gradient-secondary); }
    .badge-tracking { background: var(--gradient-violet); }
    .badge-personalized { background: var(--gradient-success); }

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
        background: var(--gradient-rose);
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

    /* Premium Tutorials Section */
    .premium-tutorials {
        padding: 3rem 0 6rem;
    }

    /* Premium Tutorial Grid */
    .premium-tutorials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(420px, 1fr));
        gap: 2.5rem;
    }

    .premium-tutorial-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        box-shadow: var(--shadow);
        group: hover;
    }

    .premium-tutorial-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-secondary);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .premium-tutorial-card:nth-child(2)::before { background: var(--gradient-violet); }
    .premium-tutorial-card:nth-child(3)::before { background: var(--gradient-success); }
    .premium-tutorial-card:nth-child(4)::before { background: var(--gradient-accent); }
    .premium-tutorial-card:nth-child(5)::before { background: var(--gradient-rose); }
    .premium-tutorial-card:nth-child(6)::before { background: var(--gradient-primary); }

    .premium-tutorial-card:hover::before {
        transform: scaleX(1);
    }

    .premium-tutorial-card:hover {
        transform: translateY(-20px) scale(1.02);
        box-shadow: var(--shadow-2xl);
        border-color: rgba(6, 182, 212, 0.3);
    }

    .tutorial-image-luxury {
        position: relative;
        height: 300px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
    }

    .tutorial-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .premium-tutorial-card:hover .tutorial-image {
        transform: scale(1.15) rotate(2deg);
    }

    .tutorial-overlay-luxury {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, 
            rgba(6, 182, 212, 0.1), 
            rgba(124, 58, 237, 0.1),
            rgba(16, 185, 129, 0.1)
        );
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .premium-tutorial-card:hover .tutorial-overlay-luxury {
        opacity: 1;
    }

    .play-overlay-luxury {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: rgba(6, 182, 212, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        backdrop-filter: blur(20px);
        box-shadow: var(--shadow-xl);
        transition: all 0.3s ease;
        z-index: 10;
    }

    .premium-tutorial-card:hover .play-overlay-luxury {
        transform: translate(-50%, -50%) scale(1.2);
        background: rgba(6, 182, 212, 1);
    }

    .tutorial-content-luxury {
        padding: 2.5rem;
        position: relative;
        z-index: 2;
    }

    .tutorial-category-luxury {
        font-size: 0.75rem;
        color: var(--secondary);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .category-dot {
        width: 8px;
        height: 8px;
        background: var(--secondary);
        border-radius: 50%;
        animation: pulse-dot 2s infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    .tutorial-title-luxury {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .tutorial-description-luxury {
        font-size: 1rem;
        color: var(--gray-600);
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    /* Video Items Luxury */
    .video-items-luxury {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .video-item-luxury {
        background: rgba(248, 250, 252, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 1.5rem;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .video-item-luxury::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--gradient-secondary);
    }

    .video-item-luxury:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateX(8px);
        box-shadow: var(--shadow-md);
    }

    .video-item-title-luxury {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .video-icon-luxury {
        width: 40px;
        height: 40px;
        background: var(--gradient-secondary);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        box-shadow: var(--shadow-md);
    }

    .video-actions-luxury {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 1rem;
        align-items: center;
    }

    .btn-luxury {
        padding: 1rem 1.5rem;
        border-radius: 1.25rem;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
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

    .btn-download-luxury {
        background: var(--gradient-secondary);
        color: white;
        box-shadow: var(--shadow-lg);
    }

    .btn-play-luxury {
        background: rgba(148, 163, 184, 0.1);
        color: var(--gray-700);
        border: 2px solid rgba(148, 163, 184, 0.2);
        box-shadow: var(--shadow);
        width: 50px;
        height: 50px;
        padding: 0;
        border-radius: 1rem;
    }

    .premium-tutorial-card:nth-child(2) .btn-download-luxury { background: var(--gradient-violet); }
    .premium-tutorial-card:nth-child(3) .btn-download-luxury { background: var(--gradient-success); }
    .premium-tutorial-card:nth-child(4) .btn-download-luxury { background: var(--gradient-accent); }
    .premium-tutorial-card:nth-child(5) .btn-download-luxury { background: var(--gradient-rose); }
    .premium-tutorial-card:nth-child(6) .btn-download-luxury { background: var(--gradient-primary); }

    .btn-download-luxury:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        color: white;
        text-decoration: none;
    }

    .btn-play-luxury:hover {
        background: var(--gradient-secondary);
        color: white;
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
        text-decoration: none;
    }

    .premium-tutorial-card:nth-child(2) .btn-play-luxury:hover { background: var(--gradient-violet); }
    .premium-tutorial-card:nth-child(3) .btn-play-luxury:hover { background: var(--gradient-success); }
    .premium-tutorial-card:nth-child(4) .btn-play-luxury:hover { background: var(--gradient-accent); }
    .premium-tutorial-card:nth-child(5) .btn-play-luxury:hover { background: var(--gradient-rose); }
    .premium-tutorial-card:nth-child(6) .btn-play-luxury:hover { background: var(--gradient-primary); }

    /* No Videos State */
    .no-videos-luxury {
        background: rgba(248, 250, 252, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 1.5rem;
        padding: 2rem;
        text-align: center;
        color: var(--gray-500);
        font-style: italic;
        position: relative;
        overflow: hidden;
    }

    .no-videos-luxury::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--gray-300);
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

    /* Video Modal Luxury */
    .modal-content-luxury {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        box-shadow: var(--shadow-2xl);
        overflow: hidden;
    }

    .modal-header-luxury {
        background: rgba(248, 250, 252, 0.8);
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        padding: 1.5rem 2rem;
        position: relative;
    }

    .modal-header-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-secondary);
    }

    .modal-title-luxury {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
    }

    .btn-close-luxury {
        width: 40px;
        height: 40px;
        background: rgba(148, 163, 184, 0.1);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-500);
        font-size: 1.25rem;
        transition: all 0.2s ease;
    }

    .btn-close-luxury:hover {
        background: var(--gray-200);
        color: var(--gray-700);
        transform: scale(1.1);
    }

    .modal-body-luxury {
        padding: 0;
        position: relative;
    }

    #modalVideo {
        width: 100%;
        height: auto;
        border-radius: 0 0 2rem 2rem;
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
        
        .premium-tutorials-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
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

        .video-actions-luxury {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .btn-play-luxury {
            width: 100%;
            height: 50px;
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

    .premium-tutorial-card:nth-child(1) { animation-delay: 0.1s; }
    .premium-tutorial-card:nth-child(2) { animation-delay: 0.2s; }
    .premium-tutorial-card:nth-child(3) { animation-delay: 0.3s; }
    .premium-tutorial-card:nth-child(4) { animation-delay: 0.4s; }
    .premium-tutorial-card:nth-child(5) { animation-delay: 0.5s; }
    .premium-tutorial-card:nth-child(6) { animation-delay: 0.6s; }
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
                    <h1 class="premium-title">{{ __('messages.tutorials') }}</h1>
                    <p class="premium-subtitle">
                        Video pembelajaran interaktif dengan progress tracking, quiz terintegrasi, dan learning path yang dipersonalisasi untuk skill development optimal
                    </p>
                    
                    <div class="header-badges">
                        <div class="premium-badge badge-interactive">
                            <i class='bx bx-play-circle'></i>
                            Interactive Learning
                        </div>
                        <div class="premium-badge badge-tracking">
                            <i class='bx bx-trending-up'></i>
                            Progress Tracking
                        </div>
                        <div class="premium-badge badge-personalized">
                            <i class='bx bx-user-check'></i>
                            Personalized Path
                        </div>
                    </div>
                </div>
                
                <div class="header-visual">
                    <div class="visual-masterpiece">
                        <div class="visual-ring ring-1"></div>
                        <div class="visual-ring ring-2"></div>
                        <div class="visual-ring ring-3"></div>
                        
                        <div class="visual-center">
                            <i class='bx bx-video'></i>
                        </div>
                        
                        <div class="visual-icons">
                            <div class="floating-icon icon-1">
                                <i class='bx bx-play'></i>
                            </div>
                            <div class="floating-icon icon-2">
                                <i class='bx bx-download'></i>
                            </div>
                            <div class="floating-icon icon-3">
                                <i class='bx bx-trending-up'></i>
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
                            <i class='bx bx-video'></i>
                        </div>
                        <button class="stat-menu">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Tutorials</div>
                        <div class="stat-number">{{ isset($uniqueProduks) ? str_pad($uniqueProduks->count(), 2, '0', STR_PAD_LEFT) : '00' }}</div>
                        <div class="stat-trend">
                            <div class="trend-positive">
                                <i class='bx bx-trending-up'></i>
                                Available products
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="luxury-stat-card">
                    <div class="stat-header">
                        <div class="stat-icon-luxury">
                            <i class='bx bx-play-circle'></i>
                        </div>
                        <button class="stat-menu">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">With Videos</div>
                        <div class="stat-number">{{ isset($uniqueProduks) ? str_pad($uniqueProduks->filter(function($produk) { return $produk->videos->count() > 0; })->count(), 2, '0', STR_PAD_LEFT) : '00' }}</div>
                        <div class="stat-trend">
                            <div class="trend-neutral">
                                <i class='bx bx-check-circle'></i>
                                Ready to watch
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
                        <div class="stat-label">Avg. Watch Time</div>
                        <div class="stat-number">8m</div>
                        <div class="stat-trend">
                            <div class="trend-positive">
                                <i class='bx bx-time-five'></i>
                                Quick learning
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Tutorials Section -->
    <div class="premium-tutorials">
        <div class="container">
            @forelse($uniqueProduks as $produk)
                <div class="premium-tutorials-grid">
                    @foreach($uniqueProduks as $produk)
                        <div class="premium-tutorial-card luxury-fade-up">
                            <div class="tutorial-image-luxury">
                                <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" 
                                     class="tutorial-image" 
                                     alt="{{ $produk->nama }}">
                                <div class="tutorial-overlay-luxury"></div>
                                <div class="play-overlay-luxury">
                                    <i class='bx bx-play'></i>
                                </div>
                            </div>
                            
                            <div class="tutorial-content-luxury">
                                <div class="tutorial-category-luxury">
                                    <div class="category-dot"></div>
                                    Product Video Tutorial
                                </div>
                                
                                <h3 class="tutorial-title-luxury">{{ $produk->nama }}</h3>
                                <p class="tutorial-description-luxury">{{ Str::limit($produk->kegunaan, 120) }}</p>
                                
                                <div class="video-items-luxury">
                                    @forelse($produk->videos as $video)
                                        <div class="video-item-luxury">
                                            <div class="video-item-title-luxury">
                                                <div class="video-icon-luxury">
                                                    <i class='bx bx-video'></i>
                                                </div>
                                                <span>Video Tutorial {{ $loop->iteration }}</span>
                                            </div>
                                            <div class="video-actions-luxury">
                                                <a href="{{ asset($video->video) }}"
                                                   download="{{ $produk->nama }}_{{ $loop->iteration }}_tutorial.mp4"
                                                   class="btn-luxury btn-download-luxury">
                                                    <i class='bx bx-download'></i>
                                                    <span>Download Video</span>
                                                </a>
                                                <button class="btn-luxury btn-play-luxury"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#videoModal"
                                                        data-video="{{ asset($video->video) }}"
                                                        data-title="{{ $produk->nama }} - Tutorial {{ $loop->iteration }}"
                                                        title="Play Video">
                                                    <i class='bx bx-play'></i>
                                                </button>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="no-videos-luxury">
                                            <i class='bx bx-info-circle' style="margin-right: 8px;"></i>
                                            No video tutorials available for this product
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="premium-empty-state">
                    <div class="empty-icon-luxury">
                        <i class='bx bx-video'></i>
                    </div>
                    <h2 class="empty-title-luxury">No Tutorials Available</h2>
                    <p class="empty-subtitle-luxury">
                        You don't have any products associated with your account yet. Video tutorials will appear here once products are available.
                    </p>
                    <a href="{{ route('portal') }}" class="empty-action-luxury">
                        <i class='bx bx-home'></i>
                        <span>Back to Portal</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Video Modal Luxury -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-content-luxury">
            <div class="modal-header modal-header-luxury">
                <h5 class="modal-title modal-title-luxury" id="videoModalLabel">Video Tutorial</h5>
                <button type="button" class="btn-close btn-close-luxury" data-bs-dismiss="modal" aria-label="Close">
                    <i class='bx bx-x'></i>
                </button>
            </div>
            <div class="modal-body modal-body-luxury">
                <video id="modalVideo" class="w-100" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
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

    // Enhanced image loading with luxury effects
    const images = document.querySelectorAll('.tutorial-image');
    images.forEach(img => {
        img.style.opacity = '0';
        img.style.filter = 'blur(5px) brightness(0.8)';
        img.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        
        img.addEventListener('load', function() {
            this.style.opacity = '1';
            this.style.filter = 'blur(0px) brightness(1)';
        });
        
        if (img.complete) {
            img.style.opacity = '1';
            img.style.filter = 'blur(0px) brightness(1)';
        }
    });

    // Premium tutorial card interactions with 3D effect
    document.querySelectorAll('.premium-tutorial-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '20';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
            this.style.transform = 'translateY(0) scale(1) rotateX(0) rotateY(0)';
        });
        
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const mouseX = e.clientX - centerX;
            const mouseY = e.clientY - centerY;
            
            const rotateX = (mouseY / rect.height) * 5;
            const rotateY = (mouseX / rect.width) * 5;
            
            this.style.transform = `translateY(-20px) scale(1.02) rotateX(${-rotateX}deg) rotateY(${rotateY}deg)`;
        });
    });

    // Initialize luxury animations
    animateLuxuryCounters();

    // Premium button interactions with ripple effect
    document.querySelectorAll('.btn-luxury').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.disabled) return;
            
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
            
            // Premium loading state for download
            if (this.hasAttribute('download')) {
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Downloading...';
                this.style.pointerEvents = 'none';
                
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    this.style.pointerEvents = 'auto';
                }, 2000);
            }
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

    // Video Modal functionality with luxury enhancements
    var videoModal = document.getElementById('videoModal');

    videoModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var videoSrc = button.getAttribute('data-video');
        var videoTitle = button.getAttribute('data-title');
        var modalVideo = videoModal.querySelector('#modalVideo');
        var videoSource = modalVideo.querySelector('source');
        var modalTitle = videoModal.querySelector('#videoModalLabel');

        if (videoSrc) {
            videoSource.src = videoSrc;
            modalVideo.load();
        }
        
        if (videoTitle) {
            modalTitle.textContent = videoTitle;
        }

        // Add luxury loading effect
        modalVideo.style.opacity = '0';
        modalVideo.addEventListener('loadeddata', function() {
            this.style.transition = 'opacity 0.6s ease';
            this.style.opacity = '1';
        }, { once: true });
    });

    videoModal.addEventListener('hide.bs.modal', function() {
        var modalVideo = videoModal.querySelector('#modalVideo');
        modalVideo.pause();
        modalVideo.currentTime = 0;
        modalVideo.style.opacity = '0';
    });

    // Enhanced video item interactions
    document.querySelectorAll('.video-item-luxury').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(12px) scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0) scale(1)';
        });
    });
});
</script>
@endsection