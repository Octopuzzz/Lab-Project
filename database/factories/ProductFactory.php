<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(2),
            'description' => $this->faker->paragraph(mt_rand(5, 10)),
            'image' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
            'year' => $this->faker->numberBetween(2018, 2023),
            'UserID' => $this->faker->unique()->numberBetween(1, 50),
        ];
    }
}
