<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = ['anime', 'drakor', 'hollywood'];
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'body' => fake()->paragraph(),
            'room_id' => Room::inRandomOrder()->value('id')
        ];
    }
}
