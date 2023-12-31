<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition()
    {
        return [
            'image' => 'media/' . $this->faker->image('public/storage/media', 640, 480, null, false),
            'id_post' => $this->faker->numberBetween(1, 100) // Assuming you have an 'id_post' field
        ];
    }
}