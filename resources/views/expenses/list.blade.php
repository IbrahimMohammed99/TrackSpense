@extends('layouts.app')
@section('page_title')
    Expenses Summary
@endsection

@section('page_heading')
    Expenses For {{now()->format('Y-m')}}
@endsection



@section('main_content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-5" dir="ltr">
        <h2 class="mb-4 text-center">💼 {{ now()->format('F Y') }} Summary</h2>

        <div class="row">
            <!-- Monthly Income -->
            <div class="col-md-4 mb-3">
                <div class="card border-success shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title text-success">💰 Monthly Income</h5>
                        <h3 class="card-text">{{ number_format($income->income ?? 0, 2) }} $</h3>
                    </div>
                </div>
            </div>
            <!-- Total Expenses -->
            <div class="col-md-4 mb-3">
                <div class="card border-danger shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title text-danger">💸 Total Expenses</h5>
                        <h3 class="card-text">{{ number_format($totalExpenses, 2) }} $</h3>
                    </div>
                </div>
            </div>
            <!-- Remaining -->
            <div class="col-md-4 mb-3">
                <div class="card border-primary shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">✅ Remaining</h5>
                        <h3 class="card-text">
                            {{ number_format(($income->income ?? 0) - $totalExpenses, 2) }} $
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Expenses Table</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{route('expenses.create')}}" class="btn btn-block btn-primary">Add New
                                Expense</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-center mb-0">
                        <thead class="thead-dark">
                        <tr>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Note</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{ number_format($expense->amount, 2) }} $</td>
                                <td>{{ $expense->category->name ?? '—' }}</td>
                                <td>{{ $expense->note ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">No expenses found this month.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
