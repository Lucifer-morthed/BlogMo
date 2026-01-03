@extends('web.layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen bg-slate-50">
        <!-- Dashboard Header -->
        <div class="bg-white border-b border-slate-200 z-30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Welcome back, {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="mt-2 text-slate-600">Here's what's happening with your blog today.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('post.create') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all shadow-lg shadow-indigo-500/30 hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Write New Post
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- User Profile Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 text-center group hover:shadow-md transition-all duration-300">
                        <div class="relative w-24 h-24 mx-auto mb-4">
                            <div class="absolute inset-0 bg-indigo-100 rounded-full animate-pulse"></div>
                            <div class="relative w-full h-full bg-gradient-to-br from-indigo-500 to-violet-600 rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-slate-500 mb-4">{{ Auth::user()->email }}</p>

                        @if(Auth::user()->isAdmin())
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                Administrator
                            </span>
                        @elseif(Auth::user()->hasRole('editor'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                Editor
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                Author
                            </span>
                        @endif
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="bg-white rounded-2xl shadow-sm border border-slate-100 p-3 space-y-1">
                        <a href="#overview"
                            class="flex items-center px-4 py-3 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all group font-medium">
                            <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Overview
                        </a>
                        <a href="#posts"
                            class="flex items-center px-4 py-3 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all group font-medium">
                            <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            My Posts
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.index') }}"
                                class="flex items-center px-4 py-3 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all group font-medium">
                                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Admin Panel
                            </a>
                        @endif
                    </nav>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-3 space-y-8">
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="overview">
                        <!-- Total Posts -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Total Posts</p>
                                    <p class="text-3xl font-bold text-slate-900 mt-2 group-hover:text-indigo-600 transition-colors">{{ $posts->total() }}</p>
                                </div>
                                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Published -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Published</p>
                                    <p class="text-3xl font-bold text-slate-900 mt-2 group-hover:text-green-600 transition-colors">
                                        {{ $posts->where('published_at', '!=', null)->count() }}</p>
                                </div>
                                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Drafts -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Drafts</p>
                                    <p class="text-3xl font-bold text-slate-900 mt-2 group-hover:text-amber-600 transition-colors">
                                        {{ $posts->where('published_at', null)->count() }}</p>
                                </div>
                                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="{{ route('post.create') }}"
                                class="flex items-center justify-center gap-3 p-4 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors group">
                                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <span class="font-medium text-slate-900">New Post</span>
                            </a>
                            <a href="#posts"
                                class="flex items-center justify-center gap-3 p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-colors group">
                                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-slate-900">View Posts</span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-center gap-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors group">
                                <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-slate-900">Analytics</span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-center gap-3 p-4 bg-amber-50 hover:bg-amber-100 rounded-xl transition-colors group">
                                <div class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-slate-900">Settings</span>
                            </a>
                        </div>
                    </div>
                    <!-- Posts List -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" id="posts">
                        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                            <h2 class="text-lg font-bold text-slate-900">Recent Posts</h2>
                            <div class="flex gap-2">
                                <select
                                    class="text-sm border-slate-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white shadow-sm"
                                    onchange="filterPosts(this.value)">
                                    <option value="all">All Status</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>

                        @if($posts->count() > 0)
                            <div class="divide-y divide-slate-100">
                                @foreach($posts as $post)
                                    <div class="p-6 hover:bg-slate-50 transition-colors post-item group">
                                        <div class="flex items-start gap-5">
                                            <div class="shrink-0">
                                                @if($post->featured_image)
                                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                                        class="w-32 h-20 object-cover rounded-xl shadow-sm group-hover:shadow-md transition-all duration-300">
                                                @else
                                                    <div class="w-32 h-20 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 shadow-inner">
                                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-3 mb-1">
                                                    <h3 class="text-lg font-bold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                                                        {{ $post->title }}
                                                    </h3>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $post->published_at ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }} status-badge">
                                                        {{ $post->published_at ? 'Published' : 'Draft' }}
                                                    </span>
                                                </div>
                                                <p class="text-sm text-slate-500 line-clamp-2 mb-3 leading-relaxed">
                                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                                                </p>
                                                <div class="flex items-center gap-4 text-xs font-medium text-slate-400">
                                                    <span class="flex items-center bg-slate-50 px-2 py-1 rounded-md border border-slate-100">
                                                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $post->created_at->format('M j, Y') }}
                                                    </span>
                                                    <span class="flex items-center bg-slate-50 px-2 py-1 rounded-md border border-slate-100">
                                                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                        </svg>
                                                        {{ $post->categories->pluck('name')->join(', ') ?: 'Uncategorized' }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-2 self-center">
                                                <a href="{{ route('post.edit', $post->id) }}"
                                                    class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all duration-200"
                                                    title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('post.delete', $post->id) }}" method="POST" class="inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200"
                                                        title="Delete">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                                {{ $posts->links() }}
                            </div>
                        @else
                            <div class="text-center py-16">
                                <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6 text-indigo-400 animate-bounce">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">No posts yet</h3>
                                <p class="text-slate-500 max-w-sm mx-auto mb-8">Your blog is looking a bit empty. Share your thoughts with the world by creating your first post!</p>
                                <a href="{{ route('post.create') }}"
                                    class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all shadow-lg shadow-indigo-500/30 hover:-translate-y-1">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Create Your First Post
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Manage Categories Section -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mt-8">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Manage Categories
                        </h2>
                        <!-- Add Category Form -->
                        <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-6 flex gap-2">
                            @csrf
                            <input type="text" name="name" placeholder="New category name" required class="flex-1 px-4 py-2 border rounded-xl focus:ring-indigo-500">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">Add
                            </button>
                        </form>
                        <!-- Categories List -->
                        <ul class="divide-y divide-slate-100">
                            @foreach($categories as $category)
                                <li class="py-2 flex items-center justify-between">
                                    <span class="font-medium text-slate-700">{{ $category->name }}</span>
                                    @if(Auth::user()->isAdmin())
                                    <div class="flex gap-2">
                                        <!-- Edit Category -->
                                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="inline-flex gap-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="name" value="{{ $category->name }}" class="px-2 py-1 border rounded-xl text-xs">
                                            <button type="submit" class="px-2 py-1 bg-indigo-500 text-white rounded-xl text-xs hover:bg-indigo-600">Edit</button>
                                        </form>
                                        <!-- Delete Category -->
                                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-xl text-xs hover:bg-red-600">Delete</button>
                                        </form>
                                    </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterPosts(status) {
            const items = document.querySelectorAll('.post-item');
            items.forEach(item => {
                const badge = item.querySelector('.status-badge');
                const isPublished = badge.textContent.trim() === 'Published';

                if (status === 'all') {
                    item.style.display = '';
                } else if (status === 'published') {
                    item.style.display = isPublished ? '' : 'none';
                } else if (status === 'draft') {
                    item.style.display = !isPublished ? '' : 'none';
                }
            });
        }
    </script>
@endsection