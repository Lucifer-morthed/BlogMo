<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Results{{ $query ? ' for "' . $query . '"' : '' }} - {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Search results for {{ $query ?? 'blog posts' }} on {{ config('app.name', 'Laravel') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .search-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .post-card {
            transition: transform 0.2s;
        }
        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .search-summary {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .highlight {
            background-color: #fff3cd;
            padding: 2px 4px;
            border-radius: 3px;
        }
        .category-badge {
            background: #007bff;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin: 2px;
            display: inline-block;
        }
        .search-suggestions {
            background: #e7f3ff;
            border: 1px solid #b3d7ff;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Blog') }}</a>

            <div class="navbar-nav ms-auto">
                <form class="d-flex me-3" action="{{ route('search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search posts..." value="{{ $query }}" autofocus>
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>

                @if(Auth::check())
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-link nav-link" type="submit">Logout</button>
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Search Header -->
    <section class="search-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">
                        @if($query)
                            Search Results for "{{ $query }}"
                        @else
                            Search Blog Posts
                        @endif
                    </h1>

                    <div class="search-summary">
                        @if($query)
                            <p class="mb-2">
                                <strong>{{ $posts->total() }}</strong> result{{ $posts->total() !== 1 ? 's' : '' }} found for
                                <span class="highlight">"{{ $query }}"</span>
                            </p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('home') }}" class="btn btn-light btn-sm">← Back to Home</a>
                                @if($posts->count() === 0)
                                    <a href="{{ route('search') }}" class="btn btn-outline-light btn-sm">Clear Search</a>
                                @endif
                            </div>
                        @else
                            <p>Enter a search term to find posts...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Search Results -->
            <div class="col-lg-8">
                @if($query)
                    @if($posts->count() > 0)
                        @foreach($posts as $post)
                        <div class="card post-card mb-4">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                            @endif

                            <div class="card-body">
                                <h2 class="card-title h4">
                                    <a href="{{ route('post.show', $post->slug) }}" class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <p class="card-text text-muted small mb-2">
                                    By {{ $post->user->name }} • {{ $post->published_at->format('M j, Y') }}
                                </p>

                                @if($post->excerpt)
                                    <p class="card-text">{{ Str::limit($post->excerpt, 200) }}</p>
                                @else
                                    <p class="card-text">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                                @endif

                                <div class="mb-2">
                                    @foreach($post->categories as $category)
                                        <a href="{{ route('category.show', $category->slug) }}" class="category-badge text-decoration-none">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>

                                <a href="{{ route('post.show', $post->slug) }}" class="btn btn-primary btn-sm">Read More</a>
                            </div>
                        </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <!-- No Results -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-muted">
                                    <path d="M21 21l-4.35-4.35M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3 class="text-muted">No posts found</h3>
                            <p class="text-muted mb-4">We couldn't find any posts matching "{{ $query }}"</p>

                            <div class="search-suggestions">
                                <h5>Try these suggestions:</h5>
                                <ul class="list-unstyled mb-0">
                                    <li>• Check your spelling</li>
                                    <li>• Use fewer keywords</li>
                                    <li>• Try different keywords</li>
                                    <li>• Browse <a href="{{ route('home') }}">all posts</a> instead</li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('home') }}" class="btn btn-primary me-2">Browse All Posts</a>
                                <a href="{{ route('search') }}" class="btn btn-outline-secondary">New Search</a>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Search Form -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary">
                                <path d="M21 21l-4.35-4.35M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Search Our Blog</h3>
                        <p class="text-muted">Find articles, tutorials, and insights from our blog</p>

                        <div class="row justify-content-center mt-4">
                            <div class="col-md-6">
                                <form action="{{ route('search') }}" method="GET">
                                    <div class="input-group input-group-lg">
                                        <input
                                            type="search"
                                            name="q"
                                            class="form-control"
                                            placeholder="What are you looking for?"
                                            required
                                        >
                                        <button class="btn btn-primary" type="submit">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                                <path d="M21 21l-4.35-4.35M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted">Popular searches: Laravel, PHP, JavaScript, Web Development</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Browse by Category</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <a href="{{ route('category.show', $category->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Search Tips -->
                @if($query)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Search Tips</h5>
                        <ul class="list-unstyled small mb-0">
                            <li>• Use specific keywords</li>
                            <li>• Try synonyms</li>
                            <li>• Check spelling</li>
                            <li>• Use fewer words for broader results</li>
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Login/Register Card (if not authenticated) -->
                @if(!Auth::check())
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Join Our Community</h5>
                        <p class="card-text">Create an account to write posts and engage with our community.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
                @endif

                <!-- Quick Actions (if authenticated) -->
                @if(Auth::check())
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quick Actions</h5>
                        <a href="{{ route('post.create') }}" class="btn btn-success w-100 mb-2">Write New Post</a>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary w-100">My Dashboard</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>