@extends('web.layout.app')

@section('title', $category->name)

@section('content')
    <div class="bg-slate-900 py-16 sm:py-24 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-indigo-600 opacity-20 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-violet-600 opacity-20 blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <nav class="flex justify-center mb-6" aria-label="Breadcrumb">
                <ol
                    class="inline-flex items-center space-x-1 md:space-x-3 bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-slate-300 hover:text-white transition-colors">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-slate-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm font-medium text-white">{{ $category->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tight">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-lg text-slate-300 max-w-2xl mx-auto">{{ $category->description }}</p>
            @endif
            <div class="mt-6">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-500/20 text-indigo-200 border border-indigo-500/30">
                    {{ $posts->total() }} Posts
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Posts Section -->
            <div class="lg:col-span-2 space-y-8">
                @if($posts->count() > 0)
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
                                        <span class="text-slate-500 text-xs">{{ $post->published_at->format('M j, Y') }}</span>
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
                                        <span class="text-sm font-medium text-slate-700">{{ $post->user->name }}</span>
                                    </div>
                                    <a href="{{ route('post.show', $post->slug) }}"
                                        class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 flex items-center">
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
                @else
                    <div class="text-center py-16 bg-white rounded-2xl border border-slate-100 border-dashed">
                        <div
                            class="mb-4 inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900">No posts found</h3>
                        <p class="mt-1 text-slate-500">There are no published posts in this category yet.</p>
                        <div class="mt-6">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Browse All Posts
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Categories Widget -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">All Categories</h3>
                    <div class="space-y-2">
                        @foreach($categories as $cat)
                            <a href="{{ route('category.show', $cat->slug) }}"
                                class="flex items-center justify-between group p-2 rounded-lg hover:bg-slate-50 transition-colors {{ $cat->id === $category->id ? 'bg-indigo-50' : '' }}">
                                <span
                                    class="font-medium transition-colors {{ $cat->id === $category->id ? 'text-indigo-700' : 'text-slate-600 group-hover:text-indigo-600' }}">{{ $cat->name }}</span>
                                <span
                                    class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors {{ $cat->id === $category->id ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-600 group-hover:bg-indigo-100 group-hover:text-indigo-700' }}">
                                    {{ $cat->posts_count }}
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
                        <p class="text-indigo-100 mb-6 text-sm relative z-10">Create an account to write posts and engage with
                            our community.</p>
                        <a href="{{ route('login') }}"
                            class="block w-full text-center bg-white text-indigo-600 font-bold py-2.5 px-4 rounded-xl hover:bg-indigo-50 transition-colors shadow-md relative z-10">
                            Login / Register
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection