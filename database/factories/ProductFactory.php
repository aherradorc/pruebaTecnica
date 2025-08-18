<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word(2, true);
        return [
            'code' => strtoupper(Str::random(6)),
            'name' => ucfirst($name),
            'description' => $this->faker->paragraph(),
            'photo' => 'https://picsum.photos/seed/' . uniqid() . '/150/150',
        ];
    }
}
