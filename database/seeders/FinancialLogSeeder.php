<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FinancialLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class FinancialLogSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            return;
        }

        $expenseCategories = Category::where('type', 'expense')->pluck('id')->toArray();
        $incomeCategories = Category::where('type', 'income')->pluck('id')->toArray();

        $transactions = [
            // Expenses
            ['category_id' => $expenseCategories[0] ?? 1, 'amount' => 150.00, 'description' => 'Printer ink and paper', 'type' => 'expense', 'days_ago' => 1],
            ['category_id' => $expenseCategories[1] ?? 2, 'amount' => 450.00, 'description' => 'Business trip to Singapore', 'type' => 'expense', 'days_ago' => 3],
            ['category_id' => $expenseCategories[2] ?? 3, 'amount' => 85.50, 'description' => 'Client lunch meeting', 'type' => 'expense', 'days_ago' => 5],
            ['category_id' => $expenseCategories[3] ?? 4, 'amount' => 299.00, 'description' => 'Annual software subscription', 'type' => 'expense', 'days_ago' => 7],
            ['category_id' => $expenseCategories[4] ?? 5, 'amount' => 1200.00, 'description' => 'New laptop for development', 'type' => 'expense', 'days_ago' => 10],
            ['category_id' => $expenseCategories[5] ?? 6, 'amount' => 500.00, 'description' => 'Facebook ads campaign', 'type' => 'expense', 'days_ago' => 12],
            ['category_id' => $expenseCategories[6] ?? 7, 'amount' => 750.00, 'description' => 'Legal consultation', 'type' => 'expense', 'days_ago' => 15],
            ['category_id' => $expenseCategories[7] ?? 8, 'amount' => 180.00, 'description' => 'Monthly internet bill', 'type' => 'expense', 'days_ago' => 20],
            ['category_id' => $expenseCategories[8] ?? 9, 'amount' => 2500.00, 'description' => 'Office rent December', 'type' => 'expense', 'days_ago' => 25],
            ['category_id' => $expenseCategories[9] ?? 10, 'amount' => 75.00, 'description' => 'Team coffee supplies', 'type' => 'expense', 'days_ago' => 2],

            // Incomes
            ['category_id' => $incomeCategories[0] ?? 11, 'amount' => 5000.00, 'description' => 'Project Alpha payment', 'type' => 'income', 'days_ago' => 2],
            ['category_id' => $incomeCategories[0] ?? 11, 'amount' => 3500.00, 'description' => 'Monthly retainer - Client XYZ', 'type' => 'income', 'days_ago' => 8],
            ['category_id' => $incomeCategories[1] ?? 12, 'amount' => 1500.00, 'description' => 'Consulting session', 'type' => 'income', 'days_ago' => 14],
            ['category_id' => $incomeCategories[2] ?? 13, 'amount' => 250.00, 'description' => 'Investment dividends', 'type' => 'income', 'days_ago' => 18],
            ['category_id' => $incomeCategories[3] ?? 14, 'amount' => 800.00, 'description' => 'Referral bonus', 'type' => 'income', 'days_ago' => 22],
        ];

        foreach ($transactions as $transaction) {
            FinancialLog::create([
                'user_id' => $user->id,
                'category_id' => $transaction['category_id'],
                'amount' => $transaction['amount'],
                'description' => $transaction['description'],
                'type' => $transaction['type'],
                'transaction_date' => now()->subDays($transaction['days_ago']),
            ]);
        }
    }
}
