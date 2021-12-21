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
            'sku' => $this->faker->swiftBicNumber(),
            'name' => $this->faker->company(),
            'quantity' => $this->faker->randomDigitNotZero(),
            'price' => $this->faker->randomFloat(2, 0.01,1000.99)
        ];
    }
}
