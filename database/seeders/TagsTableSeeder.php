<?php

namespace Database\Seeders;

use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $tags = [
            'Technology',
            'Laravel',
            'PHP',
        ];

        // Create predefined tags
        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
            ]);
        }

        // Generate 10 more tags randomly
        for ($i = 0; $i < 10; $i++) {
            Tag::create([
                'name' => $faker->word,
            ]);
        }
    }
}
