<?php

namespace Database\Seeders;

use App\Models\ShippingRule;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            [
                'name' => 'Free Shipping Over EGP 1000',
                'min_order_amount' => 1000.00,
                'shipping_cost' => 0.00,
                'is_free' => true,
                'is_active' => true,
                'priority' => 10,
            ],
            [
                'name' => 'Standard Shipping',
                'min_order_amount' => null,
                'shipping_cost' => 90,
                'is_free' => false,
                'is_active' => true,
                'priority' => 1,
            ],
            [
                'name' => 'Free Shipping Over $100',
                'min_order_amount' => 100.00,
                'shipping_cost' => 0.00,
                'is_free' => true,
                'is_active' => true,
                'priority' => 20,
            ],
        ];

        foreach ($rules as $rule) {
            ShippingRule::create($rule);
        }

        $this->command->info('Shipping rules seeded successfully!');
    }
}
