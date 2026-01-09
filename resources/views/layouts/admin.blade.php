<!DOCTYPE html>
<html lang="nl" id="html-root">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --light-blue: #60A5FA;
            --light-blue-dark: #3B82F6;
            --light-blue-light: #93C5FD;
            --light-blue-hover: #2563EB;
        }

        /* Light Mode Variables */
        .theme-light {
            --bg-primary: #ffffff;
            --bg-secondary: #f3f4f6;
            --bg-tertiary: #ffffff;
            --bg-sidebar: #1f2937;
            --text-primary: #111827;
            --text-secondary: #374151;
            --text-muted: #6b7280;
            --text-link: #3B82F6;
            --text-link-hover: #2563EB;
            --text-accent: #2563EB;
            --border-color: #e5e7eb;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --hover-bg: #f9fafb;
            --sidebar-hover: #374151;
        }

        /* Dark Mode Variables */
        .theme-dark {
            --bg-primary: #1f2937;
            --bg-secondary: #111827;
            --bg-tertiary: #374151;
            --bg-sidebar: #111827;
            --text-primary: #f9fafb;
            --text-secondary: #e5e7eb;
            --text-muted: #9ca3af;
            --text-link: #60A5FA;
            --text-link-hover: #93C5FD;
            --text-accent: #60A5FA;
            --border-color: #4b5563;
            --card-bg: #374151;
            --input-bg: #1f2937;
            --hover-bg: #4b5563;
            --sidebar-hover: #374151;
        }

        body {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .bg-gray-100 {
            background-color: var(--bg-secondary) !important;
        }

        .bg-gray-800 {
            background-color: var(--bg-sidebar) !important;
        }

        .bg-gray-700 {
            background-color: var(--sidebar-hover) !important;
        }

        .bg-white {
            background-color: var(--bg-primary) !important;
        }

        .text-white {
            color: #ffffff !important;
        }

        .text-gray-600 {
            color: var(--text-secondary) !important;
        }

        .text-gray-500 {
            color: var(--text-muted) !important;
        }

        .text-gray-400 {
            color: var(--text-muted) !important;
        }

        .text-gray-800 {
            color: var(--text-primary) !important;
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

        .border-light-blue-dark {
            border-color: var(--text-link) !important;
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

        .theme-dark table {
            background-color: var(--card-bg);
        }

        .theme-dark table td,
        .theme-dark table th {
            border-color: var(--border-color);
            color: var(--text-primary);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Gebruikers
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.news.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Nieuws
                    </a>
                    <a href="{{ route('admin.faq-categories.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.faq-categories.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        FAQ Categorieën
                    </a>
                    <a href="{{ route('admin.faq-questions.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.faq-questions.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        FAQ Vragen
                    </a>
                    <a href="{{ route('admin.contact-messages.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Contactberichten
                    </a>
                    <a href="{{ route('home') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                        ← Terug naar site
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-semibold">@yield('page-title', 'Dashboard')</h1>
                    <div class="flex items-center space-x-4">
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none transition" aria-label="Toggle theme">
                            <svg id="theme-icon-light" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                            <svg id="theme-icon-dark" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </button>
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Uitloggen</button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Theme Toggle Functionality
        (function() {
            const htmlElement = document.getElementById('html-root');
            const themeToggle = document.getElementById('theme-toggle');
            const themeIconLight = document.getElementById('theme-icon-light');
            const themeIconDark = document.getElementById('theme-icon-dark');

            // Get saved theme or default to light
            const currentTheme = localStorage.getItem('theme') || 'light';

            // Apply theme on page load
            function applyTheme(theme) {
                if (theme === 'dark') {
                    htmlElement.classList.remove('theme-light');
                    htmlElement.classList.add('theme-dark');
                    themeIconLight.classList.add('hidden');
                    themeIconDark.classList.remove('hidden');
                } else {
                    htmlElement.classList.remove('theme-dark');
                    htmlElement.classList.add('theme-light');
                    themeIconDark.classList.add('hidden');
                    themeIconLight.classList.remove('hidden');
                }
            }

            // Initialize theme
            applyTheme(currentTheme);

            // Toggle theme on button click
            themeToggle.addEventListener('click', function() {
                const currentTheme = htmlElement.classList.contains('theme-dark') ? 'dark' : 'light';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                localStorage.setItem('theme', newTheme);
                applyTheme(newTheme);
            });
        })();
    </script>
</body>
</html>


