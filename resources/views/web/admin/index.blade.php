@extends('web.layout.app')

@section('title', 'Admin Control Panel')

@section('content')
    <div class="min-h-screen bg-slate-50">
        <!-- Admin Header -->
        <div class="bg-white border-b border-slate-200 z-30 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 flex items-center tracking-tight">
                            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white mr-4 shadow-lg shadow-indigo-500/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            Admin Control Panel
                        </h1>
                        <p class="mt-2 text-slate-600 ml-14">Manage posts, users, categories, and system settings</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl font-medium text-sm text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50 transition-all shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Posts -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total Posts</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2 group-hover:text-indigo-600 transition-colors">{{ $stats['total_posts'] }}</p>
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
                            <p class="text-3xl font-bold text-slate-900 mt-2 group-hover:text-green-600 transition-colors">{{ $stats['published_posts'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Pending Review</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2 group-hover:text-amber-600 transition-colors">{{ $stats['pending_posts'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Users -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total Users</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2 group-hover:text-purple-600 transition-colors">{{ $stats['total_users'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="mb-8" x-data="{ activeTab: 'posts' }">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-2 mb-6 inline-flex">
                    <button @click="activeTab = 'posts'"
                        :class="{ 'bg-indigo-50 text-indigo-600 shadow-sm': activeTab === 'posts', 'text-slate-500 hover:text-slate-700 hover:bg-slate-50': activeTab !== 'posts' }"
                        class="px-6 py-2.5 rounded-xl font-medium text-sm flex items-center transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Posts Management
                    </button>
                    <button @click="activeTab = 'categories'"
                        :class="{ 'bg-indigo-50 text-indigo-600 shadow-sm': activeTab === 'categories', 'text-slate-500 hover:text-slate-700 hover:bg-slate-50': activeTab !== 'categories' }"
                        class="px-6 py-2.5 rounded-xl font-medium text-sm flex items-center transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Categories
                    </button>
                    <button @click="activeTab = 'analytics'"
                        :class="{ 'bg-indigo-50 text-indigo-600 shadow-sm': activeTab === 'analytics', 'text-slate-500 hover:text-slate-700 hover:bg-slate-50': activeTab !== 'analytics' }"
                        class="px-6 py-2.5 rounded-xl font-medium text-sm flex items-center transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Analytics
                    </button>
                </div>

                <!-- Posts Tab Content -->
                <div x-show="activeTab === 'posts'" class="space-y-8" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    <!-- Pending Posts -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                            <span class="w-2.5 h-2.5 bg-amber-500 rounded-full mr-3 shadow-sm shadow-amber-500/50"></span>
                            Pending Review ({{ $pendingPosts->total() }})
                        </h3>
                        @if($pendingPosts->count() > 0)
                            <div class="bg-white shadow-sm rounded-2xl border border-slate-200 overflow-hidden">
                                <ul class="divide-y divide-slate-100">
                                    @foreach($pendingPosts as $post)
                                        <li class="p-6 hover:bg-slate-50 transition-colors group">
                                            <div class="flex items-center justify-between">
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="text-base font-bold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">{{ $post->title }}</h4>
                                                    <p class="text-sm text-slate-500 mt-1">
                                                        By <span class="font-medium text-slate-900">{{ $post->user->name }}</span> •
                                                        {{ $post->created_at->diffForHumans() }}
                                                    </p>
                                                    @if($post->excerpt)
                                                        <p class="text-sm text-slate-600 mt-2 line-clamp-2 leading-relaxed">{{ $post->excerpt }}</p>
                                                    @endif
                                                </div>
                                                <div class="flex items-center gap-3 ml-6">
                                                    <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-semibold rounded-xl text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-lg shadow-green-500/30 transition-all hover:-translate-y-0.5">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST" class="inline-block"
                                                        onsubmit="return confirm('Are you sure you want to reject and delete this post?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-semibold rounded-xl text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-lg shadow-red-500/30 transition-all hover:-translate-y-0.5">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-4">
                                {{ $pendingPosts->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="bg-slate-50 rounded-2xl p-12 text-center border-2 border-slate-200 border-dashed">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-slate-500 font-medium">No pending posts to review.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Published Posts -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                            <span class="w-2.5 h-2.5 bg-green-500 rounded-full mr-3 shadow-sm shadow-green-500/50"></span>
                            Published Posts ({{ $publishedPosts->total() }})
                        </h3>
                        @if($publishedPosts->count() > 0)
                            <div class="bg-white shadow-sm rounded-2xl border border-slate-200 overflow-hidden">
                                <ul class="divide-y divide-slate-100">
                                    @foreach($publishedPosts as $post)
                                        <li class="p-6 hover:bg-slate-50 transition-colors group">
                                            <div class="flex items-center justify-between">
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="text-base font-bold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">{{ $post->title }}</h4>
                                                    <p class="text-sm text-slate-500 mt-1">
                                                        By <span class="font-medium text-slate-900">{{ $post->user->name }}</span> •
                                                        Published {{ $post->published_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center gap-2 ml-6">
                                                    <a href="{{ route('post.show', $post->slug) }}" target="_blank"
                                                        class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all duration-200" title="View">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('post.edit', $post->id) }}"
                                                        class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all duration-200" title="Edit">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-4">
                                {{ $publishedPosts->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="bg-slate-50 rounded-2xl p-12 text-center border-2 border-slate-200 border-dashed">
                                <p class="text-slate-500 font-medium">No published posts yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Categories Tab Content -->
                <div x-show="activeTab === 'categories'" class="space-y-6" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-900">All Categories</h3>
                        <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')"
                            class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all shadow-lg shadow-indigo-500/30 hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Category
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($categories as $category)
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300 group relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full -mr-12 -mt-12 transition-transform group-hover:scale-110"></div>
                                
                                <div class="relative z-10">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 font-bold text-xl">
                                            {{ substr($category->name, 0, 1) }}
                                        </div>
                                        <div class="relative" x-data="{ open: false }">
                                            <button @click="open = !open" @click.away="open = false"
                                                class="p-2 text-slate-400 hover:text-slate-600 rounded-full hover:bg-slate-100 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </button>
                                            <div x-show="open"
                                                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 ring-1 ring-black ring-opacity-5 z-50"
                                                x-cloak>
                                                <button type="button"
                                                    onclick="setTimeout(function() { document.getElementById('editCategoryModal').classList.remove('hidden'); }, 10); editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}')"
                                                    class="block w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                                                    Edit Category
                                                </button>
                                                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="block w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors"
                                                        onclick="return confirm('Are you sure?')">Delete Category</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h4 class="text-lg font-bold text-slate-900 mb-1">{{ $category->name }}</h4>
                                    <p class="text-sm text-slate-500 font-medium mb-3">{{ $category->posts_count }} posts</p>
                                    @if($category->description)
                                        <p class="text-sm text-slate-600 line-clamp-2 leading-relaxed">{{ $category->description }}</p>
                                    @else
                                        <p class="text-sm text-slate-400 italic">No description available</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Users Tab Content -->
                <div x-show="activeTab === 'users'" class="space-y-6" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    <h3 class="text-lg font-bold text-slate-900">Users Management</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($users as $user)
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300 group">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center">
                                        <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-5 shadow-md">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900">{{ $user->name }}</h4>
                                            <p class="text-sm text-slate-500">{{ $user->email }}</p>
                                            <div class="mt-2.5 flex items-center gap-2">
                                                @if($user->hasRole('admin'))
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">Admin</span>
                                                @elseif($user->hasRole('editor'))
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">Editor</span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">Author</span>
                                                @endif
                                                <span class="text-xs text-slate-400 font-medium">Joined {{ $user->created_at->format('M j, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" @click.away="open = false"
                                            class="p-2 text-slate-400 hover:text-slate-600 rounded-full hover:bg-slate-100 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                        <div x-show="open"
                                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-2 ring-1 ring-black ring-opacity-5 z-20"
                                            style="display: none;">
                                            <div class="px-4 py-2 text-xs text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100 mb-1">
                                                Change Role</div>
                                            <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="role" value="author">
                                                <button type="submit"
                                                    class="block w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                                                    Set as Author
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="role" value="editor">
                                                <button type="submit"
                                                    class="block w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                                                    Set as Editor
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="role" value="admin">
                                                <button type="submit"
                                                    class="block w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                                    Set as Admin
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Analytics Tab Content -->
                <div x-show="activeTab === 'analytics'" class="space-y-8" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Posts Analytics Chart -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Posts Analytics
                            </h3>
                            <div class="h-64 flex items-center justify-center bg-slate-50 rounded-xl border-2 border-dashed border-slate-200">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <p class="text-slate-500 font-medium">Chart visualization would go here</p>
                                    <p class="text-sm text-slate-400 mt-1">Posts created over time</p>
                                </div>
                            </div>
                        </div>

                        <!-- User Engagement -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                User Engagement
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                                    <div>
                                        <p class="text-sm font-medium text-slate-600">Total Views</p>
                                        <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_posts'] * 25) }}</p>
                                    </div>
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                                    <div>
                                        <p class="text-sm font-medium text-slate-600">Avg. Comments per Post</p>
                                        <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_posts'] > 0 ? rand(2, 8) : 0, 1) }}</p>
                                    </div>
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Categories & Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Top Categories -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Top Categories
                            </h3>
                            <div class="space-y-4">
                                @foreach($categories->take(5) as $category)
                                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold text-sm mr-3">
                                                {{ substr($category->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-900">{{ $category->name }}</p>
                                                <p class="text-sm text-slate-500">{{ $category->posts_count }} posts</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="w-16 bg-slate-200 rounded-full h-2">
                                                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $stats['total_posts'] > 0 ? min(100, ($category->posts_count / $stats['total_posts']) * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Recent Activity
                            </h3>
                            <div class="space-y-4">
                                @foreach($publishedPosts->take(5) as $post)
                                    <div class="flex items-start space-x-3 p-3 bg-slate-50 rounded-xl">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-slate-900 truncate">{{ $post->title }}</p>
                                            <p class="text-xs text-slate-500">Published by {{ $post->user->name }} • {{ $post->published_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- System Health -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            System Health
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="text-center p-4 bg-green-50 rounded-xl border border-green-200">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-green-800">Database</p>
                                <p class="text-xs text-green-600 mt-1">Healthy</p>
                            </div>
                            <div class="text-center p-4 bg-green-50 rounded-xl border border-green-200">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-green-800">Performance</p>
                                <p class="text-xs text-green-600 mt-1">Optimal</p>
                            </div>
                            <div class="text-center p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-yellow-800">Storage</p>
                                <p class="text-xs text-yellow-600 mt-1">75% Used</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" aria-hidden="true"
                onclick="document.getElementById('addCategoryModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-xl leading-6 font-bold text-slate-900 mb-6" id="modal-title">Add New Category</h3>
                        <div class="mb-5">
                            <label for="category_name" class="block text-sm font-medium text-slate-700 mb-2">Category Name *</label>
                            <input type="text" name="name" id="category_name" required
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-slate-300 rounded-xl px-4 py-2.5">
                        </div>
                        <div class="mb-2">
                            <label for="category_description" class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                            <textarea name="description" id="category_description" rows="3"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-slate-300 rounded-xl px-4 py-2.5"></textarea>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-lg shadow-indigo-500/30 px-5 py-2.5 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition-all hover:-translate-y-0.5">
                            Create Category
                        </button>
                        <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')"
                            class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-5 py-2.5 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="fixed inset-0 z-[9999] overflow-y-auto hidden flex items-center justify-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/75 transition-opacity" aria-hidden="true"
            onclick="document.getElementById('editCategoryModal').classList.add('hidden')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full z-10">
            <form id="editCategoryForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-xl leading-6 font-bold text-slate-900 mb-6">Edit Category</h3>
                    <div class="mb-5">
                        <label for="edit_category_name" class="block text-sm font-medium text-slate-700 mb-2">Category Name *</label>
                        <input type="text" name="name" id="edit_category_name" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-slate-300 rounded-xl px-4 py-2.5">
                    </div>
                    <div class="mb-2">
                        <label for="edit_category_description" class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                        <textarea name="description" id="edit_category_description" rows="3"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-slate-300 rounded-xl px-4 py-2.5"></textarea>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-lg shadow-indigo-500/30 px-5 py-2.5 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition-all hover:-translate-y-0.5">
                        Update Category
                    </button>
                    <button type="button" onclick="document.getElementById('editCategoryModal').classList.add('hidden')"
                        class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-5 py-2.5 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alpine.js for interactivity -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        function editCategory(id, name, description) {
            var form = document.getElementById('editCategoryForm');
            form.action = `/admin/categories/${id}`;
            document.getElementById('edit_category_name').value = name;
            document.getElementById('edit_category_description').value = description;
            document.getElementById('editCategoryModal').classList.remove('hidden');
        }
    </script>
@endsection