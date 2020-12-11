<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'discord_id' => $this->faker->unique()->numberBetween(100, 99999),
            'username' => $this->faker->userName,
            'discriminator' => $this->faker->randomDigit,
            'master_key_id' => $this->faker->unique()->numberBetween(1, 1000),
            'status' => 'active'
        ];
    }
}