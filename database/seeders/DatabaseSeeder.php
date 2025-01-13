<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Users
        User::factory()->count(10)->create()->each(function ($user) {
            // Seed Posts with Comments and Tags for each user
            Post::factory()->count(10)
                ->hasComments(3)
                ->hasTags(1)  // Ensure at least one tag is associated with each post
                ->for($user)
                ->create();
        });
    }
}
