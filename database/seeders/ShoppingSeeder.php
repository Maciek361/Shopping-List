<?php

namespace Database\Seeders;

use App\Models\Shopping;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShoppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach (range(1, 50) as $index) {
            Shopping::create([
                'name' => 'Lista_ ' . $index,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
