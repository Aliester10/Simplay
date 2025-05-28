@extends('layouts.Member.master')

@section('content')
<style>
    /* Ultra-Luxury Activity Detail with Cinematic Design */
    :root {
        --primary: #1a73e8;
        --primary-rgb: 26, 115, 232;
        --secondary: #f8c054;
        --secondary-rgb: 248, 192, 84;
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
        --header-height: 80px;
        --radius-sm: 6px;
        --radius-md: 12px;
        --radius-lg: 20px;
        --radius-xl: 30px;
        --shadow-sm: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --gradient-primary: linear-gradient(135deg, #1a73e8, #0052cc);
        --gradient-dark: linear-gradient(135deg, #0f172a, #1e293b);
        --gradient-accent: linear-gradient(135deg, #f8c054, #f59e0b);
        --transition-base: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        --transition-smooth: all 0.5s cubic-bezier(0.25, 1, 0.5, 1);
    }

    /* Base Styles & Typography */
    .activity-showcase {
        font-family: 'Inter', 'Segoe UI', Roboto, -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--text);
        line-height: 1.6;
        background-color: var(--surface);
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

    .activity-showcase h1,
    .activity-showcase h2,
    .activity-showcase h3 {
        font-weight: 800;
        letter-spacing: -0.025em;
        line-height: 1.2;
        color: var(--dark);
    }

    .activity-showcase p {
        margin-bottom: 1.5rem;
    }

    /* Cinematic Immersive Hero */
    .cinematic-hero {
        position: relative;
        height: 100vh;
        min-height: 700px;
        width: 100%;
        overflow: hidden;
        z-index: 1;
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
        transform: scale(1.05);
        filter: brightness(0.8);
        transition: all 1.2s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            0deg,
            rgba(var(--dark-rgb), 0.95) 0%,
            rgba(var(--dark-rgb), 0.8) 30%,
            rgba(var(--dark-rgb), 0.4) 60%,
            rgba(var(--dark-rgb), 0.2) 100%
        );
        z-index: 1;
    }

    .hero-content {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 120px 10% 80px;
        z-index: 2;
        color: white;
        transform: translateY(0);
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .hero-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: rgba(var(--secondary-rgb), 0.9);
        color: var(--dark);
        padding: 8px 18px;
        border-radius: 100px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 24px;
        box-shadow: 0 10px 25px rgba(var(--secondary-rgb), 0.3);
        backdrop-filter: blur(10px);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s 0.2s forwards;
    }

    .hero-category i {
        font-size: 16px;
    }

    .hero-title {
        font-size: 64px;
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 24px;
        max-width: 900px;
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s 0.4s forwards;
        background: linear-gradient(to right, #fff, rgba(255, 255, 255, 0.7));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 20px;
        font-weight: 400;
        line-height: 1.6;
        margin-bottom: 40px;
        max-width: 700px;
        color: rgba(255, 255, 255, 0.9);
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s 0.6s forwards;
    }

    .hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 32px;
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s 0.8s forwards;
    }

    .meta-block {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .meta-icon {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--secondary);
        font-size: 20px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transform: translateZ(0);
        transition: var(--transition-base);
    }

    .meta-block:hover .meta-icon {
        background: var(--secondary);
        color: var(--dark);
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(var(--secondary-rgb), 0.3);
    }

    .meta-text strong {
        display: block;
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 4px;
        color: white;
    }

    .meta-text span {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.6);
    }

    .scroll-indicator {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        cursor: pointer;
        opacity: 0;
        animation: fadeIn 1s 1.2s forwards, bounce 2s infinite 2s;
    }

    .scroll-indicator svg {
        width: 36px;
        height: 36px;
        color: white;
    }

    /* Header Bar */
    .header-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: var(--header-height);
        background-color: transparent;
        backdrop-filter: blur(0);
        z-index: 100;
        transition: var(--transition-base);
        transform: translateY(-100%);
    }

    .header-bar.visible {
        background-color: rgba(var(--dark-rgb), 0.8);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(0);
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 5%;
        height: 100%;
    }

    .header-title {
        color: white;
        font-size: 20px;
        font-weight: 600;
        transition: var(--transition-base);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 60%;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-btn {
        height: 48px;
        padding: 0 24px;
        background-color: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 100px;
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .header-btn:hover {
        background-color: var(--secondary);
        border-color: var(--secondary);
        color: var(--dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(var(--secondary-rgb), 0.3);
    }

    .header-btn i {
        font-size: 18px;
    }

    /* Content Area */
    .content-area {
        position: relative;
        z-index: 10;
        background-color: var(--surface);
        border-radius: 40px 40px 0 0;
        margin-top: -40px;
        padding: 80px 0;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.1);
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 5%;
    }

    /* Image Showcase */
    .image-showcase {
        margin-bottom: 80px;
        overflow-x: hidden;
    }

    .showcase-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
    }

    .showcase-title {
        font-size: 32px;
        position: relative;
        padding-left: 20px;
    }

    .showcase-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 6px;
        background: var(--gradient-accent);
        border-radius: 3px;
    }

    .showcase-actions {
        display: flex;
        gap: 16px;
    }

    .showcase-btn {
        background: transparent;
        border: 1px solid var(--neutral-200);
        height: 48px;
        width: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text);
        cursor: pointer;
        transition: var(--transition-base);
    }

    .showcase-btn:hover {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .showcase-gallery {
        position: relative;
        height: 500px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .gallery-main {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .gallery-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease, transform 1.2s ease;
        transform: scale(1.05);
        z-index: 1;
    }

    .gallery-slide.active {
        opacity: 1;
        transform: scale(1);
        z-index: 2;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 60px 40px 30px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);
        color: white;
        z-index: 3;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease 0.3s;
    }

    .gallery-slide.active .gallery-caption {
        opacity: 1;
        transform: translateY(0);
    }

    .caption-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .caption-text {
        font-size: 16px;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .gallery-pagination {
        position: absolute;
        bottom: 30px;
        right: 40px;
        display: flex;
        gap: 12px;
        z-index: 5;
    }

    .gallery-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .gallery-dot.active {
        background-color: var(--secondary);
        transform: scale(1.3);
    }

    .gallery-preview {
        display: flex;
        gap: 16px;
        margin-top: 20px;
        overflow-x: auto;
        padding: 10px 0;
        scrollbar-width: thin;
        scrollbar-color: var(--neutral-300) var(--neutral-100);
    }

    .gallery-preview::-webkit-scrollbar {
        height: 6px;
    }

    .gallery-preview::-webkit-scrollbar-track {
        background: var(--neutral-100);
        border-radius: 10px;
    }

    .gallery-preview::-webkit-scrollbar-thumb {
        background-color: var(--neutral-300);
        border-radius: 10px;
    }

    .preview-item {
        flex: 0 0 auto;
        width: 120px;
        height: 80px;
        border-radius: var(--radius-sm);
        overflow: hidden;
        cursor: pointer;
        position: relative;
        transform: translateZ(0);
        transition: var(--transition-base);
        opacity: 0.7;
        box-shadow: var(--shadow-sm);
        border: 3px solid transparent;
    }

    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .preview-item:hover {
        opacity: 1;
        transform: translateY(-5px);
    }

    .preview-item:hover img {
        transform: scale(1.1);
    }

    .preview-item.active {
        opacity: 1;
        border-color: var(--secondary);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(var(--secondary-rgb), 0.2);
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 7fr 3fr;
        gap: 40px;
        margin-bottom: 80px;
    }

    /* Main Content */
    .main-content {
        background-color: var(--surface);
        border-radius: var(--radius-lg);
        padding: 48px;
        box-shadow: var(--shadow-md);
        position: relative;
    }

    .content-section:not(:last-child) {
        margin-bottom: 48px;
    }

    .content-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }

    .content-icon {
        width: 48px;
        height: 48px;
        background: var(--gradient-primary);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .content-icon i {
        font-size: 20px;
    }

    .content-title {
        font-size: 24px;
        line-height: 1.3;
        font-weight: 800;
        position: relative;
    }

    .content-description {
        font-size: 17px;
        line-height: 1.8;
        color: var(--text);
    }

    .content-description p {
        margin-bottom: 20px;
    }

    .content-description p:first-of-type::first-letter {
        font-size: 60px;
        font-weight: 800;
        line-height: 1;
        color: var(--primary);
        float: left;
        padding-right: 12px;
        padding-top: 4px;
    }

    /* Sidebar */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Event Info Card - Updated to match the image */
    .event-info-card {
        background-color: var(--surface);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        position: relative;
    }

    .event-info-header {
        padding: 20px;
        background-color: var(--neutral-100);
        border-bottom: 1px solid var(--neutral-200);
    }

    .event-info-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    .event-info-content {
        padding: 0;
        position: relative;
    }

    .event-date-badge {
        position: absolute;
        top: -30px;
        right: 30px;
        width: 70px;
        height: 70px;
        background: var(--primary);
        border-radius: 12px;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 16px rgba(var(--primary-rgb), 0.2);
        z-index: 10;
    }

    .date-badge-day {
        font-size: 28px;
        font-weight: 800;
        line-height: 1;
    }

    .date-badge-month {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .event-date-details {
        padding: 20px 20px 20px 70px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid var(--neutral-200);
        position: relative;
        min-height: 80px;
    }

    .event-date-icon {
        position: absolute;
        left: 20px;
        width: 36px;
        height: 36px;
        background-color: rgba(var(--primary-rgb), 0.1);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .event-date-text {
        display: flex;
        flex-direction: column;
    }

    .weekday {
        font-weight: 600;
        color: var(--primary);
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .full-date {
        font-weight: 700;
        font-size: 16px;
        color: var(--dark);
    }

    .event-info-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .event-info-item {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        border-bottom: 1px solid var(--neutral-200);
    }

    .event-info-item:last-child {
        border-bottom: none;
    }

    .info-item-icon {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        background-color: rgba(var(--primary-rgb), 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
    }

    .info-item-icon i {
        font-size: 16px;
        color: var(--primary);
    }

    .info-item-content {
        flex: 1;
    }

    .info-item-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 4px;
    }

    .info-item-value {
        font-weight: 600;
        color: var(--dark);
        font-size: 15px;
    }

    /* Share Card - Updated to match the image */
    .share-card {
        background: var(--dark);
        color: white;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .share-header {
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .share-title {
        color: white;
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .share-content {
        padding: 20px;
    }

    .share-buttons {
        display: flex;
        justify-content: space-between;
    }

    .share-btn {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 18px;
        cursor: pointer;
        transition: var(--transition-base);
        border: none;
    }

    .share-btn:hover {
        transform: translateY(-5px);
        background-color: white;
    }

    .share-btn.facebook:hover { color: #1877f2; }
    .share-btn.twitter:hover { color: #1da1f2; }
    .share-btn.linkedin:hover { color: #0a66c2; }
    .share-btn.whatsapp:hover { color: #25d366; }

    /* Footer CTA */
    .footer-cta {
        text-align: center;
        padding: 40px 0;
        margin-top: 60px;
        position: relative;
    }

    .cta-title {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .primary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        height: 56px;
        padding: 0 32px;
        background: var(--gradient-primary);
        border: none;
        border-radius: 100px;
        color: white;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition-base);
        box-shadow: 0 10px 25px rgba(var(--primary-rgb), 0.2);
    }

    .primary-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(var(--primary-rgb), 0.3);
    }

    .primary-btn i {
        transition: transform 0.3s ease;
    }

    .primary-btn:hover i {
        transform: translateX(-5px);
    }

    /* Premium Overlapping Cards Activity Slider - Even Larger Size */
    .activities-carousel-section {
        position: relative;
        padding: 140px 0; /* Increased padding */
        background: linear-gradient(to bottom, #f8fafc, #ffffff);
        overflow: hidden;
    }
    
    .activities-carousel-section::before {
        content: "";
        position: absolute;
        width: 800px;
        height: 800px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(26, 115, 232, 0.03) 0%, rgba(26, 115, 232, 0) 70%);
        top: -400px;
        left: -200px;
        z-index: 1;
        animation: pulse 15s ease-in-out infinite alternate;
    }
    
    .activities-carousel-section::after {
        content: "";
        position: absolute;
        width: 600px;
        height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(248, 192, 84, 0.04) 0%, rgba(248, 192, 84, 0) 70%);
        bottom: -300px;
        right: -200px;
        z-index: 1;
        animation: pulse 20s ease-in-out infinite alternate-reverse;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); opacity: 0.6; }
    }
    
    .activities-header {
        position: relative;
        text-align: center;
        margin-bottom: 80px;
        z-index: 5;
    }
    
    .activities-title {
        font-size: 46px;
        font-weight: 900;
        color: #0f172a;
        margin-bottom: 20px;
        letter-spacing: -0.03em;
        position: relative;
        display: inline-block;
    }
    
    .activities-title span {
        position: relative;
        display: inline-block;
        background: linear-gradient(90deg, #0f172a, #1e293b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .activities-title::before {
        content: '';
        position: absolute;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(248, 192, 84, 0.2) 0%, rgba(248, 192, 84, 0) 70%);
        top: -30px;
        left: -40px;
        z-index: -1;
    }
    
    .activities-title::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, #f8c054, rgba(245, 158, 11, 0.5));
        bottom: 5px;
        left: 0;
        z-index: -1;
        border-radius: 10px;
    }
    
    .activities-container {
        position: relative;
        width: 100%;
        padding: 30px 0;
        z-index: 5;
        overflow: visible;
    }
    
    .activities-track {
        position: relative;
        width: 100%;
        height: 560px; /* Significantly increased height */
        perspective: 2000px;
        transform-style: preserve-3d;
    }
    
    .activity-cards {
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1);
    }
    
    .activity-card {
        position: absolute;
        width: 420px; /* Increased width further */
        height: 540px; /* Increased height further */
        border-radius: 28px; /* Slightly larger radius */
        overflow: hidden;
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.1),
            0 3px 10px rgba(0, 0, 0, 0.05);
        transform-origin: center;
        transition: all 0.8s cubic-bezier(0.65, 0, 0.35, 1);
        opacity: 0.6;
        filter: brightness(0.7) blur(2px);
        transform: translateZ(-100px) translateX(0) scale(0.85);
        z-index: 1;
        will-change: transform, opacity, filter;
    }
    
    .activity-card.active {
        transform: translateZ(180px) translateX(0) scale(1); /* Increased Z distance */
        opacity: 1;
        filter: brightness(1) blur(0);
        z-index: 10;
        box-shadow: 
            0 30px 60px rgba(0, 0, 0, 0.2), /* Enhanced shadow */
            0 10px 20px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.05) inset,
            0 0 30px rgba(26, 115, 232, 0.1);
    }
    
    .activity-card.prev {
        transform: translateZ(0) translateX(-75%) scale(0.9) rotateY(8deg); /* Adjusted positioning */
        opacity: 0.8;
        filter: brightness(0.85) blur(1px);
        z-index: 5;
    }
    
    .activity-card.next {
        transform: translateZ(0) translateX(75%) scale(0.9) rotateY(-8deg); /* Adjusted positioning */
        opacity: 0.8;
        filter: brightness(0.85) blur(1px);
        z-index: 5;
    }
    
    .activity-card.far-prev {
        transform: translateZ(-100px) translateX(-150%) scale(0.8) rotateY(12deg); /* Adjusted positioning */
        opacity: 0.4;
        filter: brightness(0.7) blur(2px);
        z-index: 1;
    }
    
    .activity-card.far-next {
        transform: translateZ(-100px) translateX(150%) scale(0.8) rotateY(-12deg); /* Adjusted positioning */
        opacity: 0.4;
        filter: brightness(0.7) blur(2px);
        z-index: 1;
    }
    
    .activity-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        border-radius: 28px;
        transform: translateZ(0);
        box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.05) inset;
    }
    
    .card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.2s cubic-bezier(0.25, 1, 0.5, 1);
        will-change: transform;
    }
    
    .activity-card.active .card-image {
        animation: subtle-zoom 8s ease-in-out infinite alternate;
    }
    
    @keyframes subtle-zoom {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }
    
    .activity-card:hover .card-image {
        transform: scale(1.1);
    }
    
    .card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            0deg, 
            rgba(0, 0, 0, 0.95) 0%, 
            rgba(0, 0, 0, 0.7) 30%, 
            rgba(0, 0, 0, 0.1) 60%,
            rgba(0, 0, 0, 0) 100%
        );
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 35px 30px; /* Increased padding */
        border-radius: 28px;
    }
    
    .activity-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 28px;
        padding: 2px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0));
        -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
        pointer-events: none;
    }
    
    .activity-card.active::before,
    .activity-card:hover::before {
        opacity: 1;
    }
    
    .card-date {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        font-weight: 700;
        padding: 10px 16px; /* Increased padding */
        font-size: 14px; /* Increased font size */
        border-radius: 12px; /* Increased radius */
        letter-spacing: 0.5px;
        text-transform: uppercase;
        backdrop-filter: blur(10px);
        box-shadow: 
            0 4px 10px rgba(0, 0, 0, 0.2), 
            0 0 0 1px rgba(255, 255, 255, 0.15) inset;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s ease;
        transform: translateZ(0) translateY(0);
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    }
    
    .activity-card:hover .card-date,
    .activity-card.active:hover .card-date {
        background: linear-gradient(135deg, #f8c054, #f59e0b);
        color: #0f172a;
        transform: translateZ(20px) translateY(-5px);
        box-shadow: 
            0 15px 25px rgba(248, 192, 84, 0.4),
            0 0 0 1px rgba(248, 192, 84, 0.5) inset;
        text-shadow: none;
    }
    
    .activity-card.active .card-date {
        transform: translateY(-3px);
        background: rgba(248, 192, 84, 0.9);
        color: #0f172a;
        box-shadow: 
            0 10px 20px rgba(248, 192, 84, 0.3),
            0 0 0 1px rgba(248, 192, 84, 0.3) inset;
    }
    
    .card-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        padding: 8px 16px; /* Increased padding */
        font-size: 12px; /* Increased font size */
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(10px);
        margin-bottom: 16px; /* Increased margin */
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease;
        border-radius: 100px;
    }
    
    .card-category i {
        font-size: 12px;
        color: #f8c054;
    }
    
    .card-title {
        color: white;
        font-size: 28px; /* Increased font size further */
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 16px; /* Increased margin */
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        transform: translateY(10px);
        opacity: 0;
        transition: all 0.4s ease 0.1s;
        background: linear-gradient(to right, #fff, rgba(255, 255, 255, 0.8));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .card-description {
        color: rgba(255, 255, 255, 0.9);
        font-size: 17px; /* Increased font size further */
        line-height: 1.5;
        margin-bottom: 28px; /* Increased margin */
        display: -webkit-box;
        -webkit-line-clamp: 4; /* Show more lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        transform: translateY(15px);
        opacity: 0;
        transition: all 0.4s ease 0.2s;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }
    
    .card-link {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        color: #f8c054;
        font-weight: 600;
        font-size: 18px; /* Increased font size */
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.4s ease 0.3s;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }
    
    .card-link i {
        transition: transform 0.3s ease;
    }
    
    .activity-card:hover .card-category,
    .activity-card.active .card-category,
    .activity-card:hover .card-title,
    .activity-card.active .card-title,
    .activity-card:hover .card-description,
    .activity-card.active .card-description,
    .activity-card:hover .card-link,
    .activity-card.active .card-link {
        transform: translateY(0);
        opacity: 1;
    }
    
    .activity-card.active .card-title {
        background: linear-gradient(to right, #fff, #f8c054);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .activity-card:hover .card-link i {
        transform: translateX(5px);
    }
    
    .carousel-navigation {
        position: relative;
        display: flex;
        justify-content: center;
        gap: 30px; /* Increased gap */
        margin-top: 70px; /* Increased margin */
        z-index: 5;
    }
    
    .carousel-button {
        width: 70px; /* Increased size */
        height: 70px; /* Increased size */
        border-radius: 50%;
        background: white;
        color: #0f172a;
        border: none;
        font-size: 26px; /* Increased font size */
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        box-shadow: 
            0 10px 25px rgba(0, 0, 0, 0.05),
            0 5px 10px rgba(0, 0, 0, 0.02),
            0 0 0 1px rgba(0, 0, 0, 0.03);
        position: relative;
        overflow: hidden;
    }
    
    .carousel-button::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1a73e8, #0052cc);
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    
    .carousel-button i {
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }
    
    .carousel-button:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 20px 30px rgba(0, 0, 0, 0.1),
            0 5px 15px rgba(0, 0, 0, 0.05),
            0 0 0 1px rgba(26, 115, 232, 0.1);
    }
    
    .carousel-button:hover::before {
        opacity: 1;
    }
    
    .carousel-button:hover i {
        color: white;
        transform: scale(1.2);
    }
    
    .carousel-button::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
        transform: scale(0.5);
        pointer-events: none;
    }
    
    .carousel-button:active::after {
        opacity: 1;
        transform: scale(1);
        transition: transform 0s;
    }
    
    .carousel-dots {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 40px; /* Increased margin */
    }
    
    .carousel-dot {
        width: 12px; /* Increased size */
        height: 12px; /* Increased size */
        border-radius: 50%;
        background: #e2e8f0;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .carousel-dot:hover {
        background: #1a73e8;
    }
    
    .carousel-dot.active {
        width: 36px; /* Increased width */
        border-radius: 15px;
        background: linear-gradient(to right, #1a73e8, #0052cc);
        box-shadow: 0 4px 10px rgba(26, 115, 232, 0.3);
    }

    /* Lightbox Gallery */
    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        z-index: 1000;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .lightbox.active {
        display: block;
        opacity: 1;
    }

    .lightbox-header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        padding: 20px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1010;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), transparent);
    }

    .lightbox-title {
        color: white;
        font-size: 18px;
        font-weight: 600;
    }

    .lightbox-counter {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 40px;
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .lightbox-close:hover {
        background-color: white;
        color: var(--dark);
        transform: rotate(90deg);
    }

    .lightbox-content {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .lightbox-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.5s ease;
        z-index: 1005;
    }

    .lightbox-slide.active {
        opacity: 1;
        transform: translateX(0);
    }

    .lightbox-slide img {
        max-width: 80%;
        max-height: 80vh;
        object-fit: contain;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    .lightbox-caption {
        position: absolute;
        bottom: 120px;
        left: 0;
        width: 100%;
        text-align: center;
        color: white;
        padding: 20px;
        font-size: 16px;
    }

    .lightbox-nav {
        position: absolute;
        bottom: 40px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 20px;
        z-index: 1010;
    }

    .lightbox-arrow {
        width: 60px;
        height: 60px;
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .lightbox-arrow:hover {
        background-color: var(--primary);
        transform: scale(1.1);
    }

    .lightbox-thumbnails {
        position: absolute;
        bottom: 120px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 12px;
        padding: 0 40px;
        overflow-x: auto;
        scrollbar-width: none;
        z-index: 1010;
    }

    .lightbox-thumbnails::-webkit-scrollbar {
        display: none;
    }

    .lightbox-thumb {
        width: 80px;
        height: 60px;
        flex-shrink: 0;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.4;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .lightbox-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .lightbox-thumb.active {
        opacity: 1;
        border-color: var(--primary);
        transform: translateY(-5px) scale(1.1);
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        from { 
            opacity: 0;
            transform: translateY(30px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0) translateX(-50%); }
        40% { transform: translateY(-20px) translateX(-50%); }
        60% { transform: translateY(-10px) translateX(-50%); }
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .hero-title { font-size: 56px; }
        .content-grid { grid-template-columns: 2fr 1fr; }
        .related-title { font-size: 36px; }

        .activity-card {
            width: 380px;
            height: 500px;
        }
        
        .card-title {
            font-size: 26px;
        }
    }

    @media (max-width: 992px) {
        .cinematic-hero { min-height: 600px; }
        .hero-title { font-size: 46px; }
        .hero-subtitle { font-size: 18px; }
        .hero-meta { gap: 24px; }
        .meta-icon { width: 44px; height: 44px; }
        .showcase-gallery { height: 400px; }
        .content-grid { grid-template-columns: 1fr; gap: 32px; }

        .activities-track {
            height: 480px;
        }
        
        .activity-card {
            width: 340px;
            height: 460px;
        }
        
        .card-title {
            font-size: 24px;
        }
        
        .card-description {
            font-size: 16px;
        }
    }

    @media (max-width: 768px) {
        .cinematic-hero { min-height: 500px; }
        .hero-content { padding: 100px 5% 60px; }
        .hero-title { font-size: 36px; }
        .hero-subtitle { font-size: 16px; margin-bottom: 32px; }
        .hero-meta { flex-direction: column; gap: 16px; }
        .meta-block { width: 100%; }
        .showcase-gallery { height: 350px; }
        .main-content { padding: 32px 24px; }
        .content-section:not(:last-child) { margin-bottom: 36px; }
        .content-title { font-size: 20px; }
        .content-description { font-size: 16px; }
        .content-description p:first-of-type::first-letter { font-size: 48px; }
        
        .activities-track {
            height: 440px;
        }
        
        .activity-card {
            width: 300px;
            height: 420px;
        }
        
        .card-title {
            font-size: 22px;
        }
        
        .carousel-button {
            width: 60px;
            height: 60px;
            font-size: 22px;
        }
    }

    @media (max-width: 576px) {
        .hero-title { font-size: 28px; }
        .hero-content { padding: 80px 5% 50px; }
        .hero-category { padding: 6px 12px; font-size: 12px; margin-bottom: 16px; }
        .header-title { font-size: 16px; }
        .header-btn { padding: 0 16px; height: 40px; }
        .showcase-gallery { height: 280px; }
        .gallery-caption { padding: 40px 20px 20px; }
        .caption-title { font-size: 20px; }
        .preview-item { width: 80px; height: 60px; }
        .share-btn { width: 46px; height: 46px; }
        .related-title { font-size: 24px; }

        .activities-track {
            height: 400px;
        }
        
        .activity-card {
            width: 280px;
            height: 380px;
        }
        
        .card-title {
            font-size: 20px;
        }
        
        .card-description {
            font-size: 15px;
            -webkit-line-clamp: 3;
        }
    }
</style>

<div class="activity-showcase">
    <!-- Cinematic Hero Section -->
    <section class="cinematic-hero">
        <div class="hero-background">
            <img src="{{ asset('images/' . $activity->image) }}" alt="{{ $activity->title }}" class="hero-image">
        </div>
        <div class="hero-overlay"></div>
        
        <div class="hero-content">
            <div class="hero-category">
                <i class="fas fa-star"></i> Featured Event
            </div>
            
            <h1 class="hero-title">{{ $activity->title }}</h1>
            
            <p class="hero-subtitle">{{ Str::limit($activity->description, 150) }}</p>
            
            <div class="hero-meta">
                <div class="meta-block">
                    <div class="meta-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="meta-text">
                        <strong>{{ $activity->date->format('d F Y') }}</strong>
                        <span>Event Date</span>
                    </div>
                </div>
                
                @if(isset($activity->time))
                <div class="meta-block">
                    <div class="meta-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="meta-text">
                        <strong>{{ $activity->time }}</strong>
                        <span>Event Time</span>
                    </div>
                </div>
                @endif
                
                @if(isset($activity->location))
                <div class="meta-block">
                    <div class="meta-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="meta-text">
                        <strong>{{ Str::limit($activity->location, 30) }}</strong>
                        <span>Location</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <div class="scroll-indicator">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 13l5 5 5-5M7 6l5 5 5-5"/>
            </svg>
        </div>
    </section>
    
    <!-- Floating Header Bar -->
    <div class="header-bar">
        <div class="header-content">
            <h2 class="header-title">{{ $activity->title }}</h2>
            <div class="header-actions">
                <button class="header-btn" id="headerShareBtn">
                    <i class="fas fa-share-alt"></i> Share
                </button>
                <button class="header-btn" onclick="window.location.href='{{ route('activity') }}'">
                    <i class="fas fa-arrow-left"></i> Back to Events
                </button>
            </div>
        </div>
    </div>
    
    <!-- Content Area -->
    <div class="content-area">
        <div class="container">
            @if(count($activity->images) > 0)
            <!-- Image Showcase Section -->
            <section class="image-showcase">
                <div class="showcase-header">
                    <h2 class="showcase-title">Event Gallery</h2>
                    <div class="showcase-actions">
                        <button class="showcase-btn" id="prevGalleryBtn">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="showcase-btn" id="nextGalleryBtn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <button class="showcase-btn" id="expandGalleryBtn">
                            <i class="fas fa-expand-alt"></i>
                        </button>
                    </div>
                </div>
                
                <div class="showcase-gallery">
                    <div class="gallery-main">
                        <!-- Main Image -->
                        <div class="gallery-slide active" data-index="0">
                            <img src="{{ asset('images/' . $activity->image) }}" alt="{{ $activity->title }}" class="gallery-image">
                            <div class="gallery-caption">
                                <h3 class="caption-title">{{ $activity->title }}</h3>
                                <p class="caption-text">Featured image</p>
                            </div>
                        </div>
                        
                        <!-- Additional Images -->
                        @foreach($activity->images as $index => $image)
                        <div class="gallery-slide" data-index="{{ $index + 1 }}">
                            <img src="{{ asset('images/' . $image->image) }}" alt="{{ $activity->title }}" class="gallery-image">
                            <div class="gallery-caption">
                                <h3 class="caption-title">{{ $activity->title }}</h3>
                                <p class="caption-text">Image {{ $index + 1 }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="gallery-pagination">
                        <div class="gallery-dot active" data-index="0"></div>
                        @foreach($activity->images as $index => $image)
                        <div class="gallery-dot" data-index="{{ $index + 1 }}"></div>
                        @endforeach
                    </div>
                </div>
                
                <div class="gallery-preview">
                    <div class="preview-item active" data-index="0">
                        <img src="{{ asset('images/' . $activity->image) }}" alt="{{ $activity->title }}">
                    </div>
                    
                    @foreach($activity->images as $index => $image)
                    <div class="preview-item" data-index="{{ $index + 1 }}">
                        <img src="{{ asset('images/' . $image->image) }}" alt="{{ $activity->title }}">
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
            
            <!-- Content Grid -->
            <div class="content-grid">
                <div class="main-content">
                    <div class="content-section">
                        <div class="content-header">
                            <div class="content-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h2 class="content-title">About This Event</h2>
                        </div>
                        
                        <div class="content-description">
                            <p>{{ $activity->description }}</p>
                        </div>
                    </div>
                    
                    @if(isset($activity->details))
                    <div class="content-section">
                        <div class="content-header">
                            <div class="content-icon">
                                <i class="fas fa-list-ul"></i>
                                </div>
                            <h2 class="content-title">Event Details</h2>
                        </div>
                        
                        <div class="content-description">
                            <p>{{ $activity->details }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="sidebar">
                    <!-- Updated Event Info Card to match the image -->
                    <div class="event-info-card">
                        <div class="event-info-header">
                            <h3 class="event-info-title">Event Info</h3>
                        </div>
                        
                        <div class="event-info-content">
                            <div class="event-date-badge">
                                <span class="date-badge-day">{{ $activity->date->format('d') }}</span>
                                <span class="date-badge-month">{{ $activity->date->format('M') }}</span>
                            </div>
                            
                            <div class="event-date-details">
                                <div class="event-date-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                
                                <div class="event-date-text">
                                    <span class="weekday">{{ $activity->date->format('l') }}</span>
                                    <span class="full-date">{{ $activity->date->format('F d, Y') }}</span>
                                </div>
                            </div>
                            
                            <ul class="event-info-list">
                                @if(isset($activity->time))
                                <li class="event-info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Time</div>
                                        <div class="info-item-value">{{ $activity->time }}</div>
                                    </div>
                                </li>
                                @endif
                                
                                @if(isset($activity->location))
                                <li class="event-info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Location</div>
                                        <div class="info-item-value">{{ $activity->location }}</div>
                                    </div>
                                </li>
                                @endif
                                
                                @if(isset($activity->organizer))
                                <li class="event-info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Organized by</div>
                                        <div class="info-item-value">{{ $activity->organizer }}</div>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Updated Share Card to match the image -->
                    <div class="share-card">
                        <div class="share-header">
                            <h3 class="share-title">Share This Event</h3>
                        </div>
                        
                        <div class="share-content">
                            <div class="share-buttons">
                                <button class="share-btn facebook" onclick="shareOnFacebook()">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button class="share-btn twitter" onclick="shareOnTwitter()">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button class="share-btn linkedin" onclick="shareOnLinkedIn()">
                                    <i class="fab fa-linkedin-in"></i>
                                </button>
                                <button class="share-btn whatsapp" onclick="shareOnWhatsApp()">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Premium Overlapping Cards Activity Slider -->
    <section class="activities-carousel-section">
        <div class="container">
            <div class="activities-header">
                <h2 class="activities-title">Another <span>Activities</span></h2>
            </div>
            
            <div class="activities-container">
                <div class="activities-track" id="activitiesTrack">
                    <div class="activity-cards" id="activityCards">
                        @foreach($otherActivities as $index => $otherActivity)
                        <div class="activity-card {{ $index == 0 ? 'active' : ($index == 1 ? 'next' : ($index == count($otherActivities)-1 ? 'prev' : ($index == 2 ? 'far-next' : 'far-prev'))) }}" data-index="{{ $index }}">
                            <div class="activity-card-inner">
                                <img src="{{ asset('images/' . $otherActivity->image) }}" alt="{{ $otherActivity->title }}" class="card-image">
                                <div class="card-overlay">
                                    <div class="card-date">{{ $otherActivity->date->format('M d') }}</div>
                                    <div class="card-category">
                                        <i class="fas fa-star"></i> Featured Event
                                    </div>
                                    <h3 class="card-title">{{ $otherActivity->title }}</h3>
                                    <p class="card-description">{{ Str::limit($otherActivity->description, 120) }}</p>
                                    <a href="{{ route('activity.show', $otherActivity->id) }}" class="card-link">
                                        View Details <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="carousel-navigation">
                    <button class="carousel-button" id="prevButton">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-button" id="nextButton">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <div class="carousel-dots" id="carouselDots">
                    @foreach($otherActivities as $index => $otherActivity)
                    <div class="carousel-dot {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer CTA Section -->
    <div class="footer-cta">
        <h2 class="cta-title">Check Out More Activities</h2>
        <button class="primary-btn" onclick="window.location.href='{{ route('activity') }}'">
            <i class="fas fa-arrow-left"></i> Back to All Events
        </button>
    </div>
    
    <!-- Fullscreen Lightbox Gallery -->
    <div id="lightbox" class="lightbox">
        <div class="lightbox-header">
            <div class="lightbox-title">{{ $activity->title }}</div>
            <div class="lightbox-counter">
                <span id="current">1</span> / <span id="total">{{ count($activity->images) + 1 }}</span>
            </div>
        </div>
        
        <button class="lightbox-close">&times;</button>
        
        <div class="lightbox-content">
            <!-- Main Image -->
            <div class="lightbox-slide active" data-index="0">
                <img src="{{ asset('images/' . $activity->image) }}" alt="{{ $activity->title }}">
            </div>
            
            <!-- Additional Images -->
            @foreach($activity->images as $index => $image)
            <div class="lightbox-slide" data-index="{{ $index + 1 }}">
                <img src="{{ asset('images/' . $image->image) }}" alt="{{ $activity->title }}">
            </div>
            @endforeach
        </div>
        
        <div class="lightbox-caption">{{ $activity->title }}</div>
        
        <div class="lightbox-thumbnails">
            <div class="lightbox-thumb active" data-index="0">
                <img src="{{ asset('images/' . $activity->image) }}" alt="Thumbnail">
            </div>
            
            @foreach($activity->images as $index => $image)
            <div class="lightbox-thumb" data-index="{{ $index + 1 }}">
                <img src="{{ asset('images/' . $image->image) }}" alt="Thumbnail">
            </div>
            @endforeach
        </div>
        
        <div class="lightbox-nav">
            <button class="lightbox-arrow" id="prevSlide">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="lightbox-arrow" id="nextSlide">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables
        const images = [
            '{{ asset('images/' . $activity->image) }}'
            @foreach($activity->images as $image)
                , '{{ asset('images/' . $image->image) }}'
            @endforeach
        ];
        let currentImageIndex = 0;
        const totalImages = images.length;
        
        // References
        const header = document.querySelector('.header-bar');
        const scrollIndicator = document.querySelector('.scroll-indicator');
        
        // Header visibility on scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > window.innerHeight * 0.5) {
                header.classList.add('visible');
            } else {
                header.classList.remove('visible');
            }
        });
        
        // Scroll indicator click
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', function() {
                document.querySelector('.content-area').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        }
        
        // Gallery functionality
        if (document.querySelector('.showcase-gallery')) {
            const gallerySlides = document.querySelectorAll('.gallery-slide');
            const galleryDots = document.querySelectorAll('.gallery-dot');
            const previewItems = document.querySelectorAll('.preview-item');
            const prevBtn = document.getElementById('prevGalleryBtn');
            const nextBtn = document.getElementById('nextGalleryBtn');
            const expandBtn = document.getElementById('expandGalleryBtn');
            
            // Update gallery
            function updateGallery(index) {
                currentImageIndex = index;
                
                // Update slides
                gallerySlides.forEach(slide => slide.classList.remove('active'));
                gallerySlides[index].classList.add('active');
                
                // Update dots
                galleryDots.forEach(dot => dot.classList.remove('active'));
                galleryDots[index].classList.add('active');
                
                // Update preview
                previewItems.forEach(item => item.classList.remove('active'));
                previewItems[index].classList.add('active');
            }
            
            // Next and Previous
            prevBtn.addEventListener('click', function() {
                let index = (currentImageIndex - 1 + totalImages) % totalImages;
                updateGallery(index);
            });
            
            nextBtn.addEventListener('click', function() {
                let index = (currentImageIndex + 1) % totalImages;
                updateGallery(index);
            });
            
            // Dots navigation
            galleryDots.forEach(dot => {
                dot.addEventListener('click', function() {
                    let index = parseInt(this.getAttribute('data-index'));
                    updateGallery(index);
                });
            });
            
            // Preview thumbnails
            previewItems.forEach(item => {
                item.addEventListener('click', function() {
                    let index = parseInt(this.getAttribute('data-index'));
                    updateGallery(index);
                });
            });
            
            // Expand button - open lightbox
            expandBtn.addEventListener('click', openLightbox);
            
            // Open lightbox when clicking gallery image
            gallerySlides.forEach(slide => {
                slide.addEventListener('click', function() {
                    let index = parseInt(this.getAttribute('data-index'));
                    currentImageIndex = index;
                    openLightbox();
                });
            });
        }
        
        // Lightbox functionality
        const lightbox = document.getElementById('lightbox');
        const lightboxSlides = document.querySelectorAll('.lightbox-slide');
        const lightboxThumbs = document.querySelectorAll('.lightbox-thumb');
        const lightboxClose = document.querySelector('.lightbox-close');
        const prevSlide = document.getElementById('prevSlide');
        const nextSlide = document.getElementById('nextSlide');
        const currentCounter = document.getElementById('current');
        
        function openLightbox() {
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
            updateLightbox(currentImageIndex);
        }
        
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        function updateLightbox(index) {
            currentImageIndex = index;
            
            // Update slides
            lightboxSlides.forEach(slide => slide.classList.remove('active'));
            lightboxSlides[index].classList.add('active');
            
            // Update thumbnails
            lightboxThumbs.forEach(thumb => thumb.classList.remove('active'));
            lightboxThumbs[index].classList.add('active');
            
            // Update counter
            currentCounter.textContent = index + 1;
            
            // Scroll active thumbnail into view
            lightboxThumbs[index].scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'center'
            });
        }
        
        // Lightbox controls
        lightboxClose.addEventListener('click', closeLightbox);
        
        prevSlide.addEventListener('click', function() {
            let index = (currentImageIndex - 1 + totalImages) % totalImages;
            updateLightbox(index);
        });
        
        nextSlide.addEventListener('click', function() {
            let index = (currentImageIndex + 1) % totalImages;
            updateLightbox(index);
        });
        
        // Thumbnail click
        lightboxThumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                let index = parseInt(this.getAttribute('data-index'));
                updateLightbox(index);
            });
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (lightbox.classList.contains('active')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide.click();
                } else if (e.key === 'ArrowRight') {
                    nextSlide.click();
                }
            }
        });
        
        // Sharing functionality
        const headerShareBtn = document.getElementById('headerShareBtn');
        
        if (headerShareBtn) {
            headerShareBtn.addEventListener('click', function() {
                const shareCard = document.querySelector('.share-card');
                shareCard.scrollIntoView({ behavior: 'smooth' });
                
                // Highlight share card briefly
                shareCard.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    shareCard.style.transform = '';
                }, 1000);
            });
        }
        
        // Social sharing functions
        window.shareOnFacebook = function() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        };
        
        window.shareOnTwitter = function() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent('{{ $activity->title }}');
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
        };
        
        window.shareOnLinkedIn = function() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $activity->title }}');
            const summary = encodeURIComponent('{{ Str::limit($activity->description, 100) }}');
            window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}&summary=${summary}`, '_blank');
        };
        
        window.shareOnWhatsApp = function() {
            const text = encodeURIComponent('{{ $activity->title }}: ' + window.location.href);
            window.open(`https://wa.me/?text=${text}`, '_blank');
        };
        
        // Hero parallax effect
        const heroImage = document.querySelector('.hero-image');
        
        if (heroImage) {
            window.addEventListener('scroll', function() {
                const scrollPosition = window.pageYOffset;
                if (scrollPosition < window.innerHeight) {
                    heroImage.style.transform = `scale(1.05) translateY(${scrollPosition * 0.2}px)`;
                }
            });
        }
        
        // Activity Cards Carousel
        const cardsContainer = document.getElementById('activityCards');
        const cards = document.querySelectorAll('.activity-card');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const dots = document.querySelectorAll('.carousel-dot');
        const totalCards = cards.length;
        let currentCardIndex = 0;
        
        // Initial setup
        updateCardClasses();
        
        // Next button click
        nextButton.addEventListener('click', function() {
            currentCardIndex = (currentCardIndex + 1) % totalCards;
            updateCardClasses();
        });
        
        // Previous button click
        prevButton.addEventListener('click', function() {
            currentCardIndex = (currentCardIndex - 1 + totalCards) % totalCards;
            updateCardClasses();
        });
        
        // Dot navigation
        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                currentCardIndex = parseInt(this.getAttribute('data-index'));
                updateCardClasses();
            });
        });
        
        // Swipe support for touch devices
        let touchStartX = 0;
        let touchEndX = 0;
        
        cardsContainer.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        cardsContainer.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
        
        function handleSwipe() {
            const minSwipeDistance = 50;
            if (touchEndX < touchStartX - minSwipeDistance) {
                // Swipe left
                nextButton.click();
            } else if (touchEndX > touchStartX + minSwipeDistance) {
                // Swipe right
                prevButton.click();
            }
        }
        
        // Update card classes based on current index
        function updateCardClasses() {
            cards.forEach((card, index) => {
                // Remove all position classes
                card.classList.remove('active', 'prev', 'next', 'far-prev', 'far-next');
                
                // Calculate relative position
                let position = (index - currentCardIndex + totalCards) % totalCards;
                
                // Apply appropriate class
                if (position === 0) {
                    card.classList.add('active');
                } else if (position === 1 || position === (totalCards - 1)) {
                    card.classList.add(position === 1 ? 'next' : 'prev');
                } else if (position === 2 || position === (totalCards - 2)) {
                    card.classList.add(position === 2 ? 'far-next' : 'far-prev');
                } else {
                    // Hide other cards by moving them far away
                    card.style.transform = 'translateX(' + (position > 2 ? '200%' : '-200%') + ') scale(0.7)';
                    card.style.opacity = '0';
                    card.style.zIndex = '0';
                    
                    // Reset after animation completes
                    setTimeout(() => {
                        card.style.transform = '';
                        card.style.opacity = '';
                        card.style.zIndex = '';
                    }, 800);
                }
            });
            
            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentCardIndex);
            });
        }
        
        // Auto-advance carousel
        let autoplayInterval = setInterval(() => {
            nextButton.click();
        }, 5000);
        
        // Pause autoplay on hover
        document.querySelector('.activities-container').addEventListener('mouseenter', () => {
            clearInterval(autoplayInterval);
        });
        
        // Resume autoplay on mouse leave
        document.querySelector('.activities-container').addEventListener('mouseleave', () => {
            autoplayInterval = setInterval(() => {
                nextButton.click();
            }, 5000);
        });
        
        // Handle visibility change to pause when tab is inactive
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden') {
                clearInterval(autoplayInterval);
            } else {
                autoplayInterval = setInterval(() => {
                    nextButton.click();
                }, 5000);
            }
        });
    });
</script>
@endsection
                        