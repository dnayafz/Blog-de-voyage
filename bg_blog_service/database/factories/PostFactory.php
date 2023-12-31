<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'id_user' => 1, // Assuming you have a User model and its factory
            'id_category' => $this->faker->numberBetween(1, 10), // Adjust as needed
            'status' => $this->faker->randomElement([1, 0]), // Adjust as needed
        ];
    }
}