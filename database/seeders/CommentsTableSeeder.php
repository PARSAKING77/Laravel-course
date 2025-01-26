<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    public function run(): void
    {
        Post::all()->each(function ($post) {
            $post->comments()->createMany(
                Comment::factory()->count(3)->make()->toArray()
            );
        });
    }
}