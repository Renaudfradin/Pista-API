<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Todolist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
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
            'task_id' => Task::factory(),
        ];
    }
}
