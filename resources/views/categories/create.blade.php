@extends('layouts.app')
@section('page_title')
    Categories
@endsection

@section('page_heading')
    Create Category
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
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="post" action="{{route('categories.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" placeholder="Category Name">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
