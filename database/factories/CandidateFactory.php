<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sources = ['Fotocasa', 'Habitaclia', 'Otra'];
        $users = User::where('is_active', 1)->pluck('id');

        return [
            'name' => fake()->firstName()." ".fake()->lastName(),
            'source' => fake()->randomElement($sources),
            'owner' => fake()->randomElement($users),
            'created_by' => fake()->randomElement($users),
        ];
    }
}
