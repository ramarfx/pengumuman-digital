<?php

namespace Database\Factories;

use App\Models\Post;
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
            Post::create([
                'user_id'        => mt_rand(1,5),
                'title'          => fake()->words(5, true),
                'description'    => fake()->paragraph(10, true),
                'category'       => 'pengumuman',
                'priority_level' => 'biasa'
            ])
        ];
    }
}
