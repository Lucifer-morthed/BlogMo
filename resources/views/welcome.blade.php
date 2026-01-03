@extends('web.layout.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="relative overflow-hidden min-h-screen">
        <!-- Background Video -->
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0"
            style="min-height: 100%; min-width: 100%;">
            <source src="/videos/hero-bg.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- Overlay for readability -->
        <div class="absolute inset-0 bg-black bg-opacity-40 z-10"></div>
        <div class="max-w-7xl mx-auto relative z-20 min-h-screen flex items-center">
            <div class="w-full">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Welcome to the future of</span>
                            <span class="block text-indigo-300 xl:inline">insightful writing</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-slate-200 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Discover stories, thinking, and expertise from writers on any topic. FuturesBlog is where good
                            ideas
                            find you.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg transition-all hover:-translate-y-1 shadow-lg shadow-indigo-500/30">
                                    Get started
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#latest-posts"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg transition-colors">
                                    Read posts
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="bg-slate-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Explore Topics</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}"
                        class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 hover:shadow-md hover:border-indigo-100 transition-all group">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                                <span class="text-lg font-bold">{{ substr($category->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                    {{ $category->name }}
                                </h3>
                                <p class="text-xs text-slate-500">{{ $category->posts_count }} posts</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Latest Posts -->
    <div id="latest-posts" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-slate-900 sm:text-4xl">Latest from the Blog</h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-slate-500 sm:mt-4">
                    Fresh ideas and updates from our community of writers.
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($latestPosts as $post)
                    <div
                        class="flex flex-col rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="flex-shrink-0">
                            @if ($post->featured_image)
                                <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $post->featured_image) }}"
                                    alt="{{ $post->title }}">
                            @else
                                <div class="h-48 w-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-indigo-600">
                                    @foreach ($post->categories as $category)
                                        <a href="{{ route('category.show', $category->slug) }}" class="hover:underline">
                                            {{ $category->name }}
                                        </a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                                <a href="{{ route('post.show', $post->slug) }}" class="block mt-2 group">
                                    <p
                                        class="text-xl font-semibold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                        {{ $post->title }}
                                    </p>
                                    <p class="mt-3 text-base text-slate-500 line-clamp-3">
                                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-bold shadow-sm">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-slate-900">
                                        {{ $post->user->name }}
                                    </p>
                                    <div class="flex space-x-1 text-sm text-slate-500">
                                        <time datetime="{{ $post->published_at }}">
                                            {{ $post->published_at->format('M j, Y') }}
                                        </time>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>{{ $post->reading_time ?? '5 min' }} read</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="#"
                    class="inline-flex items-center px-6 py-3 border border-slate-300 shadow-sm text-base font-medium rounded-xl text-slate-700 bg-white hover:bg-slate-50 transition-colors">
                    View All Posts
                </a>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="bg-indigo-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to dive in?</span>
                <span class="block text-indigo-200">Start your free trial today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-xl text-indigo-600 bg-white hover:bg-indigo-50 transition-colors">
                        Get started
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                        Log in
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection