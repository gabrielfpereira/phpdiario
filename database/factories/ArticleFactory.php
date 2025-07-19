<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'author_id' => \App\Models\User::factory(),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'slug' => $this->faker->slug(),
            'category_id' => \App\Models\Category::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'nature', true),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}
