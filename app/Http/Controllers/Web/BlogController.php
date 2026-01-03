<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    /**
     * Display the home page with latest posts
     */
    public function home(): View
    {
        $posts = Post::with(['user', 'categories'])
            ->published()
            ->latest('published_at')
            ->paginate(4);

        $categories = Category::withCount('posts')->get();

        return view('web.home', compact('posts', 'categories'));
    }

    /**
     * Display a single post
     */
    public function post(string $slug): View
    {
        $post = Post::with(['user', 'categories', 'comments' => function ($query) {
            $query->with('user')->whereNull('parent_id')->with('replies');
        }])
        ->where('slug', $slug)
        ->whereNotNull('published_at')
        ->firstOrFail();

        // Get related posts from same categories
        $relatedPosts = Post::with(['user', 'categories'])
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($query) use ($post) {
                $query->whereIn('categories.id', $post->categories->pluck('id'));
            })
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('web.post', compact('post', 'relatedPosts'));
    }

    /**
     * Display posts by category
     */
    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()
            ->with(['user', 'categories'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount('posts')->get();

        return view('web.category', compact('category', 'posts', 'categories'));
    }

    /**
     * Search posts
     */
    public function search(Request $request): View
    {
        $query = $request->get('q', '');

        $posts = collect([]);
        if ($query) {
            $posts = Post::where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%")
                  ->orWhere('excerpt', 'LIKE', "%{$query}%");
            })
            ->with(['user', 'categories'])
            ->published()
            ->latest('published_at')
            ->paginate(12);
        }

        $categories = Category::withCount('posts')->get();

        return view('web.search', compact('posts', 'query', 'categories'));
    }

    /**
     * Display dashboard for authenticated users
     */
    public function dashboard(): View
    {
        $user = Auth::user();
        $posts = $user->posts()->with('categories')->latest()->paginate(10);
        $categories = Category::all();
        return view('web.dashboard', compact('posts', 'categories'));
    }

    /**
     * Show create post form
     */
    public function createPost(): View
    {
        $categories = Category::all();
        return view('web.create-post', compact('categories'));
    }

    /**
     * Store a new post
     */
    public function storePost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'published_at' => 'nullable|date|after:now',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        // Regular users create posts as drafts, only admins/editors can publish directly
        $canPublish = Auth::user()->canPublishPosts();
        $isPublished = $canPublish && ($request->has('publish_now') || !empty($validated['published_at']));

        $post = Auth::user()->posts()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? null,
            'slug' => Str::slug($validated['title']),
            'published_at' => $isPublished ? ($validated['published_at'] ?? now()) : null,
            'is_published' => $isPublished,
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $post->update(['featured_image' => $path]);
        }

        if ($request->categories) {
            $post->categories()->attach($request->categories);
        }

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    /**
     * Show edit post form
     */
    public function editPost(int $id): View
    {
        $post = Auth::user()->posts()->findOrFail($id);
        $categories = Category::all();

        return view('web.edit-post', compact('post', 'categories'));
    }

    /**
     * Update a post
     */
    public function updatePost(Request $request, int $id): RedirectResponse
    {
        $post = Auth::user()->posts()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $canPublish = Auth::user()->canPublishPosts();
        $isPublished = $canPublish && ($request->has('publish_now') || !empty($validated['published_at']) || ($post->published_at && !$request->has('save_draft')));

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? null,
            'published_at' => $isPublished ? ($validated['published_at'] ?? ($request->has('publish_now') ? now() : $post->published_at)) : null,
            'is_published' => $isPublished,
        ]);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $path = $request->file('featured_image')->store('posts', 'public');
            $post->update(['featured_image' => $path]);
        }

        if ($request->categories) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    /**
     * Delete a post
     */
    public function deletePost(int $id): RedirectResponse
    {
        $post = Auth::user()->posts()->findOrFail($id);

        // Delete featured image if exists
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }

    /**
     * Store a new comment
     */
    public function storeComment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Check if user can comment (optional: check if user owns the post or has permission)
        $post = \App\Models\Post::findOrFail($validated['post_id']);

        $comment = Auth::user()->comments()->create([
            'post_id' => $validated['post_id'],
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}