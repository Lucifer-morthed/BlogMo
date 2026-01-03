@extends('web.layout.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section with Video Background -->
    <div class="relative overflow-hidden min-h-screen flex items-center justify-center">
        <!-- Background Video -->
        <video autoplay loop muted playsinline preload="metadata"
            class="absolute inset-0 w-full h-full object-cover z-0"
            style="filter: brightness(0.4) contrast(1.1);"
            id="hero-video">
            <source src="/videos/hero-bg5.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- Enhanced Overlay for readability -->
        <div class="absolute inset-0 bg-gradient-to-br from-black/50 via-black/30 to-black/60 z-10"></div>
        <!-- Additional overlay for better text contrast -->
        <div class="absolute inset-0 bg-black/20 z-15"></div>
        <div class="relative z-20 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Posts Section -->
                    <div class="lg:col-span-2 space-y-8">
                        <div class="border-b border-slate-200 pb-4 mb-6">
                            <h1 class="text-3xl font-bold text-white">Latest Posts</h1>
                        </div>

                        @foreach($posts as $post)
                            <article
                                class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-slate-100 flex flex-col md:flex-row">
                                @if($post->featured_image)
                                    <div class="md:w-1/3 h-48 md:h-auto relative">
                                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                                            class="absolute inset-0 w-full h-full object-cover" alt="{{ $post->title }}">
                                    </div>
                                @endif

                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center space-x-2 mb-3">
                                            @foreach($post->categories as $category)
                                                <a href="{{ route('category.show', $category->slug) }}"
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition-colors">
                                                    {{ $category->name }}
                                                </a>
                                            @endforeach
                                            <span class="text-slate-400 text-xs">•</span>
                                            <span class="text-slate-200 text-xs">{{ $post->published_at->format('M j, Y') }}</span>
                                        </div>

                                        <h2 class="text-xl font-bold text-slate-900 mb-2 group">
                                            <a href="{{ route('post.show', $post->slug) }}"
                                                class="group-hover:text-indigo-600 transition-colors">
                                                {{ $post->title }}
                                            </a>
                                        </h2>

                                        @if($post->excerpt)
                                            <p class="text-slate-600 text-sm line-clamp-3 mb-4">{{ Str::limit($post->excerpt, 150) }}</p>
                                        @endif
                                    </div>

                                    <div class="flex items-center justify-between mt-4 border-t border-slate-50 pt-4">
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-500">
                                                {{ substr($post->user->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-medium text-slate-200">{{ $post->user->name }}</span>
                                        </div>
                                        <a href="{{ route('post.show', $post->slug) }}"
                                            class="text-sm font-semibold text-indigo-200 hover:text-indigo-300 flex items-center">
                                            Read more
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $posts->links() }}
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Categories Widget -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Categories
                            </h3>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                    <a href="{{ route('category.show', $category->slug) }}"
                                        class="flex items-center justify-between group p-2 rounded-lg hover:bg-slate-50 transition-colors">
                                        <span
                                            class="text-slate-600 group-hover:text-indigo-600 font-medium transition-colors">{{ $category->name }}</span>
                                        <span
                                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 group-hover:bg-indigo-100 group-hover:text-indigo-700 transition-colors">
                                            {{ $category->posts_count }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Join Community Widget (if not authenticated) -->
                        @if(!Auth::check())
                            <div
                                class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
                                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl">
                                </div>
                                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl">
                                </div>

                                <h3 class="text-xl font-bold mb-2 relative z-10">Join Our Community</h3>
                                <p class="text-indigo-100 mb-6 text-sm relative z-10">Create an account to write posts, share your
                                    thoughts, and engage with our growing community.</p>
                                <a href="{{ route('login') }}"
                                    class="block w-full text-center bg-white text-indigo-600 font-bold py-2.5 px-4 rounded-xl hover:bg-indigo-50 transition-colors shadow-md relative z-10">
                                    Login / Register
                                </a>
                            </div>
                        @endif

                        <!-- Quick Actions (if authenticated) -->
                        @if(Auth::check())
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                                <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Quick Actions
                                </h3>
                                <div class="space-y-3">
                                    <a href="{{ route('post.create') }}"
                                        class="flex items-center justify-center w-full bg-indigo-600 text-white font-semibold py-2.5 px-4 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm hover:shadow-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Write New Post
                                    </a>
                                    <a href="{{ route('dashboard') }}"
                                        class="flex items-center justify-center w-full bg-white text-slate-700 font-semibold py-2.5 px-4 rounded-xl border border-slate-200 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                                        Manage Posts
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Speed Control Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('hero-video');
            if (video) {
                video.playbackRate = 1.5; // Play at half speed (50% slower)
            }
        });
    </script>
@endsection