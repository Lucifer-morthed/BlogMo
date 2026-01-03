<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware is handled at the route level
    }

    /**
     * Show admin control panel
     */
    public function index(): View
    {
        // Get all posts for moderation (paginated)
        $pendingPosts = Post::where('is_published', false)
            ->with(['user', 'categories'])
            ->latest()
            ->paginate(10, ['*'], 'pending_page');

        $publishedPosts = Post::where('is_published', true)
            ->with(['user', 'categories'])
            ->latest('published_at')
            ->paginate(10, ['*'], 'published_page');

        $categories = Category::withCount('posts')->get();
        $users = User::with('roles')->latest()->take(10)->get();

        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::where('is_published', true)->count(),
            'pending_posts' => Post::where('is_published', false)->count(),
            'total_users' => User::count(),
            'total_categories' => Category::count(),
        ];

        return view('web.admin.index', compact(
            'pendingPosts',
            'publishedPosts',
            'categories',
            'users',
            'stats'
        ));
    }

    /**
     * Approve and publish a post
     */
    public function approvePost(int $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        $post->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Post approved and published successfully!');
    }

    /**
     * Reject a post (delete it)
     */
    public function rejectPost(int $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        // Only allow rejection of unpublished posts
        if ($post->is_published) {
            return redirect()->back()->with('error', 'Cannot reject a published post.');
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post rejected and deleted.');
    }

    /**
     * Create new category
     */
    public function storeCategory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => \Illuminate\Support\Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    /**
     * Update category
     */
    public function updateCategory(Request $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:500',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => \Illuminate\Support\Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    /**
     * Delete category
     */
    public function deleteCategory(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        // Check if category has posts
        if ($category->posts()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category with existing posts.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, int $userId): RedirectResponse
    {
        $user = User::findOrFail($userId);
        $role = $request->input('role');

        $validRoles = ['author', 'editor', 'admin'];

        if (!in_array($role, $validRoles)) {
            return redirect()->back()->with('error', 'Invalid role specified.');
        }

        // Remove all existing roles and assign new one
        $user->syncRoles([$role]);

        return redirect()->back()->with('success', "User role updated to {$role}.");
    }
}