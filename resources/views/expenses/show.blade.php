@extends('layouts.app')
@section('page_title')
    Incomes
@endsection

@section('page_heading')
    Income for This Month
@endsection
@section('main_content')

    @if($income)
        <div >
            Income for {{ $income->month }}: <span style="background-color: yellow; padding: 10px; border-radius: 6px; font-weight: bold; font-size: 18px; display: inline-block;"  >{{ number_format($income->income, 2) }} $</span>
        </div>
    @else
        <p>No income recorded for this month. <a href="{{route('incomes.create')}}">Enter the Income Now?</a></p>
    @endif
@endsection
