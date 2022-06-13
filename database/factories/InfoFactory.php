<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'status' => random_int(0,1),
            'user_id' => User::get()->random()->id
        ];
    }
}
