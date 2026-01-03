<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    /**
     * Get admin statistics.
     */
    public function stats(): JsonResponse
    {
        return response()->json([
            'total_posts' => Post::count(),
            'published_posts' => Post::published()->count(),
            'draft_posts' => Post::where('is_published', false)->count(),
            'total_comments' => Comment::count(),
            'approved_comments' => Comment::approved()->count(),
            'pending_comments' => Comment::where('is_approved', false)->count(),
            'total_users' => User::count(),
            'total_categories' => \App\Models\Category::count(),
        ]);
    }

    /**
     * Publish a post.
     */
    public function publishPost(Post $post): JsonResponse
    {
        $post->update([
            'is_published' => true,
            'published_at' => $post->published_at ?? now(),
        ]);

        return response()->json([
            'message' => 'Post published successfully',
            'post' => $post
        ]);
    }

    /**
     * Unpublish a post.
     */
    public function unpublishPost(Post $post): JsonResponse
    {
        $post->update([
            'is_published' => false,
            'published_at' => null,
        ]);

        return response()->json([
            'message' => 'Post unpublished successfully',
            'post' => $post
        ]);
    }

    /**
     * Approve a comment.
     */
    public function approveComment(Comment $comment): JsonResponse
    {
        $comment->update(['is_approved' => true]);

        return response()->json([
            'message' => 'Comment approved successfully',
            'comment' => $comment->load('user')
        ]);
    }

    /**
     * Delete a comment (admin override).
     */
    public function deleteComment(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
