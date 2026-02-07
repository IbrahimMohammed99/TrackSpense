@extends('layouts.app')
@section('page_title', 'Profile')
@section('page_heading')
    Edit Profile
@endsection
@section('main_content')
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', auth()->user()->name) }}"
                        required
                    >
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', auth()->user()->email) }}"
                        required
                    >
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Profile Photo --}}
                <div class="mb-3">
                    <label for="photo" class="form-label">Profile Photo</label>
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                    @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if(auth()->user()->photo)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                 alt="Profile Photo"
                                 class="rounded-circle"
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                    @endif
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">New Password (optional)</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        autocomplete="new-password"
                    >
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
        </div> {{-- card-body --}}
    </div> {{-- card --}}
@endsection
