<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            'parent_id' => null, //We’ll set it later if we want hierarchy
            'code' => strtoupper(Str::random(4)),
            'name' => ucfirst($name),
            'description' => $this->faker->sentence(),
        ];
    }
}
