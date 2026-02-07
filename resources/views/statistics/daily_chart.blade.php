@extends('layouts.app')

@section('page_title', 'Daily Expense Chart')

@section('main_content')
    <div class="container mt-5">
        <h3 class="mb-4">📊 Daily Expenses for {{ now()->format('F Y') }}</h3>

        <canvas id="expenseChart" height="100"></canvas>
    </div>
@endsection
@section('JS_content')
    <script>
        const ctx = document.getElementById('expenseChart').getContext('2d');
        const expenseChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Expenses (₪)',
                    data: {!! json_encode($chartData['data']) !!},
                    backgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                }
            }
        });
    </script>
@endsection

