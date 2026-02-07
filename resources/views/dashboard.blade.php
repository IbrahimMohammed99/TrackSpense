@extends('layouts.app')
@section('page_title', 'Dashboard')
@section('page_heading', 'Welcome, ' . Auth::user()->name)

@section('main_content')
    <div class="container mt-4" dir="ltr">
        {{-- Summary Cards --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-success shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-success">💰 Monthly Income</h6>
                        <h4>{{ number_format($income, 2) }} $</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-danger shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-danger">💸 Total Expenses</h6>
                        <h4>{{ number_format($expenses, 2) }} $</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-primary">✅ Remaining</h6>
                        <h4>{{ number_format($income - $expenses, 2) }} $</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-warning">📊 Spent %</h6>
                        <h4>{{ $income > 0 ? round($expenses / $income * 100) : 0 }}%</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pie Chart --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">Expenses by Category</div>
                    <div style="max-width: 400px; margin: auto;">
                        <canvas id="expensesPie"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Expenses --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">Recent Expenses</div>
                    <div class="card-body p-0">
                        <table class="table table-hover text-center mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Note</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($recentExpenses as $expense)
                                <tr>
                                    <td>{{ number_format($expense->amount, 2) }} $</td>
                                    <td>{{ $expense->category->name ?? '—' }}</td>
                                    <td>{{ $expense->note ?? '-' }}</td>
                                    <td>{{ $expense->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">No recent expenses found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('expenses.create') }}" class="btn btn-primary">➕ Add Expense</a>
                <a href="{{ route('incomes.create') }}" class="btn btn-success">➕ Add Income</a>
{{--                <a href="{{ route('reports.index') }}" class="btn btn-secondary">📂 Monthly Report</a>--}}
            </div>
        </div>
    </div>
@endsection

@section('JS_content')
    <script>
        const ctx = document.getElementById('expensesPie').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: [
                        '#f87171', '#facc15', '#34d399', '#60a5fa', '#a78bfa', '#f472b6'
                    ]
                }]
            }
        });
    </script>
@endsection
