<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CitiesSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\GovernoratesSeeder;
use Database\Seeders\ShippingRuleSeeder;
use Database\Seeders\DivisionCategorySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // CategorySeeder::class,
            // ProductSeeder::class,
            // ShippingRuleSeeder::class
            GovernoratesSeeder::class,
            CitiesSeeder::class
        ]);

        // User::factory()->create([
        //     'first_name' => 'Test',
        //     'last_name'=>'user',
        //     'email' => 'test@example.com',
        // ]);
    }
}
