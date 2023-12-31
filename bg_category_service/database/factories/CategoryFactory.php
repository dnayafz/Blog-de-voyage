<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $title = $this->faker->unique()->words(3, true); // Generating a unique title
        return [
            'title' => $title,
            'slug' => Str::slug($title), // Generating a slug based on the title
        ];
    }
}