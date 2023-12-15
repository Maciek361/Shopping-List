<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShoppingList;

class ShoppingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            ShoppingList::create([
                'user_id' => $user->id,
                'name' => 'Lista zakupów dla ' . $user->name,
                // Dodaj inne pola według potrzeb
            ]);
        }
    }
}
