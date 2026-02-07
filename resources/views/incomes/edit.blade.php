{{--@extends('layouts.app')--}}
{{--@section('page_title')--}}
{{--    Incomes--}}
{{--@endsection--}}

{{--@section('page_heading')--}}
{{--    Create Income--}}
{{--@endsection--}}
{{--@section('main_content')--}}
{{--    @if(session('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <form method="post" action="{{route('incomes.update',$income->id)}}">--}}
{{--        @csrf--}}
{{--        @method('PUT')--}}
{{--        <div class="card-body">--}}
{{--            <div class="form-group">--}}
{{--                <label for="income_amount">Income Amount</label>--}}
{{--                <input type="number" class="form-control @error('income') is-invalid @enderror" id="income_amount"--}}
{{--                       value="{{ old('$income', $income->income) }}"--}}
{{--                       name="income" placeholder="Income Amount">--}}
{{--                @error('income')--}}
{{--                <p class="text-danger">{{ $message }}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /.card-body -->--}}

{{--        <div class="card-footer">--}}
{{--            <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--@endsection--}}
