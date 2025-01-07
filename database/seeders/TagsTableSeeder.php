<?php

namespace Database\Seeders;

use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // Predefined tags
        $tags = ['Technology', 'Laravel', 'PHP'];

        // Add predefined tags
        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }

        // Generate 10 more unique tags
        for ($i = 0; $i < 10; $i++) {
            Tag::create([
                'name' => $faker->unique()->word,
            ]);
        }

        // Reset unique state after seeding
        $faker->unique(true);
    }
}
