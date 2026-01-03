<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Posts about latest technology trends and innovations',
            ],
            [
                'name' => 'Web Development',
                'description' => 'Tutorials and insights about web development',
            ],
            [
                'name' => 'Mobile Development',
                'description' => 'Mobile app development news and tutorials',
            ],
            [
                'name' => 'DevOps',
                'description' => 'DevOps practices, tools, and best practices',
            ],
            [
                'name' => 'Programming',
                'description' => 'General programming topics and languages',
            ],
            [
                'name' => 'Career Advice',
                'description' => 'Career development and job market insights',
            ],
        ];

        foreach ($categories as $category) {
            $category['slug'] = \Illuminate\Support\Str::slug($category['name']);
            Category::create($category);
        }
    }
}
