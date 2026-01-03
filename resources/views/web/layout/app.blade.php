<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Blog')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 min-h-screen flex flex-col">

    {{-- Navbar with Glassmorphism --}}
    <nav class="bg-white/80 backdrop-blur-xl shadow-lg sticky top-0 z-50 border-b border-gray-100/50 transition-all duration-300"
        x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = window.pageYOffset > 20"
        :class="scrolled ? 'shadow-xl' : 'shadow-lg'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 rounded-xl blur-md opacity-75 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div
                                class="relative w-10 h-10 bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <span
                            class="text-xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent group-hover:scale-105 transition-transform duration-300 inline-block">FuturesBlog</span>
                    </a>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                        class="relative px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-200 group">
                        <span>Home</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </a>
                    <a href="#"
                        class="relative px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-200 group">
                        <span>Articles</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </a>
                    <a href="#"
                        class="relative px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-200 group">
                        <span>Categories</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </a>
                    <a href="#"
                        class="relative px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-200 group">
                        <span>About</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </a>
                </div>

                {{-- Auth Buttons --}}
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="relative px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-200 group">
                            <span>Dashboard</span>
                            <span
                                class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        </a>
                        <div class="relative" x-data="{ dropdown: false }">
                            <button @click="dropdown = !dropdown"
                                class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600 focus:outline-none group">
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-full blur opacity-50 group-hover:opacity-100 transition-opacity">
                                    </div>
                                    <div
                                        class="relative w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-600 to-purple-600 flex items-center justify-center text-white font-semibold shadow-md transform group-hover:scale-110 transition-all duration-200">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </div>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="dropdown ? 'rotate-180' : ''"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="dropdown" @click.away="dropdown = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-3 w-56 bg-white/90 backdrop-blur-xl rounded-2xl shadow-2xl py-2 border border-gray-100/50 overflow-hidden"
                                style="display: none;">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="#"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50/50 hover:text-indigo-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </a>
                                <a href="#"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50/50 hover:text-indigo-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Settings
                                </a>
                                <div class="border-t border-gray-100 my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50/50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="relative group">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-xl blur opacity-75 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div
                                class="relative px-6 py-2.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white rounded-xl font-semibold shadow-lg transform group-hover:scale-105 transition-all duration-200">
                                Get Started
                            </div>
                        </a>
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <div class="md:hidden flex items-center">
                    <button @click="open = !open"
                        class="p-2 rounded-lg text-gray-700 hover:text-indigo-600 hover:bg-indigo-50/50 transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" style="display: none;" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Enhanced Mobile Menu --}}
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden border-t border-gray-100/50 bg-white/95 backdrop-blur-xl" style="display: none;">
            <div class="px-4 pt-3 pb-4 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50/50 font-medium rounded-xl transition-all duration-200">Home</a>
                <a href="#"
                    class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50/50 font-medium rounded-xl transition-all duration-200">Articles</a>
                <a href="#"
                    class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50/50 font-medium rounded-xl transition-all duration-200">Categories</a>
                <a href="#"
                    class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50/50 font-medium rounded-xl transition-all duration-200">About</a>
                @auth
                    <div class="border-t border-gray-100 my-3"></div>
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50/50 font-medium rounded-xl transition-all duration-200">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-3 text-red-600 hover:bg-red-50/50 font-medium rounded-xl transition-all duration-200">Logout</button>
                    </form>
                @else
                    <div class="border-t border-gray-100 my-3"></div>
                    <a href="{{ route('login') }}"
                        class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50/50 font-medium rounded-xl transition-all duration-200">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white text-center font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Enhanced Footer --}}
    <footer class="relative mt-auto overflow-hidden bg-slate-900">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 lg:gap-14">
                {{-- About Section --}}
                <div class="space-y-5">
                    <div class="flex items-center space-x-3 mb-6">
                        <div
                            class="w-10 h-10 bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">FuturesBlog</span>
                    </div>
                    <p class="text-sm text-gray-300 leading-relaxed">
                        Creating the future of content, one story at a time. Join our community of writers and readers
                        exploring ideas that matter.
                    </p>

                    {{-- Enhanced Social Icons --}}
                    <div class="pt-4">
                        <h4 class="text-sm font-bold text-white mb-4 tracking-wide">Connect With Us</h4>
                        <div class="flex flex-wrap gap-2.5">
                            <a href="#" class="group relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg blur opacity-50 group-hover:opacity-100 transition-opacity">
                                </div>
                                <div
                                    class="relative w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 transform group-hover:scale-110 group-hover:-translate-y-1">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </div>
                            </a>
                            <a href="#" class="group relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-lg blur opacity-50 group-hover:opacity-100 transition-opacity">
                                </div>
                                <div
                                    class="relative w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 transform group-hover:scale-110 group-hover:-translate-y-1">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                    </svg>
                                </div>
                            </a>
                            <a href="#" class="group relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-blue-600 rounded-lg blur opacity-50 group-hover:opacity-100 transition-opacity">
                                </div>
                                <div
                                    class="relative w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 transform group-hover:scale-110 group-hover:-translate-y-1">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </div>
                            </a>
                            <a href="#" class="group relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-900 rounded-lg blur opacity-50 group-hover:opacity-100 transition-opacity">
                                </div>
                                <div
                                    class="relative w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 transform group-hover:scale-110 group-hover:-translate-y-1">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                                    </svg>
                                </div>
                            </a>
                            <a href="#" class="group relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-red-600 to-pink-600 rounded-lg blur opacity-50 group-hover:opacity-100 transition-opacity">
                                </div>
                                <div
                                    class="relative w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 transform group-hover:scale-110 group-hover:-translate-y-1">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Company Links --}}
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-5">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">About
                                us</a></li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Services</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Vision</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Mission</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Terms</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Privacy</a>
                        </li>
                    </ul>
                </div>

                {{-- More Links --}}
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-5">Resources</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Partners</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Business</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Careers</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Blog</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">FAQ</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-white hover:text-indigo-300 hover:translate-x-1 inline-block transition-all duration-200">Creative</a>
                        </li>
                    </ul>
                </div>

                {{-- Recent Posts --}}
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-5">Recent Posts</h3>
                    <div class="space-y-4">
                        @php
                            $recentPosts = \App\Models\Post::latest()->take(3)->get();
                        @endphp

                        @forelse($recentPosts as $post)
                            <div class="group">
                                <a href="{{ route('post.show', $post->slug) }}"
                                    class="flex gap-3 p-2 rounded-lg hover:bg-white/5 transition-all duration-200">
                                    <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://via.placeholder.com/60x60' }}"
                                        alt="{{ $post->title }}"
                                        class="w-14 h-14 object-cover rounded-lg group-hover:scale-105 transition-transform duration-200">
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="text-sm font-medium text-white group-hover:text-indigo-300 transition line-clamp-2">
                                            {{ $post->title }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $post->created_at->format('M d, Y') }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="group">
                                <div class="flex gap-3 p-2 rounded-lg">
                                    <div class="w-14 h-14 bg-white/10 rounded-lg"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-white">Start creating amazing content</p>
                                        <p class="text-xs text-gray-400 mt-1">Coming soon</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Bottom Copyright --}}
            <div class="mt-16 pt-8 border-t border-white/10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                    <p class="text-sm text-gray-300">
                        Copyright &copy;{{ date('Y') }} <span class="font-semibold text-white">FuturesBlog</span>. All
                        Rights Reserved.
                    </p>
                    <p class="text-sm text-gray-300">
                        Designed with <span class="text-red-500">❤</span> by
                        <a href="https://untree.co"
                            class="text-indigo-400 hover:text-indigo-300 transition">Untree.co</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>