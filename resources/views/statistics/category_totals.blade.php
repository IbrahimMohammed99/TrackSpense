@extends('layouts.app')
@section('page_title')
    Expense Report
@endsection
@section('page_heading')
Expenses total By Category
@endsection
@section('main_content')
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-center mb-0">
            <thead class="thead-dark">
            <tr>
                <th>Category</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{$item['category']}}</td>
                    <td>{{$item['total']}} $</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-muted">No expenses found this month.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

