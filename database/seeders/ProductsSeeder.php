<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        foreach (range(1, 50) as $index) {
            Product::create([
                'name' => 'Produkt ' . $index,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
