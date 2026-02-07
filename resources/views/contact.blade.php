@extends('layouts.app')

@section('page_title', 'Contact')

@section('main_content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Contact Us</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <p>If you have any questions or suggestions, feel free to contact us.</p>

            <form method="POST" action="{{ route('contact.send') }}">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Your name" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Your email" required>
                </div>

                <div class="mb-3">
                    <label>Message</label>
                    <textarea class="form-control" rows="4" required></textarea>
                </div>

                <button class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
