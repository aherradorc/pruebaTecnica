<?php

namespace Database\Factories;

use App\Models\Reminder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reminder>
 */
class ReminderFactory extends Factory
{
    protected $model = Reminder::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => null, //Assigned later
            'date' => $this->faker->dateTimeBetween('now', '+2 months'),
            'units' => $this->faker->numberBetween(1, 10),
        ];
    }
}
