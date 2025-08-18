<?php

namespace Database\Factories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    protected $model = Rate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 year', '+1 month');
        $end = (clone $start)->modify('+2 months');
        return [
            'product_id' => null, //We'll assign it in the seeder
            'start_date' => $start,
            'end_date' => $end,
            'price' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
