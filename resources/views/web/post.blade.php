@extends('web.layout.app')

@section('title', $post->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Home
                </a>
            </li>
            @foreach($post->categories as $category)
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="{{ route('category.show', $category->slug) }}" class="ml-1 text-sm font-medium text-slate-500 hover:text-indigo-600 md:ml-2">{{ $category->name }}</a>
                </div>
            </li>
            @endforeach
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2 truncate max-w-xs">{{ Str::limit($post->title, 30) }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Main Content -->
        <article class="lg:col-span-2">
            <!-- Header -->
            <header class="mb-8">
                <div class="flex items-center space-x-2 mb-4">
                    @foreach($post->categories as $category)
                        <a href="{{ route('category.show', $category->slug) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition-colors">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6 leading-tight">{{ $post->title }}</h1>
                
                <div class="flex items-center justify-between border-b border-slate-200 pb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-bold text-slate-900">{{ $post->user->name }}</div>
                            <div class="text-sm text-slate-500">{{ $post->published_at->format('F j, Y') }} • {{ $post->published_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    
                    <!-- Share Buttons -->
                    <div class="flex space-x-2">
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($post->title) }}" target="_blank" class="p-2 text-slate-400 hover:text-[#1DA1F2] transition-colors" title="Share on Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="p-2 text-slate-400 hover:text-[#4267B2] transition-colors" title="Share on Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>
            </header>

            @if($post->featured_image)
                <div class="mb-10 rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
                </div>
            @endif

            <!-- Content -->
            <div class="prose prose-lg prose-slate max-w-none mb-12">
                {!! $post->content !!}
            </div>

            <!-- Comments Section -->
            <div class="bg-slate-50 rounded-2xl p-6 md:p-8 border border-slate-100" id="comments">
                <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                    {{ $post->comments->count() }} Comment{{ $post->comments->count() !== 1 ? 's' : '' }}
                </h3>

                @if(Auth::check())
                    <form action="{{ url('/comments') }}" method="POST" class="mb-8">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-4">
                            <label for="content" class="sr-only">Your comment</label>
                            <textarea name="content" id="content" rows="3" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-4" placeholder="Share your thoughts..." required></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                Post Comment
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-indigo-50 rounded-xl p-4 mb-8 text-center border border-indigo-100">
                        <p class="text-indigo-800 font-medium">Want to join the discussion?</p>
                        <div class="mt-2 space-x-2">
                            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold hover:underline">Login</a>
                            <span class="text-indigo-400">or</span>
                            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold hover:underline">Sign up</a>
                        </div>
                    </div>
                @endif

                <div class="space-y-6">
                    @forelse($post->comments as $comment)
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="flex-grow">
                                <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-sm font-bold text-slate-900">{{ $comment->user->name }}</h4>
                                        <span class="text-xs text-slate-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-slate-700 text-sm">{{ $comment->content }}</p>
                                </div>
                                
                                <!-- Replies -->
                                @if($comment->replies->count() > 0)
                                    <div class="mt-4 space-y-4 pl-4 border-l-2 border-slate-200">
                                        @foreach($comment->replies as $reply)
                                            <div class="flex space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-xs">
                                                        {{ substr($reply->user->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="flex-grow">
                                                    <div class="bg-white rounded-lg p-3 shadow-sm border border-slate-100">
                                                        <div class="flex items-center justify-between mb-1">
                                                            <h4 class="text-xs font-bold text-slate-900">{{ $reply->user->name }}</h4>
                                                            <span class="text-xs text-slate-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <p class="text-slate-700 text-xs">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-500 py-4">No comments yet.</p>
                    @endforelse
                </div>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="lg:col-span-1 space-y-8">
            <!-- Author Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg mb-4">
                    {{ substr($post->user->name, 0, 1) }}
                </div>
                <h3 class="text-lg font-bold text-slate-900">{{ $post->user->name }}</h3>
                <p class="text-indigo-600 text-sm font-medium mb-2">Author</p>
                <p class="text-slate-500 text-xs">Member since {{ $post->user->created_at->format('M Y') }}</p>
            </div>

            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Related Posts</h3>
                <div class="space-y-4">
                    @foreach($relatedPosts as $relatedPost)
                        <a href="{{ route('post.show', $relatedPost->slug) }}" class="group block">
                            <h4 class="text-sm font-medium text-slate-900 group-hover:text-indigo-600 transition-colors mb-1 line-clamp-2">{{ $relatedPost->title }}</h4>
                            <p class="text-xs text-slate-500">{{ $relatedPost->published_at->format('M j') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Categories -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Categories</h3>
                <div class="space-y-2">
                    @foreach($post->categories as $category)
                        <a href="{{ route('category.show', $category->slug) }}" class="flex items-center justify-between group p-2 rounded-lg hover:bg-slate-50 transition-colors">
                            <span class="text-slate-600 group-hover:text-indigo-600 font-medium transition-colors">{{ $category->name }}</span>
                            <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 group-hover:bg-indigo-100 group-hover:text-indigo-700 transition-colors">
                                {{ $category->posts_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection