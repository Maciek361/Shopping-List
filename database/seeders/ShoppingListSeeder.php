<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShoppingList;
use App\Models\Product;


class ShoppingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       $shoppingList = ShoppingList::create([
        'name' => 'Moja Lista Zakupów',
        'created_by' => 1, 
        'updated_by' => 1,
    ]);

 
    $product1 = Product::find(1);
    $product2 = Product::find(2);

    $shoppingList->products()->attach($product1, ['user_id' => 1, 'quantity' => 2]);
    $shoppingList->products()->attach($product2, ['user_id' => 1, 'quantity' => 1]);
    }
}
