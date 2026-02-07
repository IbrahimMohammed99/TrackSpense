@extends('layouts.app')
@section('page_title')
    Incomes
@endsection

@section('page_heading')
    Incomes
@endsection
@section('main_content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Incomes Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{route('incomes.create')}}" class="btn btn-block btn-primary">Add New
                                Income</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Income Amount</th>
                            <th>Month</th>
                            <th>Show Expenses For This Month</th>
{{--                            <th>Edit</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomes as $income)
                            <tr>
                                <td>
                                 {{ number_format($income->income, 2) }}
                                 {{ $income->currency === 'USD' ? '$' : '₪' }}
                                </td>
                                <td>{{$income->month}}</td>
                                <td><a href="{{route('incomes.expenses',$income->id)}}">Show Expenses</a></td>
{{--{{-                               <td><a href="{{route('incomes.edit',$income->id)}}">Edit</a></td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
