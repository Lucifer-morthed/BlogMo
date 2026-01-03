<?php

namespace Tests\Feature\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_published_posts()
    {
        Post::factory()->count(5)->published()->create();

        $response = $this->getJson('/api/v1/posts');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'slug',
                            'content',
                            'excerpt',
                            'published_at',
                            'user',
                            'categories'
                        ]
                    ],
                    'links',
                    'meta'
                ]);
    }

    public function test_can_show_single_post()
    {
        $post = Post::factory()->published()->create();

        $response = $this->getJson("/api/v1/posts/{$post->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'id' => $post->id,
                    'title' => $post->title,
                ]);
    }

    public function test_can_search_posts()
    {
        Post::factory()->published()->create(['title' => 'Laravel Tutorial']);
        Post::factory()->published()->create(['title' => 'Vue Guide']);

        $response = $this->getJson('/api/v1/posts/search/Laravel');

        $response->assertStatus(200)
                ->assertJsonCount(1, 'data');
    }

    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $postData = [
            'title' => 'New Post',
            'content' => 'Post content',
            'is_published' => true,
        ];

        $response = $this->postJson('/api/v1/posts', $postData);

        $response->assertStatus(201)
                ->assertJson([
                    'title' => 'New Post',
                    'user_id' => $user->id,
                ]);

        $this->assertDatabaseHas('posts', $postData);
    }

    public function test_unauthenticated_user_cannot_create_post()
    {
        $postData = [
            'title' => 'New Post',
            'content' => 'Post content',
        ];

        $response = $this->postJson('/api/v1/posts', $postData);

        $response->assertStatus(401);
    }

    public function test_user_can_update_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        Sanctum::actingAs($user);

        $updateData = [
            'title' => 'Updated Title',
            'content' => 'Updated content',
        ];

        $response = $this->putJson("/api/v1/posts/{$post->id}", $updateData);

        $response->assertStatus(200)
                ->assertJson(['title' => 'Updated Title']);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_user_cannot_update_others_post()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $otherUser->id]);
        Sanctum::actingAs($user);

        $response = $this->putJson("/api/v1/posts/{$post->id}", [
            'title' => 'Updated Title',
        ]);

        $response->assertStatus(403);
    }

    public function test_user_can_delete_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        Sanctum::actingAs($user);

        $response = $this->deleteJson("/api/v1/posts/{$post->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_validation_works_for_post_creation()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/v1/posts', [
            'title' => '', // Invalid: empty title
            'content' => 'Valid content',
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['title']);
    }
}