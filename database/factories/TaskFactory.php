<?php

namespace Database\Factories;

use App\Models\Todolist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'todolist_id' => Todolist::factory(),
            'user_id' => User::factory(),
            'complete' => $this->faker->boolean(),
            'published_at' => $this->faker->date()
        ];
    }
}
