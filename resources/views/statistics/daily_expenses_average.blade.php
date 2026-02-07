@extends('layouts.app')
@section('page_title')
    Daily Expense Report
@endsection
@section('title', 'Daily Expense Report')

@section('main_content')
    <div class="container-fluid" dir="ltr">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2>📊 Daily Expense Report - {{ now()->format('F Y') }}</h2>
            </div>
        </div>

        <div class="row mb-4 justify-content-center">
            <div class="col-md-4">
                <div class="small-box bg-info">
                    <div class="inner text-center">
                        <h3>{{ number_format($average, 2) }} $</h3>
                        <p>Average Daily Expense</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Expenses Per Day</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Expense ($)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($dailyTotals as $date => $amount)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</td>
                            <td>{{ number_format($amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No expenses found this month.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
