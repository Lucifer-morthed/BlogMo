<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Post $post): JsonResponse
    {
        $comments = $post->comments()
            ->with(['user', 'replies.user'])
            ->approved()
            ->topLevel()
            ->latest()
            ->paginate(10);

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Check if parent comment belongs to the same post
        if ($validated['parent_id']) {
            $parent = Comment::find($validated['parent_id']);
            if ($parent->post_id != $validated['post_id']) {
                return response()->json(['message' => 'Invalid parent comment'], 422);
            }
        }

        $validated['user_id'] = $request->user()->id;

        $comment = Comment::create($validated);

        return response()->json($comment->load(['user', 'replies']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): JsonResponse
    {
        return response()->json($comment->load(['user', 'post', 'replies.user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment): JsonResponse
    {
        // Check ownership
        if ($comment->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return response()->json($comment->load(['user']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): JsonResponse
    {
        // Check ownership or admin
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }

    /**
     * Get replies for a comment.
     */
    public function replies(Comment $comment): JsonResponse
    {
        $replies = $comment->replies()
            ->with('user')
            ->approved()
            ->latest()
            ->paginate(10);

        return response()->json($replies);
    }
}
