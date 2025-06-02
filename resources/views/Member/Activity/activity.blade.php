@extends('layouts.Member.master')

@section('content')
    <!-- Ultra-Luxury Activity with Advanced Effects -->
    <style>
        :root {
            --primary: #1a73e8;
            --primary-rgb: 26, 115, 232;
            --secondary: #f8c054;
            --secondary-rgb: 248, 192, 84;
            --success: #22c55e;
            --success-rgb: 34, 197, 94;
            --warning: #f59e0b;
            --warning-rgb: 245, 158, 11;
            --dark: #0f172a;
            --dark-rgb: 15, 23, 42;
            --text: #334155;
            --text-light: #64748b;
            --neutral-50: #f8fafc;
            --neutral-100: #f1f5f9;
            --neutral-200: #e2e8f0;
            --neutral-800: #1e293b;
            --neutral-900: #0f172a;
            --surface: #ffffff;
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
            --shadow-sm: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --gradient-primary: linear-gradient(135deg, #1a73e8, #0052cc);
            --gradient-secondary: linear-gradient(135deg, #f8c054, #f59e0b);
            --gradient-success: linear-gradient(135deg, #22c55e, #16a34a);
            --gradient-dark: linear-gradient(135deg, #0f172a, #1e293b);
            --gradient-surface: linear-gradient(135deg, #ffffff, #f8fafc);
            --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-smooth: all 0.5s cubic-bezier(0.25, 1, 0.5, 1);
            --transition-bounce: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        /* Hide All Scrollbars */
        * {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        *::-webkit-scrollbar {
            display: none;
        }

        /* Base Styles & Typography */
        .activity-showcase {
            font-family: 'Inter', 'SF Pro Display', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text);
            line-height: 1.6;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
            overflow-x: hidden;
            position: relative;
        }

        .activity-showcase *, 
        .activity-showcase *::before, 
        .activity-showcase *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Advanced Background Patterns */
        .activity-showcase::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(26, 115, 232, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(248, 192, 84, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 60% 40%, rgba(15, 23, 42, 0.02) 0%, transparent 50%);
            z-index: -2;
            animation: backgroundShift 20s ease-in-out infinite;
        }

        @keyframes backgroundShift {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(1deg); }
        }

        /* Floating Geometric Shapes */
        .geometric-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }

        .geometric-shape {
            position: absolute;
            background: linear-gradient(45deg, rgba(26, 115, 232, 0.05), rgba(248, 192, 84, 0.05));
            border-radius: 50%;
            animation: floatGeometric 15s ease-in-out infinite;
        }

        .geometric-shape:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            left: -150px;
            animation-delay: 0s;
        }

        .geometric-shape:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 60%;
            right: -100px;
            animation-delay: 5s;
        }

        .geometric-shape:nth-child(3) {
            width: 150px;
            height: 150px;
            top: 30%;
            left: 70%;
            animation-delay: 10s;
        }

        @keyframes floatGeometric {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
                opacity: 0.3; 
            }
            50% { 
                transform: translateY(-50px) rotate(180deg); 
                opacity: 0.6; 
            }
        }

        /* Ultra Cinematic Hero */
        .cinematic-hero {
            position: relative;
            height: 100vh;
            min-height: 700px;
            width: 100%;
            overflow: hidden;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.1);
            filter: brightness(0.6) contrast(1.2) saturate(1.1);
            transition: all 2s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(ellipse at center, rgba(var(--dark-rgb), 0.2) 0%, rgba(var(--dark-rgb), 0.8) 100%),
                linear-gradient(135deg, rgba(var(--primary-rgb), 0.1) 0%, rgba(var(--secondary-rgb), 0.1) 100%);
            z-index: 1;
        }

        /* Particle System */
        .particle-system {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 2;
        }

        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8), transparent);
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat 8s ease-in-out infinite;
        }

        @keyframes particleFloat {
            0%, 100% { 
                transform: translateY(0px) translateX(0px) scale(1); 
                opacity: 0.3; 
            }
            25% { 
                transform: translateY(-30px) translateX(20px) scale(1.2); 
                opacity: 0.8; 
            }
            50% { 
                transform: translateY(-20px) translateX(-10px) scale(0.8); 
                opacity: 0.6; 
            }
            75% { 
                transform: translateY(-40px) translateX(30px) scale(1.1); 
                opacity: 0.7; 
            }
        }

        .hero-content {
            position: relative;
            z-index: 3;
            text-align: center;
            color: white;
            max-width: 900px;
            padding: 0 5%;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 12px 24px;
            border-radius: 100px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 32px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transform: translateY(30px);
            animation: heroFadeIn 1s 0.3s ease forwards;
        }

        .hero-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--secondary);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        .hero-title {
            font-size: clamp(3rem, 8vw, 5rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 24px;
            opacity: 0;
            transform: translateY(30px);
            animation: heroFadeIn 1s 0.6s ease forwards;
            background: linear-gradient(135deg, #ffffff 0%, rgba(248, 192, 84, 0.9) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 50px rgba(255, 255, 255, 0.5);
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 3vw, 1.3rem);
            font-weight: 400;
            line-height: 1.7;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.9);
            opacity: 0;
            transform: translateY(30px);
            animation: heroFadeIn 1s 0.9s ease forwards;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--gradient-secondary);
            color: var(--dark);
            padding: 16px 32px;
            border-radius: 100px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 10px 30px rgba(var(--secondary-rgb), 0.4);
            transition: var(--transition-bounce);
            opacity: 0;
            transform: translateY(30px);
            animation: heroFadeIn 1s 1.2s ease forwards;
        }

        .hero-cta:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(var(--secondary-rgb), 0.6);
            color: var(--dark);
        }

        .hero-cta i {
            transition: transform 0.3s ease;
        }

        .hero-cta:hover i {
            transform: translateX(5px);
        }

        @keyframes heroFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Ultra-Modern Content Area */
        .content-area {
            position: relative;
            z-index: 10;
            background: var(--gradient-surface);
            border-radius: 50px 50px 0 0;
            margin-top: -50px;
            padding: 100px 0;
            box-shadow: 0 -20px 40px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 5%;
        }

        /* NEW: Quick Stats Cards */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .stat-card-modern {
            background: white;
            border-radius: var(--radius-xl);
            padding: 32px;
            text-align: center;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(var(--neutral-200), 0.5);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .stat-card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-primary);
        }

        .stat-card-modern:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .stat-card-modern .stat-icon-large {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(var(--primary-rgb), 0.3);
        }

        .stat-card-modern h3 {
            font-size: 36px;
            font-weight: 900;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .stat-card-modern p {
            color: var(--text-light);
            font-weight: 600;
        }

        /* Premium Navigation Dashboard */
        .premium-dashboard {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-xl);
            padding: 40px;
            margin-bottom: 80px;
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
        }

        .premium-dashboard::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        }

        .premium-dashboard::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(26, 115, 232, 0.02) 0%, transparent 70%);
            animation: dashboardGlow 10s ease-in-out infinite;
        }

        @keyframes dashboardGlow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }

        .dashboard-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            gap: 20px;
        }

        .dashboard-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .title-icon {
            width: 56px;
            height: 56px;
            background: var(--gradient-primary);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 8px 20px rgba(var(--primary-rgb), 0.3);
        }

        /* NEW: Filter and Search Section */
        .filter-section {
            background: white;
            border-radius: var(--radius-xl);
            padding: 32px;
            margin-bottom: 60px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--neutral-200);
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .filter-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            background: var(--neutral-50);
            border: 2px solid var(--neutral-200);
            border-radius: var(--radius-lg);
            padding: 16px 20px 16px 50px;
            font-size: 16px;
            font-weight: 500;
            color: var(--text);
            transition: var(--transition-base);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
            background: white;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 18px;
            pointer-events: none;
        }

        .filter-controls {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-select {
            background: white;
            border: 2px solid var(--neutral-200);
            border-radius: var(--radius-md);
            padding: 12px 40px 12px 16px;
            color: var(--text);
            font-weight: 600;
            font-size: 15px;
            min-width: 180px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 16px center;
            background-repeat: no-repeat;
            background-size: 16px;
            transition: var(--transition-base);
            box-shadow: var(--shadow-sm);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
        }

        /* Ultra-Premium Activity Grid */
        .premium-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
            gap: 40px;
            margin-bottom: 100px;
        }

        .premium-card {
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: var(--transition-smooth);
            position: relative;
            border: 1px solid rgba(var(--neutral-200), 0.5);
            group: hover;
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(26, 115, 232, 0.02), rgba(248, 192, 84, 0.02));
            opacity: 0;
            transition: var(--transition-base);
            z-index: 1;
            pointer-events: none;
        }

        .premium-card:hover::before {
            opacity: 1;
        }

        .premium-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.12),
                0 8px 16px rgba(var(--primary-rgb), 0.1);
            border-color: rgba(var(--primary-rgb), 0.2);
        }

        .card-image-wrapper {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .premium-card:hover .card-image {
            transform: scale(1.1) rotate(1deg);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg,
                rgba(var(--dark-rgb), 0.1) 0%,
                rgba(var(--primary-rgb), 0.2) 50%,
                rgba(var(--secondary-rgb), 0.1) 100%
            );
            opacity: 0;
            transition: var(--transition-base);
        }

        .premium-card:hover .card-overlay {
            opacity: 1;
        }

        .floating-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: var(--primary);
            padding: 10px 18px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: var(--transition-bounce);
            z-index: 2;
        }

        .premium-card:hover .floating-badge {
            background: var(--secondary);
            color: var(--dark);
            transform: translateY(-5px) scale(1.05);
        }

        /* NEW: Activity Status Badge */
        .status-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
        }

        .status-badge.completed {
            background: var(--gradient-success);
            color: white;
        }

        .status-badge.ongoing {
            background: var(--gradient-secondary);
            color: var(--dark);
        }

        .status-badge.upcoming {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .premium-content {
            padding: 36px;
            position: relative;
            z-index: 2;
        }

        .content-header {
            margin-bottom: 20px;
        }
        
        .content-title {
            font-size: 26px;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 16px;
            color: var(--dark);
            transition: var(--transition-base);
        }

        .premium-card:hover .content-title {
            color: var(--primary);
        }

        .content-description {
            color: var(--text-light);
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 28px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* NEW: Enhanced Activity Metrics */
        .activity-metrics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
            padding: 20px;
            background: var(--neutral-50);
            border-radius: var(--radius-lg);
        }

        .metric-item {
            text-align: center;
        }

        .metric-value {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .metric-label {
            font-size: 12px;
            color: var(--text-light);
            font-weight: 600;
        }

        .engagement-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding: 16px 0;
            border-top: 1px solid var(--neutral-200);
            border-bottom: 1px solid var(--neutral-200);
        }

        .engagement-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            font-size: 14px;
            font-weight: 600;
        }

        .engagement-item i {
            color: var(--primary);
            font-size: 16px;
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .primary-action {
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 100px;
            padding: 14px 28px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition-bounce);
            box-shadow: 0 8px 20px rgba(var(--primary-rgb), 0.3);
            flex: 1;
            justify-content: center;
        }

        .primary-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(var(--primary-rgb), 0.4);
            color: white;
            text-decoration: none;
        }

        .primary-action i {
            transition: transform 0.3s ease;
        }

        .primary-action:hover i {
            transform: translateX(3px);
        }

        .secondary-actions {
            display: flex;
            gap: 12px;
        }

        .action-btn {
            width: 48px;
            height: 48px;
            border: 2px solid var(--neutral-200);
            border-radius: 50%;
            background: white;
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-base);
            font-size: 18px;
        }

        .action-btn:hover {
            border-color: var(--secondary);
            color: var(--secondary);
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(var(--secondary-rgb), 0.2);
        }

        /* NEW: Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            margin-bottom: 60px;
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            font-size: 48px;
            color: white;
            opacity: 0.8;
        }

        .empty-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 16px;
        }

        .empty-description {
            font-size: 18px;
            color: var(--text-light);
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto 32px;
        }

        .empty-action {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--gradient-secondary);
            color: var(--dark);
            padding: 16px 32px;
            border-radius: 100px;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition-bounce);
            box-shadow: 0 8px 20px rgba(var(--secondary-rgb), 0.3);
        }

        .empty-action:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 30px rgba(var(--secondary-rgb), 0.4);
        }

        /* Enhanced Pagination */
        .pagination-section {
            text-align: center;
            margin-top: 80px;
        }

        .pagination-container {
            display: inline-block;
            background: white;
            border-radius: var(--radius-xl);
            padding: 32px 40px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--neutral-200);
        }

        /* Ultra Loader */
        .ultra-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .ultra-loader.active {
            opacity: 1;
            visibility: visible;
        }

        .ultra-spinner {
            width: 80px;
            height: 80px;
            border: 6px solid var(--neutral-200);
            border-top: 6px solid var(--primary);
            border-right: 6px solid var(--secondary);
            border-radius: 50%;
            animation: ultraSpin 1.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
            margin-bottom: 24px;
            position: relative;
        }

        .ultra-spinner::before {
            content: '';
            position: absolute;
            top: -6px;
            left: -6px;
            right: -6px;
            bottom: -6px;
            border: 6px solid transparent;
            border-left: 6px solid rgba(var(--primary-rgb), 0.3);
            border-radius: 50%;
            animation: ultraSpin 2s linear infinite reverse;
        }

        @keyframes ultraSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loader-text {
            color: var(--text);
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .loader-subtext {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Card Animation System */
        .premium-card {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
            animation: cardReveal 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }

        .premium-card:nth-child(1) { animation-delay: 0.1s; }
        .premium-card:nth-child(2) { animation-delay: 0.2s; }
        .premium-card:nth-child(3) { animation-delay: 0.3s; }
        .premium-card:nth-child(4) { animation-delay: 0.4s; }
        .premium-card:nth-child(5) { animation-delay: 0.5s; }
        .premium-card:nth-child(6) { animation-delay: 0.6s; }

        @keyframes cardReveal {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive Excellence */
        @media (max-width: 1200px) {
            .premium-grid {
                grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
                gap: 32px;
            }
        }

        @media (max-width: 768px) {
            .cinematic-hero {
                height: 80vh;
                min-height: 600px;
            }

            .hero-content {
                padding: 0 8%;
            }

            .premium-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .quick-stats {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 16px;
            }

            .premium-dashboard {
                padding: 28px;
            }

            .dashboard-header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .filter-section {
                padding: 24px;
            }

            .filter-header {
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }

            .search-box {
                max-width: 100%;
            }

            .filter-controls {
                justify-content: center;
            }

            .premium-content {
                padding: 28px;
            }

            .content-title {
                font-size: 22px;
            }

            .card-actions {
                flex-direction: column;
            }

            .secondary-actions {
                justify-content: center;
            }

            .activity-metrics {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .hero-content {
                padding: 0 5%;
            }

            .quick-stats {
                grid-template-columns: 1fr;
            }

            .premium-dashboard {
                padding: 20px;
            }

            .filter-section {
                padding: 20px;
            }

            .premium-content {
                padding: 20px;
            }

            .content-title {
                font-size: 20px;
            }

            .card-image-wrapper {
                height: 250px;
            }

            .activity-metrics {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Geometric Background -->
    <div class="geometric-bg">
        <div class="geometric-shape"></div>
        <div class="geometric-shape"></div>
        <div class="geometric-shape"></div>
    </div>

    <div class="activity-showcase">
        <!-- Ultra Cinematic Hero -->
        <section class="cinematic-hero">
            <div class="hero-background">
                <img src="{{ asset('assets/img/activity.jpg') }}" alt="Premium Activities" class="hero-image">
                <div class="hero-overlay"></div>
            </div>
            
            <!-- Particle System -->
            <div class="particle-system" id="particleSystem"></div>
            
            <div class="hero-content">
                <div class="hero-badge">
                    <span>Premium Collection</span>
                </div>
                
                <h1 class="hero-title">
                    {{ __('messages.activity') }}
                </h1>
                
                <p class="hero-subtitle">
                    Jelajahi koleksi premium aktivitas eksklusif yang telah dikurasi khusus untuk memberikan 
                    pengalaman tak terlupakan dan menginspirasi setiap langkah perjalanan Anda.
                </p>

                <a href="#activities" class="hero-cta">
                    <span>Jelajahi Sekarang</span>
                    <i class="fas fa-arrow-down"></i>
                </a>
            </div>
        </section>

        <!-- Ultra-Modern Content Area -->
        <section class="content-area" id="activities">
            <div class="container">

                <!-- NEW: Enhanced Filter Section -->
                <div class="filter-section" data-aos="fade-up" data-aos-delay="200">
                    <div class="filter-header">
                        <div class="filter-title">
                            <i class="fas fa-filter"></i>
                            <span>Filter & Pencarian</span>
                        </div>
                        <div class="search-box">
                            <input type="text" class="search-input" placeholder="Cari aktivitas..." id="searchInput">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                    </div>
                    
                    <div class="filter-controls">
                        <div class="filter-group">
                            <label class="control-label">
                                <i class="fas fa-sort"></i>
                                Urutkan:
                            </label>
                            <select class="filter-select" id="sortSelect">
                                <option value="latest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                                <option value="title">Judul A-Z</option>
                                <option value="popular">Terpopuler</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label class="control-label">
                                <i class="fas fa-tags"></i>
                                Status:
                            </label>
                            <select class="filter-select" id="statusFilter">
                                <option value="all">Semua Status</option>
                                <option value="completed">Selesai</option>
                                <option value="ongoing">Berlangsung</option>
                                <option value="upcoming">Akan Datang</option>
                            </select>
                        </div>
                        
                        <div class="showing-info">
                            Menampilkan <span class="highlight">{{ $activities->count() }}</span> dari <span class="highlight">{{ $activities->total() }}</span> aktivitas
                        </div>
                    </div>
                </div>

                <!-- Premium Activities Grid -->
                <div class="premium-grid" id="premiumGrid">
                    @forelse ($activities as $index => $item)
                        <article class="premium-card activity-item" 
                                 data-aos="fade-up" 
                                 data-aos-delay="{{ $index * 150 }}" 
                                 data-aos-duration="800"
                                 data-category="{{ $item->category ?? 'general' }}"
                                 data-status="{{ $item->status ?? 'ongoing' }}"
                                 data-title="{{ strtolower($item->title) }}">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('images/' . $item->image) }}" 
                                     alt="{{ $item->title }}" 
                                     class="card-image">
                                <div class="card-overlay"></div>
                                
                                <!-- Status Badge -->
                                <div class="status-badge {{ $item->status ?? 'ongoing' }}">
                                    @switch($item->status ?? 'ongoing')
                                        @case('completed')
                                            Selesai
                                            @break
                                        @case('upcoming')
                                            Akan Datang
                                            @break
                                        @default
                                            Berlangsung
                                    @endswitch
                                </div>
                                
                                <div class="floating-badge">
                                    {{ $item->date->format('d M Y') }}
                                </div>
                            </div>
                            
                            <div class="premium-content">
                                <div class="content-header">
       
                                    
                                    <h3 class="content-title">{{ $item->title }}</h3>
                                    
                                    <p class="content-description">
                                        {{ Str::limit($item->description, 140) }}
                                    </p>
                                </div>
                                
                                <div class="card-actions">
                                    <a href="{{ route('activity.show', $item->id) }}" class="primary-action">
                                        <span>Lihat Detail</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    
                                    <div class="secondary-actions">
                                        <button class="action-btn bookmark-btn" title="Bookmark">
                                            <i class="far fa-bookmark"></i>
                                        </button>
                                        <button class="action-btn share-btn" title="Share">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <!-- NEW: Empty State -->
                        <div class="empty-state" data-aos="fade-up">
                            <div class="empty-icon">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h3 class="empty-title">Belum Ada Aktivitas</h3>
                            <p class="empty-description">
                                Saat ini belum ada aktivitas yang tersedia. Tetap pantau halaman ini untuk update aktivitas terbaru yang menarik!
                            </p>
                            <a href="{{ route('dashboard') }}" class="empty-action">
                                <i class="fas fa-home"></i>
                                <span>Kembali ke Dashboard</span>
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Enhanced Pagination -->
                @if($activities->hasPages())
                    <div class="pagination-section" data-aos="fade-up">
                        <div class="pagination-container">
                            {{ $activities->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>

    <!-- Ultra-Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS with custom settings
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 1000,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 50,
                    delay: 100
                });
            }

            // Create Advanced Particle System
            function createParticleSystem() {
                const particleContainer = document.getElementById('particleSystem');
                const particleCount = 15;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    
                    // Random size and position
                    const size = Math.random() * 4 + 2;
                    particle.style.width = size + 'px';
                    particle.style.height = size + 'px';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.top = Math.random() * 100 + '%';
                    
                    // Random animation delay and duration
                    particle.style.animationDelay = Math.random() * 8 + 's';
                    particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                    
                    particleContainer.appendChild(particle);
                }
            }

            // Ultra-Enhanced Filter and Search System
            const searchInput = document.getElementById('searchInput');
            const sortSelect = document.getElementById('sortSelect');
            const statusFilter = document.getElementById('statusFilter');
            const ultraLoader = document.getElementById('ultraLoader');
            const premiumGrid = document.getElementById('premiumGrid');
            const activityItems = document.querySelectorAll('.activity-item');

            let currentFilters = {
                search: '',
                sort: 'latest',
                status: 'all',
                category: 'all'
            };

            // Search functionality
            searchInput.addEventListener('input', function() {
                currentFilters.search = this.value.toLowerCase();
                applyFilters();
            });

            // Sort functionality
            sortSelect.addEventListener('change', function() {
                currentFilters.sort = this.value;
                showUltraLoader();
                setTimeout(() => {
                    applyFilters();
                    hideUltraLoader();
                }, 800);
            });

            // Status filter
            statusFilter.addEventListener('change', function() {
                currentFilters.status = this.value;
                applyFilters();
            });

            function applyFilters() {
                let visibleCount = 0;

                activityItems.forEach((item, index) => {
                    let shouldShow = true;

                    // Search filter
                    if (currentFilters.search && !item.dataset.title.includes(currentFilters.search)) {
                        shouldShow = false;
                    }

                    // Status filter
                    if (currentFilters.status !== 'all' && item.dataset.status !== currentFilters.status) {
                        shouldShow = false;
                    }

                    // Category filter
                    if (currentFilters.category !== 'all' && item.dataset.category !== currentFilters.category) {
                        shouldShow = false;
                    }

                    if (shouldShow) {
                        item.style.display = 'block';
                        item.style.animationDelay = `${visibleCount * 0.1}s`;
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Update showing info
                const showingInfo = document.querySelector('.showing-info');
                if (showingInfo) {
                    showingInfo.innerHTML = `Menampilkan <span class="highlight">${visibleCount}</span> dari <span class="highlight">${activityItems.length}</span> aktivitas`;
                }

                // Show empty state if no results
                const emptyState = document.querySelector('.empty-state');
                if (visibleCount === 0 && !emptyState) {
                    showEmptyState();
                } else if (visibleCount > 0 && emptyState) {
                    emptyState.remove();
                }
            }

            function showEmptyState() {
                const emptyHTML = `
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <div class="empty-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="empty-title">Tidak Ada Hasil</h3>
                        <p class="empty-description">
                            Tidak ditemukan aktivitas yang sesuai dengan kriteria pencarian Anda. Coba ubah filter atau kata kunci pencarian.
                        </p>
                        <button class="empty-action" onclick="clearFilters()">
                            <i class="fas fa-refresh"></i>
                            <span>Reset Filter</span>
                        </button>
                    </div>
                `;
                premiumGrid.insertAdjacentHTML('beforeend', emptyHTML);
            }

            window.clearFilters = function() {
                searchInput.value = '';
                sortSelect.value = 'latest';
                statusFilter.value = 'all';
                
                currentFilters = {
                    search: '',
                    sort: 'latest',
                    status: 'all',
                    category: 'all'
                };
                
                applyFilters();
            };

            function showUltraLoader() {
                ultraLoader.classList.add('active');
            }

            function hideUltraLoader() {
                ultraLoader.classList.remove('active');
            }

            function animatePremiumCards() {
                const cards = document.querySelectorAll('.premium-card:not([style*="display: none"])');
                cards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(40px) scale(0.95)';
                    
                    setTimeout(() => {
                        card.style.transition = 'all 0.8s cubic-bezier(0.25, 1, 0.5, 1)';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0) scale(1)';
                    }, index * 150);
                });
            }

            // Premium Bookmark System
            const bookmarkButtons = document.querySelectorAll('.bookmark-btn');
            bookmarkButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const isBookmarked = icon.classList.contains('fas');
                    
                    if (isBookmarked) {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.style.color = 'var(--text-light)';
                        this.style.borderColor = 'var(--neutral-200)';
                        
                        // Show notification
                        showNotification('Bookmark dihapus', 'info');
                    } else {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.style.color = 'var(--secondary)';
                        this.style.borderColor = 'var(--secondary)';
                        
                        // Success animation
                        this.style.background = 'var(--secondary)';
                        this.style.color = 'white';
                        setTimeout(() => {
                            this.style.background = 'white';
                            this.style.color = 'var(--secondary)';
                        }, 200);
                        
                        // Show notification
                        showNotification('Ditambahkan ke bookmark', 'success');
                    }
                    
                    // Bounce animation
                    this.style.transform = 'scale(1.3)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                });
            });

            // Premium Share System
            const shareButtons = document.querySelectorAll('.share-btn');
            shareButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Copy current URL to clipboard
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        // Success feedback
                        const originalHTML = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-check"></i>';
                        this.style.background = 'var(--success)';
                        this.style.color = 'white';
                        this.style.borderColor = 'var(--success)';
                        
                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                            this.style.background = 'white';
                            this.style.color = 'var(--text-light)';
                            this.style.borderColor = 'var(--neutral-200)';
                        }, 1500);
                        
                        // Show notification
                        showNotification('Link disalin ke clipboard', 'success');
                    }).catch(() => {
                        showNotification('Gagal menyalin link', 'error');
                    });
                });
            });

            // NEW: Notification System
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.innerHTML = `
                    <div class="notification-content">
                        <i class="fas fa-${getNotificationIcon(type)}"></i>
                        <span>${message}</span>
                    </div>
                `;
                
                // Add notification styles
                Object.assign(notification.style, {
                    position: 'fixed',
                    top: '20px',
                    right: '20px',
                    background: getNotificationColor(type),
                    color: 'white',
                    padding: '16px 24px',
                    borderRadius: '12px',
                    boxShadow: '0 8px 25px rgba(0, 0, 0, 0.15)',
                    zIndex: '10000',
                    transform: 'translateX(100%)',
                    transition: 'all 0.3s cubic-bezier(0.25, 1, 0.5, 1)',
                    minWidth: '300px',
                    backdropFilter: 'blur(10px)'
                });

                document.body.appendChild(notification);

                // Animate in
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);

                // Animate out and remove
                setTimeout(() => {
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 3000);
            }

            function getNotificationIcon(type) {
                const icons = {
                    success: 'check-circle',
                    error: 'exclamation-circle',
                    warning: 'exclamation-triangle',
                    info: 'info-circle'
                };
                return icons[type] || 'info-circle';
            }

            function getNotificationColor(type) {
                const colors = {
                    success: 'var(--gradient-success)',
                    error: 'linear-gradient(135deg, #ef4444, #dc2626)',
                    warning: 'var(--gradient-secondary)',
                    info: 'var(--gradient-primary)'
                };
                return colors[type] || 'var(--gradient-primary)';
            }

            // Advanced Card Interactions
            const premiumCards = document.querySelectorAll('.premium-card');
            premiumCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    // Enhance neighboring cards effect
                    const allCards = document.querySelectorAll('.premium-card');
                    allCards.forEach(otherCard => {
                        if (otherCard !== this && otherCard.style.display !== 'none') {
                            otherCard.style.opacity = '0.7';
                            otherCard.style.transform = 'scale(0.98)';
                        }
                    });
                });

                card.addEventListener('mouseleave', function() {
                    // Reset all cards
                    const allCards = document.querySelectorAll('.premium-card');
                    allCards.forEach(otherCard => {
                        otherCard.style.opacity = '1';
                        otherCard.style.transform = 'scale(1)';
                    });
                });

                // Add click ripple effect
                card.addEventListener('click', function(e) {
                    if (e.target.closest('.card-actions') || e.target.closest('.action-btn')) return;
                    
                    const ripple = document.createElement('div');
                    const rect = card.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    Object.assign(ripple.style, {
                        position: 'absolute',
                        width: size + 'px',
                        height: size + 'px',
                        left: x + 'px',
                        top: y + 'px',
                        borderRadius: '50%',
                        background: 'rgba(26, 115, 232, 0.3)',
                        transform: 'scale(0)',
                        animation: 'ripple 0.6s linear',
                        pointerEvents: 'none',
                        zIndex: '100'
                    });
                    
                    card.style.position = 'relative';
                    card.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // NEW: Quick Actions
            function addQuickActions() {
                const quickActionsHTML = `
                    <div class="quick-actions" id="quickActions">
                        <button class="quick-action-btn" id="scrollToTop" title="Scroll to Top">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <button class="quick-action-btn" id="gridToggle" title="Toggle View">
                            <i class="fas fa-th"></i>
                        </button>
                    </div>
                `;

                document.body.insertAdjacentHTML('beforeend', quickActionsHTML);

                // Add quick actions styles
                const quickActionsStyle = document.createElement('style');
                quickActionsStyle.textContent = `
                    .quick-actions {
                        position: fixed;
                        bottom: 30px;
                        right: 30px;
                        display: flex;
                        flex-direction: column;
                        gap: 12px;
                        z-index: 1000;
                    }

                    .quick-action-btn {
                        width: 56px;
                        height: 56px;
                        background: var(--gradient-primary);
                        border: none;
                        border-radius: 50%;
                        color: white;
                        font-size: 20px;
                        cursor: pointer;
                        box-shadow: 0 8px 25px rgba(var(--primary-rgb), 0.4);
                        transition: var(--transition-bounce);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .quick-action-btn:hover {
                        transform: translateY(-3px) scale(1.1);
                        box-shadow: 0 12px 30px rgba(var(--primary-rgb), 0.5);
                    }

                    .quick-action-btn:active {
                        transform: translateY(-1px) scale(1.05);
                    }

                    .quick-action-btn i {
                        transition: transform 0.3s ease;
                    }

                    .quick-action-btn:hover i {
                        transform: rotate(360deg);
                    }

                    @media (max-width: 768px) {
                        .quick-actions {
                            bottom: 20px;
                            right: 20px;
                        }
                        
                        .quick-action-btn {
                            width: 48px;
                            height: 48px;
                            font-size: 18px;
                        }
                    }
                `;
                document.head.appendChild(quickActionsStyle);

                // Quick actions functionality
                document.getElementById('scrollToTop').addEventListener('click', function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    showNotification('Kembali ke atas', 'info');
                });

                let isGridView = true;
                document.getElementById('gridToggle').addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const grid = document.getElementById('premiumGrid');
                    
                    if (isGridView) {
                        grid.style.gridTemplateColumns = '1fr';
                        icon.className = 'fas fa-th-large';
                        showNotification('Beralih ke tampilan list', 'info');
                        isGridView = false;
                    } else {
                        grid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(420px, 1fr))';
                        icon.className = 'fas fa-th';
                        showNotification('Beralih ke tampilan grid', 'info');
                        isGridView = true;
                    }
                });
            }

            // Smooth Hero CTA Scroll
            const heroCTA = document.querySelector('.hero-cta');
            if (heroCTA) {
                heroCTA.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector('#activities').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            }

            // Advanced Parallax Effects
            let ticking = false;
            
            function updateParallax() {
                const scrolled = window.pageYOffset;
                const heroImage = document.querySelector('.hero-image');
                const geometricShapes = document.querySelectorAll('.geometric-shape');
                const quickActions = document.getElementById('quickActions');
                
                if (heroImage) {
                    const rate = scrolled * -0.3;
                    heroImage.style.transform = `translateY(${rate}px) scale(1.1)`;
                }
                
                geometricShapes.forEach((shape, index) => {
                    const rate = scrolled * (0.1 + index * 0.05);
                    shape.style.transform = `translateY(${rate}px) rotate(${scrolled * 0.1}deg)`;
                });

                // Show/hide quick actions based on scroll
                if (quickActions) {
                    if (scrolled > 300) {
                        quickActions.style.opacity = '1';
                        quickActions.style.transform = 'translateY(0)';
                    } else {
                        quickActions.style.opacity = '0';
                        quickActions.style.transform = 'translateY(20px)';
                    }
                }
                
                ticking = false;
            }

            window.addEventListener('scroll', function() {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            });

            // NEW: Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    switch(e.key) {
                        case 'f':
                            e.preventDefault();
                            searchInput.focus();
                            showNotification('Fokus pada pencarian', 'info');
                            break;
                    }
                }
                
                if (e.key === 'Escape') {
                    if (searchInput.value) {
                        searchInput.value = '';
                        searchInput.dispatchEvent(new Event('input'));
                        showNotification('Pencarian dibersihkan', 'info');
                    }
                }
            });

            // Loading states for navigation
            document.querySelectorAll('.pagination a, .primary-action').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.classList.contains('disabled') && this.getAttribute('href') !== '#') {
                        showUltraLoader();
                    }
                });
            });

            // NEW: Progressive image loading
            function setupProgressiveImageLoading() {
                const images = document.querySelectorAll('.card-image');
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.style.filter = 'blur(0px)';
                            img.style.opacity = '1';
                            observer.unobserve(img);
                        }
                    });
                });

                images.forEach(img => {
                    img.style.filter = 'blur(10px)';
                    img.style.opacity = '0.8';
                    img.style.transition = 'all 0.5s ease';
                    imageObserver.observe(img);
                });
            }

            // NEW: Performance monitoring
            function monitorPerformance() {
                const observer = new PerformanceObserver((list) => {
                    const entries = list.getEntries();
                    entries.forEach((entry) => {
                        if (entry.entryType === 'navigation') {
                            console.log('Page load time:', entry.loadEventEnd - entry.loadEventStart);
                        }
                    });
                });
                
                observer.observe({ entryTypes: ['navigation'] });
            }

            // Initialize all features
            createParticleSystem();
            addQuickActions();
            setupProgressiveImageLoading();
            monitorPerformance();

            // Add custom ripple animation styles
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }

                @keyframes spin {
                    to {
                        transform: rotate(360deg);
                    }
                }

                .notification-content {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    font-weight: 600;
                }

                .notification-content i {
                    font-size: 18px;
                }
            `;
            document.head.appendChild(style);

            // Smooth scroll for better UX
            document.documentElement.style.scrollBehavior = 'smooth';

            // Welcome message for logged-in user
            setTimeout(() => {
                showNotification('', 'success');
            }, 1000);
        });

        // Page visibility API for performance
        document.addEventListener('visibilitychange', function() {
            const particles = document.querySelectorAll('.particle');
            const geometricShapes = document.querySelectorAll('.geometric-shape');
            
            if (document.hidden) {
                particles.forEach(p => p.style.animationPlayState = 'paused');
                geometricShapes.forEach(s => s.style.animationPlayState = 'paused');
            } else {
                particles.forEach(p => p.style.animationPlayState = 'running');
                geometricShapes.forEach(s => s.style.animationPlayState = 'running');
            }
        });

        // NEW: Service Worker for offline support (optional)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('SW registered: ', registration);
                    })
                    .catch((registrationError) => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
    </script>

    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Optional: Add Font Awesome for better icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection