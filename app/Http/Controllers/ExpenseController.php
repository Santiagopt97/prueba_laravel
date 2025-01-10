<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with('category');

        // Filtro por categoría
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filtro por rango de fechas
        if ($request->has('start_date') && $request->start_date != '') {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date != '') {
            $query->where('date', '<=', $request->end_date);
        }

        $expenses = $query->orderBy('date', 'desc')->get();
        $categories = Category::all();
        $totalExpenses = $expenses->sum('amount');
        $expensesByCategory = $expenses->groupBy('category.name')
            ->map(fn($items) => $items->sum('amount'));

        return view('expenses.index', compact('expenses', 'categories', 'totalExpenses', 'expensesByCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id'
        ]);

        Expense::create($request->all());
        return redirect()->route('expenses.index');
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id'
        ]);

        $expense->update($request->all());
        return redirect()->route('expenses.index');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index');
    }
}