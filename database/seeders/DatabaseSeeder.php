<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Reminder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create main categories
        $parentCategories = Category::factory(5)->create();

        // 2. Create subcategories for each main category
        foreach ($parentCategories as $parent) {
            Category::factory(2)->create([
                'parent_id' => $parent->id
            ]);
        }

        // Get all categories (parents and children)
        $allCategories = Category::all();

        // 3. Create products
        $products = Product::factory(10)->create();

        foreach ($products as $product) {
            // 4. Assign between 1 and 3 random categories to the product
            $product->categories()->attach(
                $allCategories->random(rand(1, 3))->pluck('id')
            );

            // 5. Create between 1 and 3 rates per product
            for ($i = 0; $i < rand(1, 3); $i++) {
                $startDate = now()->subMonths(rand(1, 6))->addDays(rand(1, 15));
                $endDate = (clone $startDate)->addMonths(rand(1, 2));
                Rate::create([
                    'product_id' => $product->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'price' => rand(300, 1000) / 100,
                ]);
            }

            // 6. Create a reminder for this product
            Reminder::create([
                'product_id' => $product->id,
                'date' => now()->addDays(rand(1, 30)),
                'units' => rand(1, 5),
            ]);
        }
    }
}
