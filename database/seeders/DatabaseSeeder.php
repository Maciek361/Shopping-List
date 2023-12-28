<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shopping;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->hasAttached(Shopping::factory()->count(3))->create();

        $this->call([
            CategorySeeder::class,
            ProductsSeeder::class,
            //ShoppingSeeder::class,
        ]);
    }
}
