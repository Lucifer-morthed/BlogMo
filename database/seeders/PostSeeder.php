<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users to assign posts to
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory()->count(3)->create();
        }

        // Create published posts
        Post::factory()->count(10)->published()->create([
            'user_id' => $users->random()->id,
        ])->each(function ($post) {
            // Attach random categories
            $categories = \App\Models\Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $post->categories()->sync($categories);
        });

        // Create draft posts
        Post::factory()->count(5)->draft()->create([
            'user_id' => $users->random()->id,
        ])->each(function ($post) {
            // Attach random categories
            $categories = \App\Models\Category::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $post->categories()->sync($categories);
        });
    }
}
