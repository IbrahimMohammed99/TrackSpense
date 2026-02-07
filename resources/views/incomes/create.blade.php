@extends('layouts.app')
@section('page_title')
    Incomes
@endsection

@section('page_heading')
    Create Income
@endsection
@section('main_content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="post" action="{{route('incomes.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="income_amount">Income Amount</label>
                <input type="number" class="form-control @error('income') is-invalid @enderror" id="income_amount"
                       name="income" placeholder="Income Amount">
                @error('income')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
             <div class="form-group">
        <label for="currency">Currency</label>
        <select name="currency" class="form-control">
            <option value="USD">$ Dollar</option>
            <option value="ILS">₪ Shekel</option>
        </select>
               </div>
              </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
