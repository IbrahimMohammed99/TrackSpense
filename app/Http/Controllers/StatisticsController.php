<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function dailyAverage()
    {
        $user = Auth::user();
        $month = now()->format('Y-m');


        $expenses = $user->expenses()
            ->where('month', $month)
            ->get();

        $total = $expenses->sum('amount');
        $daysInMonth = now()->daysInMonth;
        $average = $daysInMonth > 0 ? $total / $daysInMonth : 0;


        $dailyTotals = $expenses->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('Y-m-d');
        })->map(function ($dayItems) {
            return $dayItems->sum('amount');
        });

        return view('statistics.daily_expenses_average', compact('average', 'dailyTotals'));
    }

    public function categoryTotals()
    {
        $user = Auth::user();
        $month = now()->format('Y-m');

        $data = Category::where('user_id', Auth::id())->with(['expenses' => function ($query) use ($month, $user) {
            $query->where('month', $month);
        }])->get()->map(function ($category) {
            return [
                'category' => $category->name,
                'total' => $category->expenses->sum('amount')
            ];
        });
        return view('statistics.category_totals', compact('data'));

    }

    public function dailyChart()
    {
        $expenses = Expense::selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->where('user_id', Auth::id())
            ->where('month', now()->format('Y-m'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartData = [
            'labels' => $expenses->pluck('date'),
            'data' => $expenses->pluck('total'),
        ];
//        dd($chartData);

        return view('statistics.daily_chart', compact('chartData'));
    }
}
