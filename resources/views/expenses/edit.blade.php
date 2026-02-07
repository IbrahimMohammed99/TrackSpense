@extends('layouts.app')
@section('page_title')
    Edit Expense
@endsection

@section('page_heading')
    Edit Expense
@endsection

@section('main_content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('expenses.update', $expense->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="expense_amount">Expense Amount</label>
                <input
                    type="number"
                    class="form-control @error('amount') is-invalid @enderror"
                    id="expense_amount"
                    name="amount"
                    placeholder="Expense Amount"
                    value="{{ old('amount', $expense->amount) }}"
                >
                @error('amount')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

                <div class="form-group">
                    <label>Expense Category</label>
                    <select name="category_id"
                            class="form-control select2 @error('category_id') is-invalid @enderror"
                            style="width: 100%;">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ (old('category_id', $expense->category_id) == $category->id) ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                        @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </select>
                    @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

            <div class="form-group">
                <label for="expense_note">Expense Note</label>
                <input
                    type="text"
                    class="form-control @error('note') is-invalid @enderror"
                    id="expense_note"
                    name="note"
                    placeholder="Expense Note"
                    value="{{ old('note', $expense->note) }}"
                >
                @error('note')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
