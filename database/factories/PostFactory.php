<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // 1から10のランダムなユーザーID
            'title' => $this->faker->sentence, // ランダムなタイトル
            'body' => $this->faker->paragraph, // ランダムな本文
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
