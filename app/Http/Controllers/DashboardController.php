<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FinancialLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $query = FinancialLog::query();

        // Apply date filters
        if ($request->filled('start_date')) {
            $query->where('transaction_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('transaction_date', '<=', $request->end_date);
        }

        // Apply category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Apply type filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Calculate totals
        $totalExpense = (clone $query)->where('type', 'expense')->sum('amount');
        $totalIncome = (clone $query)->where('type', 'income')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        // Get recent transactions
        $transactions = $query->with('category')
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Get categories for filter dropdown
        $categories = Category::where('is_active', true)->get();

        return view('dashboard', compact(
            'totalExpense',
            'totalIncome',
            'balance',
            'transactions',
            'categories'
        ));
    }
}
