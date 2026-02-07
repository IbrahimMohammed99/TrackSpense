<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    // public function index()
    // {

    //     $incomes = Auth::user()->incomes()->paginate(10);
    //     return view('incomes.list', compact('incomes'));
    // }

public function index()
{
    /** @var User $user */
    $user = auth()->user();

    $incomes = $user->incomes()->paginate(10);

    return view('incomes.list', compact('incomes'));
}


    public function show()
    {
        $income = Income::where('user_id', Auth::id())
            ->where('month', now()->format('Y-m'))
            ->first();

        return view('incomes.show', compact('income'));
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function store(Request $request)
    {
        $currentMonth = now()->format('Y-m');

        $existingIncome = Income::where('user_id', Auth::id())
            ->where('month', $currentMonth)
            ->first();

        if ($existingIncome) {
            return back()->with('error', 'You have already added your income for this month.');
        }

        $request->validate([
            'income' => 'required|numeric|min:0',
            'currency' => 'required|in:USD,ILS',
        ]);

        Income::create([
            'income'   => $request->income,
            'currency' => $request->currency,
            'user_id'  => Auth::id(),
            'month'    => $currentMonth,
        ]);

        return redirect()->route('incomes.show')
            ->with('message', 'Income added successfully!');
    }

    // public function showExpensesForMonth(Income $income)
    // {
    //      /** @var \App\Models\User $user */
    //     $expenses = Auth::user()


    //         ->expenses()

    //         ->where('month', $income->month)
    //         ->with('category')
    //         ->get();

    //     $totalExpenses = $expenses->sum('amount');

    //     return view('incomes.expenses', compact(
    //         'income',
    //         'expenses',
    //         'totalExpenses'
    //     ));
    // }
public function showExpensesForMonth(Income $income)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $expenses = $user->expenses()
        ->where('month', $income->month)
        ->with('category')
        ->get();

    $totalExpenses = $expenses->sum('amount');

    return view('incomes.expenses', compact(
        'income',
        'expenses',
        'totalExpenses'
    ));
}

    public function edit(Income $income)
    {
        if ($income->user_id !== Auth::id()) {
            abort(403);
        }

        return view('incomes.edit', compact('income'));
    }

    public function update(Request $request, Income $income)
    {
        if ($income->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'income' => 'required|numeric|min:0',
            'currency' => 'required|in:USD,ILS',
        ]);

        $income->update([
            'income'   => $request->income,
            'currency' => $request->currency,
        ]);

        return redirect()->route('incomes.show')
            ->with('message', 'Income updated successfully!');
    }
}
