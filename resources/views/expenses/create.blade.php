@extends('layouts.app')
@section('page_title')
    Enter Expense
@endsection

@section('page_heading')
    Enter Expense
@endsection
@section('main_content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="post" action="{{route('expenses.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="expense_amount">Expense Amount</label>
                <input type="number" class="form-control @error('expense') is-invalid @enderror" id="expense_amount"
                       name="amount" placeholder="Expense Amount">
                @error('amount')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Expense Category</label>
                <select name="category_id" class="form-control select2" style="width: 100%;">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="expense_note">Expense Note</label>
                <input type="text" class="form-control @error('note') is-invalid @enderror" id="expense_note"
                       name="note" placeholder="Expense Note">
                @error('note')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

@endsection
