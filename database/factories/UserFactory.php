<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
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
            'phone' => $this->faker->numberBetween(21000000, 22999999),
            'username' => $this->faker->userName(),
            'birthday' => $this->faker->date('Y-m-d'),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt("fer12345")
        ];
    }
}
