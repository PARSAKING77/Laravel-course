<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title' => fake()->unique()->sentence(),
        'description' => fake()->text(150),
        'content' => fake()->paragraphs(3, true),
        'slug' => fake()->unique()->slug(),
        'published_at' => now()->subDays(rand(1, 365)),
        'status' => fake()->randomElement(['draft', 'published', 'archived']),
    ];
}



    /**
     * Ensure unique tag relationships after post creation.
     */
    public function configure()
{
    return $this->afterCreating(function (Post $post) {
        $tags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id')->unique()->toArray();
        
        $existingTags = $post->tags()->pluck('tag_id')->toArray();
        $newTags = array_diff($tags, $existingTags);

        if (!empty($newTags)) {
            $post->tags()->sync($newTags);
        }
    });
}

}