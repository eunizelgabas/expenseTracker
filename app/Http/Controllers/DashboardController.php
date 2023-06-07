<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Expenses;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $userId = Auth::id();
        // $budget = Budget::where('user_id', $userId)->first();
        // $categories = Category::where('user_id', $userId)->get();
        // $expenses = Expenses::where('user_id', $userId)->get();

        $totalExpenses = Expenses::where('user_id', Auth::user()->id)->sum('amount');
        $totalBudget = Budget::where('user_id', Auth::user()->id)->sum('amount');
        $balance = $totalBudget - $totalExpenses;
        $recentBudgets = Budget::where('user_id', Auth::user()->id)->latest()->take(5)->get();
        $recentExpenses = Expenses::where('user_id', Auth::user()->id)->latest()->take(5)->get();

        return inertia('dashboard', [
            'totalExpenses' => $totalExpenses,
            'totalBudget' => $totalBudget,
            'balance' => $balance,
            'recentBudgets' => $recentBudgets,
            'recentExpenses' => $recentExpenses,
        ]);
    }
}
