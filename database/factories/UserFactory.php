<?php

namespace RefBytes\Outseta\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use RefBytes\Outseta\Tests\TestSupport\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => bcrypt($this->faker->sentence),
        ];
    }
}
