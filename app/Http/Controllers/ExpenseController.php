<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
//        $expenses = Expense::query()->where('user_id', '=', Auth::user()->id)->paginate();
        $expenses = Auth::user()->expenses()->with('category')->paginate();
        $income = Auth::user()->incomes()
            ->where('month', now()->format('Y-m'))
            ->first();
        $totalExpenses = Auth::user()->expenses()->where('month', now()->format('Y-m'))->sum('amount');

        return view('expenses.list', compact('expenses', 'income', 'totalExpenses'));
    }

    public function show()
    {
//        $expense = Expense::where('user_id', Auth::id())
//            ->where('month', now()->format('Y-m'))
//            ->first();
        $expense = Auth::user()
            ->expenses()
            ->where('month', now()->format('Y-m'))
            ->first();

        return view('expenses.show', compact('expense'));
    }

    public function create()
    {
        $categories = auth()->user()
            ->categories()
            ->get();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1',],
            'category_id' => 'required|exists:categories,id',
            'note' => ['nullable'],
        ]);

        $category = Category::where('id', '=', $request->category_id)
            ->where('user_id', '=', Auth()->id())
            ->first();

        if (!$category) {
            return redirect()->back()
                ->withErrors(['category_id' => 'The selected category isn\'t available for you'])
                ->withInput();
        }
        $month = now()->format('Y-m');

        $income = Auth::user()->incomes()
            ->where('month', $month)
            ->sum('income');

        $currentExpenses = Auth::user()->expenses()
            ->where('month', $month)
            ->sum('amount');

        if (($currentExpenses + $request->amount) > $income) {
            return redirect()->back()
                ->withErrors(['amount' => 'You have exceeded your income limit for this month.'])
                ->withInput();
        }
        $expense = Expense::query()->create([
            'amount' => $request->input('amount'),
                'category_id' => $request->input('category_id'),
            'user_id' => Auth::id(),
            'month' => now()->format('Y-m'),
            'note' => $request->input('note')
        ]);

        return redirect()->route('expenses.index')->with('message', 'Expense added!');
    }

    public function edit(Expense $expense)
    {
        $categories = auth()->user()
            ->categories()
            ->get();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'note' => ['nullable'],
            'category_id' => 'required|exists:categories,id',
        ]);

        $category = Category::where('id', $request->category_id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$category) {
            return redirect()->back()
                ->withErrors(['category_id' => 'The selected category isn\'t available for you'])
                ->withInput();
        }

        if ($expense->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        $month = now()->format('Y-m');

        $income = Auth::user()->incomes()
            ->where('month', $month)
            ->sum('income');

        $currentExpenses = Auth::user()->expenses()
            ->where('month', $month)
            ->where('id', '!=', $expense->id)
            ->sum('amount');

        if (($currentExpenses + $request->amount) > $income) {
            return redirect()->back()
                ->withErrors(['amount' => 'You have exceeded your income limit for this month.'])
                ->withInput();
        }
        $expense->update([
            'amount' => $request->input('amount'),
            'category_id' => $request->input('category_id'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('expenses.index')->with('message', 'Expense updated!');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== Auth::id()) {
            abort(403);
        }

        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'ُExpense deleted successfully.');

    }
}
