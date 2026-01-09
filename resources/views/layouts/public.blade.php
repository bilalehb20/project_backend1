<!DOCTYPE html>
<html lang="nl" id="html-root">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PhoneShop - Telefoon Webshop')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            /* PhoneShop Modern Color Palette - Premium */
            --primary: #111827;
            --accent: #2563EB;
            --accent-hover: #1d4ed8;
            --accent-light: #3b82f6;
            --like-active: #EF4444;
            /* Legacy support */
            --phoneshop-blue: #2563EB;
            --phoneshop-blue-hover: #1d4ed8;
            --phoneshop-blue-light: #3b82f6;
            --phoneshop-blue-dark: #1e40af;
            --light-blue: #2563EB;
            --light-blue-dark: #2563EB;
            --light-blue-light: #3b82f6;
            --light-blue-hover: #1d4ed8;
        }

        /* Modern Typography */
        * {
            font-family: 'Poppins', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        /* Light Mode Variables - Modern PhoneShop Theme */
        .theme-light {
            --bg-primary: #F9FAFB;
            --bg-secondary: #FFFFFF;
            --bg-tertiary: #FFFFFF;
            --text-primary: #111827;
            --text-secondary: #374151;
            --text-muted: #6B7280;
            --text-link: #2563EB;
            --text-link-hover: #1d4ed8;
            --text-accent: #2563EB;
            --border-color: #E5E5E5;
            --card-bg: #FFFFFF;
            --input-bg: #FFFFFF;
            --hover-bg: #F9F9F9;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 12px 24px -6px rgba(37, 99, 235, 0.2), 0 6px 12px -3px rgba(37, 99, 235, 0.15);
        }

        /* Dark Mode Variables - Modern PhoneShop Theme */
        .theme-dark {
            --bg-primary: #030712;
            --bg-secondary: #111827;
            --bg-tertiary: #1F2937;
            --text-primary: #FFFFFF;
            --text-secondary: #E5E7EB;
            --text-muted: #9CA3AF;
            --text-link: #3b82f6;
            --text-link-hover: #60a5fa;
            --text-accent: #3b82f6;
            --border-color: #333333;
            --card-bg: #1E1E1E;
            --input-bg: #1E1E1E;
            --hover-bg: #2A2A2A;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
            --shadow-hover: 0 12px 24px -6px rgba(59, 130, 246, 0.3), 0 6px 12px -3px rgba(59, 130, 246, 0.2);
        }

        /* Apply theme colors */
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Poppins', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .bg-white {
            background-color: var(--bg-primary) !important;
        }

        .bg-gray-100 {
            background-color: var(--bg-secondary) !important;
        }

        .bg-gray-800 {
            background-color: var(--bg-tertiary) !important;
        }

        .text-gray-700 {
            color: var(--text-secondary) !important;
        }

        .text-gray-800 {
            color: var(--text-primary) !important;
        }

        .text-gray-600 {
            color: var(--text-muted) !important;
        }

        .text-gray-500 {
            color: var(--text-muted) !important;
        }

        .text-gray-400 {
            color: var(--text-muted) !important;
        }

        .text-light-blue-dark {
            color: var(--text-link) !important;
        }

        .hover\:text-light-blue-dark:hover {
            color: var(--text-link-hover) !important;
        }

        .hover\:text-light-blue-hover:hover {
            color: var(--text-link-hover) !important;
        }

        .border-gray-200 {
            border-color: var(--border-color) !important;
        }

        .border-gray-300 {
            border-color: var(--border-color) !important;
        }

        .border-light-blue-dark {
            border-color: var(--text-link) !important;
        }

        .light-blue-bg {
            background-color: var(--accent);
        }

        .light-blue-dark-bg {
            background-color: var(--accent);
        }

        /* Modern CTA Button Styles */
        .cta-button {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .cta-button:hover {
                color: var(--text-link-hover);
                transform: translateX(4px);
            }
        }

        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: var(--card-bg);
            border-color: var(--border-color);
            width: 100%;
            max-width: 100%;
            border-radius: 0.75rem; /* rounded-xl */
            box-shadow: var(--shadow-sm);
            will-change: transform;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .product-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 0.75rem;
            border: 2px solid transparent;
            transition: border-color 0.3s ease;
            pointer-events: none;
            z-index: 1;
        }

        /* Product card overlay on hover */
        .product-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s var(--ease-out);
            z-index: 5;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.5rem;
            pointer-events: none;
        }

        .product-card-overlay-content {
            transform: translateY(20px);
            transition: transform 0.3s var(--ease-out);
            opacity: 0;
        }

        /* Modern Hover Effects - PhoneShop Style */
        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .product-card:hover {
                transform: translateY(-4px); /* hover:-translate-y-1 = -4px */
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); /* hover:shadow-xl */
                border-color: var(--text-link);
            }

            .product-card:hover::before {
                border-color: var(--text-link);
            }

            .product-card:hover .product-card-overlay {
                opacity: 1;
                pointer-events: auto;
            }

            .product-card:hover .product-card-overlay-content {
                transform: translateY(0);
                opacity: 1;
            }

            /* Category cards hover */
            .category-brand-card:hover {
                transform: translateY(-4px) scale(1.02);
            }
        }

        .product-card:focus-visible {
            outline: 2px solid var(--text-link);
            outline-offset: 2px;
        }

        .product-card-image-container {
            transition: all 0.3s var(--ease-out);
            overflow: hidden;
        }

        .product-card-image {
            transition: transform 0.4s var(--ease-out);
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .product-card:hover .product-card-image {
                transform: scale(1.03);
            }
        }

        .product-card-price {
            transition: color 0.25s var(--ease-out);
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .product-card:hover .product-card-price {
                color: var(--text-link-hover);
            }
        }

        .product-card-title {
            transition: color 0.25s var(--ease-out);
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .product-card:hover .product-card-title {
                color: var(--text-link);
            }
        }

        .like-button {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .like-button:hover {
                transform: scale(1.1);
                background-color: var(--hover-bg);
            }

            .like-button:hover svg {
                transform: scale(1.1);
            }
        }

        .like-button:active {
            transform: scale(0.9);
            transition: transform 0.1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .like-button:focus-visible {
            outline: 2px solid var(--text-link);
            outline-offset: 2px;
        }

        .like-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Like button bounce animation - Modern */
        @keyframes likeBounce {
            0%, 100% { 
                transform: scale(1); 
            }
            25% { 
                transform: scale(1.4) rotate(-8deg); 
            }
            50% { 
                transform: scale(1.3) rotate(8deg); 
            }
            75% { 
                transform: scale(1.2) rotate(-4deg); 
            }
        }

        .like-button.liked {
            animation: likeBounce 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .like-button.liked svg {
            color: var(--like-active); /* #EF4444 */
        }

        .like-button:not(.liked) svg {
            color: var(--text-muted);
        }

        @media (hover: hover) {
            .like-button:not(.liked):hover svg {
                color: var(--like-active); /* #EF4444 */
            }
        }

        /* Pulse animation for liked state */
        @keyframes likePulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
        }

        .like-button.liked svg {
            animation: likePulse 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Dark mode specific adjustments - Modern */
        .theme-dark .product-card {
            box-shadow: var(--shadow-sm);
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .theme-dark .product-card:hover {
                box-shadow: var(--shadow-hover);
            }
        }

        /* Category Banner - Modern Style */
        .category-banner {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .category-banner:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-lg);
            }
        }

        /* Hero Section - Modern PhoneShop Style */
        .hero-gradient-bg {
            background: linear-gradient(135deg, #0056FF 0%, #0044CC 100%);
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .hero-gradient-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .theme-dark .hero-gradient-bg {
            background: linear-gradient(135deg, #001A66 0%, #000D33 100%);
        }

        .theme-dark .hero-gradient-bg::before {
            background: radial-gradient(circle at 20% 50%, rgba(51, 153, 255, 0.15) 0%, transparent 50%);
        }

        /* Profile Gradient - Same as Hero */
        .phone-gradient {
            background: linear-gradient(135deg, #0056FF 0%, #0044CC 100%);
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .theme-dark .phone-gradient {
            background: linear-gradient(135deg, #001A66 0%, #000D33 100%);
        }

        .hero-pattern {
            background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0);
            background-size: 40px 40px;
        }

        .theme-dark .hero-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.2) 1px, transparent 0);
        }

        .hero-title,
        .hero-subtitle,
        .hero-text {
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .theme-dark .hero-title,
        .theme-dark .hero-subtitle,
        .theme-dark .hero-text {
            color: #f9fafb !important;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-cta-button {
            background-color: #ffffff;
            color: #0056FF;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .hero-cta-button::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 86, 255, 0.1), rgba(0, 68, 204, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .hero-cta-button:hover {
            background-color: #F2F2F2;
            color: #0044CC;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 86, 255, 0.25);
        }

        .hero-cta-button:hover::before {
            opacity: 1;
        }

        .hero-cta-button:active {
            transform: translateY(-1px) scale(0.98);
        }

        .theme-dark .hero-cta-button {
            background-color: #FFFFFF;
            color: #2563EB;
        }

        .theme-dark .hero-cta-button:hover {
            background-color: #F0F0F0;
            color: #1d4ed8;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        /* Smooth theme transitions */
        body, .product-card, .bg-white, .bg-gray-100, .text-gray-800, .text-gray-700 {
            transition: background-color 0.3s var(--ease-out), color 0.3s var(--ease-out), border-color 0.3s var(--ease-out);
        }

        /* Ensure grid items don't break layout */
        .grid > * {
            min-width: 0;
        }

        /* Force 3 column grid on large screens */
        @media (min-width: 1024px) {
            .grid.lg\:grid-cols-3 {
                display: grid !important;
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            }
        }

        /* Apple-style easing */
        :root {
            --ease-out: cubic-bezier(0.4, 0.0, 0.2, 1);
            --ease-in-out: cubic-bezier(0.4, 0.0, 0.2, 1);
        }

        /* CTA Button Animations - Apple style */
        .cta-button {
            transition: all 0.25s var(--ease-out);
            position: relative;
            overflow: hidden;
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .cta-button:hover {
                transform: scale(1.05);
                box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.15), 0 4px 8px -2px rgba(0, 0, 0, 0.1);
            }
            
            .cta-button:active {
                transform: scale(0.95);
                transition: transform 0.1s var(--ease-out);
            }
        }

        .cta-button:focus-visible {
            outline: 2px solid var(--text-link);
            outline-offset: 2px;
        }

        /* All buttons with hover effects */
        button:not(.like-button):not(:disabled),
        .button:not(:disabled) {
            transition: all 0.2s var(--ease-out);
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            button:not(.like-button):not(:disabled):hover,
            .button:not(:disabled):hover {
                transform: scale(1.05);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }
            
            button:not(.like-button):not(:disabled):active,
            .button:not(:disabled):active {
                transform: scale(0.95);
            }
        }

        /* Hero Animation - Apple style */
        .hero-fade-in {
            opacity: 0;
            transform: translateY(24px);
            animation: fadeInUpApple 0.8s var(--ease-out) forwards;
        }

        .hero-fade-in-delay-1 {
            animation-delay: 0.2s;
        }

        .hero-fade-in-delay-2 {
            animation-delay: 0.4s;
        }

        @keyframes fadeInUpApple {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Skeleton Loaders - Apple style */
        .skeleton {
            background: linear-gradient(90deg, var(--bg-secondary) 0%, var(--hover-bg) 50%, var(--bg-secondary) 100%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.8s var(--ease-in-out) infinite;
            border-radius: 0.5rem;
        }

        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        .skeleton-image {
            width: 100%;
            height: 220px;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .skeleton-text {
            height: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.25rem;
        }

        .skeleton-title {
            height: 1.5rem;
            width: 80%;
            margin-bottom: 0.75rem;
            border-radius: 0.25rem;
        }

        .skeleton-price {
            height: 1.75rem;
            width: 40%;
            border-radius: 0.25rem;
        }

        @media (prefers-reduced-motion: reduce) {
            .skeleton {
                animation: none;
                background: var(--bg-secondary);
            }
            .hero-fade-in {
                animation: none;
                opacity: 1;
                transform: none;
            }
            .scroll-reveal {
                animation: none;
                opacity: 1;
                transform: none;
            }
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
        }

        /* Scroll Reveal Animation - Apple style */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s var(--ease-out), transform 0.6s var(--ease-out);
            visibility: visible !important;
        }

        .scroll-reveal.revealed {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        /* Fallback: Auto-reveal items after delay if JS hasn't revealed them */
        @keyframes fadeInFallback {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* NEWS SECTION VISIBILITY FIX - CRITICAL */
        #home-news-section {
            position: relative;
            z-index: 1;
            overflow: visible !important;
            min-height: 450px;
            padding-bottom: 2rem;
        }

        #home-news-section .grid {
            overflow: visible !important;
            display: grid !important;
            min-height: 350px;
        }

        /* Force all news cards to be visible */
        #home-news-section .scroll-reveal,
        #home-news-section .news-article-card {
            display: block !important;
            visibility: visible !important;
            position: relative !important;
        }

        /* Auto-reveal animation - starts hidden but shows quickly */
        #home-news-section .news-article-card.scroll-reveal {
            opacity: 0;
            transform: translateY(15px);
            animation: newsAutoReveal 0.6s var(--ease-out) 0.2s forwards;
        }

        /* When JavaScript reveals them */
        #home-news-section .news-article-card.revealed {
            opacity: 1 !important;
            transform: translateY(0) !important;
            animation: none;
        }

        @keyframes newsAutoReveal {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered animation for grid items */
        .scroll-reveal.revealed:nth-child(1) { transition-delay: 0ms; }
        .scroll-reveal.revealed:nth-child(2) { transition-delay: 50ms; }
        .scroll-reveal.revealed:nth-child(3) { transition-delay: 100ms; }
        .scroll-reveal.revealed:nth-child(4) { transition-delay: 150ms; }
        .scroll-reveal.revealed:nth-child(5) { transition-delay: 200ms; }
        .scroll-reveal.revealed:nth-child(6) { transition-delay: 250ms; }
        .scroll-reveal.revealed:nth-child(n+7) { transition-delay: 300ms; }

        @media (prefers-reduced-motion: reduce) {
            .scroll-reveal {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        /* Loading states and accessibility */
        button:disabled,
        .button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid var(--text-link);
            outline-offset: 2px;
        }

        /* Smooth image loading */
        img {
            transition: opacity 0.3s var(--ease-out);
        }

        img[loading="lazy"] {
            opacity: 0;
        }

        img[loading="lazy"].loaded {
            opacity: 1;
        }

        /* News Image Styling */
        .news-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s var(--ease-out), opacity 0.3s var(--ease-out);
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .news-image:hover {
                transform: scale(1.05);
            }
        }

        /* Responsive news images */
        @media (max-width: 640px) {
            .news-image {
                object-fit: cover;
                height: 200px;
            }
        }

        /* News card improvements */
        .product-card.group:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .theme-dark .product-card.group:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        /* Category/Brand Card Styles */
        .category-brand-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-image-container {
            position: relative;
            overflow: hidden;
        }

        .category-image {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.75) 100%);
            opacity: 0;
            transition: opacity 0.3s var(--ease-out);
            z-index: 5;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 1rem;
            pointer-events: none;
        }

        .category-overlay-content {
            transform: translateY(10px);
            transition: transform 0.3s var(--ease-out);
            opacity: 0;
            text-align: center;
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .category-brand-card:hover .category-image {
                transform: scale(1.05);
            }

            .category-brand-card:hover .category-overlay {
                opacity: 1;
            }

            .category-brand-card:hover .category-overlay-content {
                transform: translateY(0);
                opacity: 1;
            }

            .category-brand-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-hover);
            }
        }

        /* Category banner hover effects - Modern */
        .category-banner {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .category-banner:hover {
                transform: translateY(-6px);
                box-shadow: var(--shadow-hover);
            }

            .category-banner:hover .cta-button {
                transform: scale(1.05) translateY(-2px);
            }

            .category-banner:hover h3,
            .category-banner:hover p {
                transform: translateX(4px);
                transition: transform 0.3s var(--ease-out);
            }
        }

        /* Category cards hover */
        .category-card {
            transition: all 0.3s var(--ease-out);
        }

        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .category-card:hover {
                transform: translateY(-2px) scale(1.02);
            }
        }

        /* Filter dropdown animations */
        select {
            transition: all 0.2s var(--ease-out);
        }

        select:hover {
            border-color: var(--text-link);
        }

        select:focus {
            transform: scale(1.01);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Checkbox and radio animations */
        input[type="checkbox"],
        input[type="radio"] {
            transition: all 0.2s var(--ease-out);
        }

        input[type="checkbox"]:checked,
        input[type="radio"]:checked {
            animation: checkBounce 0.3s var(--ease-out);
        }

        @keyframes checkBounce {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .scroll-container {
            overflow-x: auto !important;
            overflow-y: visible !important;
            scrollbar-width: thin;
            scrollbar-color: var(--light-blue) transparent;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
            width: 100%;
            position: relative;
        }
        
        .scroll-container > div {
            display: flex !important;
            flex-wrap: nowrap !important;
            align-items: stretch;
        }
        
        /* Ensure category items are always visible */
        #categories-scroll a {
            visibility: visible !important;
            opacity: 1 !important;
            display: inline-block !important;
        }
        
        /* Category card styling */
        #categories-scroll .product-card {
            min-height: 160px;
            display: flex !important;
            flex-direction: column;
        }
        
        /* Text contrast for dark mode */
        .theme-dark #categories-scroll .text-gray-800 {
            color: #e5e7eb !important;
        }
        
        .theme-dark #categories-scroll .bg-gray-100 {
            background-color: #1f2937 !important;
        }
        
        .theme-dark #categories-scroll .bg-gray-200 {
            background-color: #374151 !important;
        }
        
        .theme-dark #categories-scroll .bg-gray-50 {
            background-color: #374151 !important;
        }
        
        /* Ensure icons are visible */
        #categories-scroll span[class*="text-4xl"] {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            font-size: 2.25rem !important;
            line-height: 1 !important;
        }

        .scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        .scroll-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .scroll-container::-webkit-scrollbar-thumb {
            background: var(--light-blue);
            border-radius: 4px;
        }

        .scroll-container::-webkit-scrollbar-thumb:hover {
            background: var(--light-blue-dark);
        }

        /* Scroll buttons visibility enhancement */
        .scroll-container + button,
        button[onclick*="scrollCategories"] {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1) !important;
        }

        .theme-dark button[onclick*="scrollCategories"] {
            background: rgba(31, 41, 55, 0.95) !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5), 0 10px 10px -5px rgba(0, 0, 0, 0.3) !important;
        }

        button[onclick*="scrollCategories"]:hover {
            transform: scale(1.1);
            box-shadow: 0 20px 35px -5px rgba(59, 130, 246, 0.4), 0 10px 15px -5px rgba(59, 130, 246, 0.2) !important;
        }

        button[onclick*="scrollCategories"]:active {
            transform: scale(0.95);
        }

        /* Ensure buttons are always visible */
        button[onclick*="scrollCategories"] svg {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        /* Dark mode specific adjustments */
        .theme-dark .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
        }

        .theme-dark input[type="text"],
        .theme-dark input[type="email"],
        .theme-dark input[type="password"],
        .theme-dark textarea,
        .theme-dark select {
            background-color: var(--input-bg);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .theme-dark .hover\:bg-gray-100:hover {
            background-color: var(--hover-bg) !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white">
    <!-- Main Header -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center">
                        <div class="grid grid-cols-2 gap-0.5">
                            <div class="w-3 h-3 bg-light-blue-dark rounded-sm"></div>
                            <div class="w-3 h-3 bg-light-blue rounded-sm"></div>
                            <div class="w-3 h-3 bg-light-blue rounded-sm"></div>
                            <div class="w-3 h-3 bg-light-blue-dark rounded-sm"></div>
                        </div>
                    </div>
                    <div class="text-xl font-bold text-gray-800">PHONE<span class="font-normal">SHOP</span></div>
                </a>

                <!-- Right Actions - Theme Toggle & User Dropdown -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none transition-all duration-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-light-blue-dark" aria-label="Toggle theme">
                        <svg id="theme-icon-light" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg id="theme-icon-dark" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 hover:opacity-80 focus:outline-none transition-opacity duration-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-light-blue-dark rounded">
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-700 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="{ 'transform rotate-180': open }">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 z-50 border border-gray-200"
                             style="display: none;">
                            <a href="{{ route('favorites.index') }}" 
                               id="favorites-link-dropdown" 
                               class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150 {{ auth()->user()->likes()->count() > 0 ? '' : 'hidden' }}">
                                ❤️ Mijn Favorieten
                            </a>
                            <a href="{{ route('profile.show', auth()->user()) }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                                Profiel Bekijken
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                                Profiel Bewerken
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                    Uitloggen
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-[#0056FF] dark:hover:text-[#3399FF] font-medium transition-colors duration-200">
                            Login
                        </a>
                        <span class="text-gray-400 dark:text-gray-600 mx-2">|</span>
                        <a href="{{ route('register') }}" class="text-[#0056FF] dark:text-[#3399FF] hover:text-[#0044CC] dark:hover:text-[#4DB3FF] font-medium transition-colors duration-200">
                            Registreren
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="bg-gray-100 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-8 h-14">
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-light-blue-dark font-medium transition-colors duration-200 {{ request()->routeIs('products.*') ? 'text-light-blue-dark border-b-2 border-light-blue-dark pb-1' : '' }}">
                    Producten
                </a>
                <a href="{{ route('news.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-[#0056FF] dark:hover:text-[#3399FF] font-medium transition-colors duration-200 {{ request()->routeIs('news.*') ? 'text-[#0056FF] dark:text-[#3399FF] border-b-2 border-[#0056FF] dark:border-[#3399FF] pb-1' : '' }}">
                    Nieuws
                </a>
                @auth
                    <a href="{{ route('favorites.index') }}" 
                       id="favorites-link-navbar" 
                       class="text-gray-700 dark:text-gray-300 hover:text-[#0056FF] dark:hover:text-[#3399FF] font-medium transition-colors duration-200 {{ request()->routeIs('favorites.*') ? 'text-[#0056FF] dark:text-[#3399FF] border-b-2 border-[#0056FF] dark:border-[#3399FF] pb-1' : '' }} {{ auth()->user()->likes()->count() > 0 ? '' : 'hidden' }}">
                        ❤️ Favorieten
                    </a>
                @endauth
                <a href="{{ route('faq.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-[#0056FF] dark:hover:text-[#3399FF] font-medium transition-colors duration-200 {{ request()->routeIs('faq.*') ? 'text-[#0056FF] dark:text-[#3399FF] border-b-2 border-[#0056FF] dark:border-[#3399FF] pb-1' : '' }}">
                    FAQ
                </a>
                <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-light-blue-dark font-medium transition-colors duration-200 {{ request()->routeIs('contact.*') ? 'text-light-blue-dark border-b-2 border-light-blue-dark pb-1' : '' }}">
                    Contact
                </a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-light-blue-dark font-medium transition-colors duration-200 {{ request()->routeIs('admin.*') ? 'text-light-blue-dark border-b-2 border-light-blue-dark pb-1' : '' }}">
                            Dashboard
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </div>

    <main class="min-h-screen">
        @if(session('success'))
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-900 text-white mt-16 border-t border-gray-700 dark:border-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand Section -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xl font-bold mb-4">PhoneShop</h3>
                    <p class="text-gray-300 dark:text-gray-400 mb-4 max-w-md">
                        Jouw betrouwbare partner voor de nieuwste telefoons, accessoires en hoesjes. 
                        Kwaliteit, service en de beste prijzen.
                    </p>
                    <!-- Social Links -->
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors" aria-label="Facebook">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors" aria-label="Twitter">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors" aria-label="Instagram">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Snel naar</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition-colors">Producten</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-gray-300 hover:text-white transition-colors">Nieuws</a></li>
                        <li><a href="{{ route('faq.index') }}" class="text-gray-300 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="{{ route('contact.index') }}" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-300 dark:text-gray-400">
                        <li>📧 info@phoneshop.be</li>
                        <li>📞 +32 2 123 45 67</li>
                        <li>📍 Brussel, België</li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 dark:border-gray-800 pt-8 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-300 dark:text-gray-400 text-sm mb-4 sm:mb-0">
                    &copy; {{ date('Y') }} PhoneShop. Alle rechten voorbehouden.
                </p>
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle in Footer -->
                    <button id="theme-toggle-footer" class="p-2 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 transition-colors" aria-label="Toggle theme">
                        <svg id="theme-icon-light-footer" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg id="theme-icon-dark-footer" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Theme Toggle Functionality
        (function() {
            const htmlElement = document.getElementById('html-root');
            const themeToggle = document.getElementById('theme-toggle');
            const themeIconLight = document.getElementById('theme-icon-light');
            const themeIconDark = document.getElementById('theme-icon-dark');

            // Get saved theme or default to light
            const currentTheme = localStorage.getItem('theme') || 'light';

            // Footer theme icons
            const themeIconLightFooter = document.getElementById('theme-icon-light-footer');
            const themeIconDarkFooter = document.getElementById('theme-icon-dark-footer');

            // Apply theme on page load
            function applyTheme(theme) {
                if (theme === 'dark') {
                    htmlElement.classList.remove('theme-light');
                    htmlElement.classList.add('theme-dark');
                    if (themeIconLight) themeIconLight.classList.add('hidden');
                    if (themeIconDark) themeIconDark.classList.remove('hidden');
                    if (themeIconLightFooter) themeIconLightFooter.classList.add('hidden');
                    if (themeIconDarkFooter) themeIconDarkFooter.classList.remove('hidden');
                } else {
                    htmlElement.classList.remove('theme-dark');
                    htmlElement.classList.add('theme-light');
                    if (themeIconDark) themeIconDark.classList.add('hidden');
                    if (themeIconLight) themeIconLight.classList.remove('hidden');
                    if (themeIconDarkFooter) themeIconDarkFooter.classList.add('hidden');
                    if (themeIconLightFooter) themeIconLightFooter.classList.remove('hidden');
                }
            }

            // Initialize theme
            applyTheme(currentTheme);

            // Toggle theme function
            function toggleTheme() {
                const currentTheme = htmlElement.classList.contains('theme-dark') ? 'dark' : 'light';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', newTheme);
                applyTheme(newTheme);
            }

            // Toggle theme on button click
            if (themeToggle) {
                themeToggle.addEventListener('click', toggleTheme);
            }

            // Footer theme toggle
            const themeToggleFooter = document.getElementById('theme-toggle-footer');
            if (themeToggleFooter) {
                themeToggleFooter.addEventListener('click', toggleTheme);
            }
        })();

        // Sticky Navbar
        (function() {
            const header = document.querySelector('.bg-white.border-b');
            if (!header) return;

            let lastScroll = 0;
            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 100) {
                    header.classList.add('sticky', 'top-0', 'z-50', 'shadow-md');
                } else {
                    header.classList.remove('sticky', 'top-0', 'shadow-md');
                }
                
                lastScroll = currentScroll;
            });
        })();
    </script>
</body>
</html>


