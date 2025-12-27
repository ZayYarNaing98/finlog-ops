<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Expense categories
            ['name' => 'Office Supplies', 'description' => 'Stationery, printer ink, office equipment', 'type' => 'expense'],
            ['name' => 'Travel', 'description' => 'Business trips, transportation, accommodation', 'type' => 'expense'],
            ['name' => 'Meals & Entertainment', 'description' => 'Client meals, team lunches, business entertainment', 'type' => 'expense'],
            ['name' => 'Software & Subscriptions', 'description' => 'SaaS tools, licenses, cloud services', 'type' => 'expense'],
            ['name' => 'Hardware', 'description' => 'Computers, peripherals, equipment', 'type' => 'expense'],
            ['name' => 'Marketing', 'description' => 'Advertising, promotions, marketing materials', 'type' => 'expense'],
            ['name' => 'Professional Services', 'description' => 'Consulting, legal, accounting fees', 'type' => 'expense'],
            ['name' => 'Utilities', 'description' => 'Electricity, internet, phone bills', 'type' => 'expense'],
            ['name' => 'Rent', 'description' => 'Office rent and lease payments', 'type' => 'expense'],
            ['name' => 'Miscellaneous', 'description' => 'Other uncategorized expenses', 'type' => 'expense'],

            // Income categories
            ['name' => 'Sales Revenue', 'description' => 'Income from product or service sales', 'type' => 'income'],
            ['name' => 'Consulting Income', 'description' => 'Revenue from consulting services', 'type' => 'income'],
            ['name' => 'Investment Income', 'description' => 'Returns from investments', 'type' => 'income'],
            ['name' => 'Other Income', 'description' => 'Miscellaneous income sources', 'type' => 'income'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
