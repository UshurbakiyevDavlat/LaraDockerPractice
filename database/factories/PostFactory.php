<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::get()->random()->id,
            'title' => $this->faker->word,
            'content' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
            'category_id' => Category::get()->random()->id
        ];
    }
}
