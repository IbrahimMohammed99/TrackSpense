<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TrackSpense | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/trackspense-auth.css') }}">
</head>
<body>

    <div class="theme-switch">
    <button id="darkBtn" onclick="setDark()">🌙</button>
    <button id="lightBtn" onclick="setLight()">☀</button>
</div>


<div class="auth-wrapper">

    <!-- Left Section -->
    <div class="auth-left">
        <img src="{{ asset('images/expense.svg') }}" class="float-img" alt="TrackSpense">
        <h1>TrackSpense</h1>
        <p>Manage your expenses smarter & safer</p>
    </div>

    <!-- Right Section -->
    <div class="auth-right">
        <h2>Sign In</h2>

        {{-- Errors --}}
        @error('email')
            <div class="error-box">{{ $message }}</div>
        @enderror

        @error('password')
            <div class="error-box">{{ $message }}</div>
        @enderror

        @error('auth')
            <div class="error-box">{{ $message }}</div>
        @enderror

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                <label>Email Address</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="login-btn">
                Login
            </button>
        </form>

        <span class="secure-text">🔒 Your data is securely protected</span>
    </div>

</div>

<script>
    function setDark() {
        document.body.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        updateButtons();
    }

    function setLight() {
        document.body.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        updateButtons();
    }

    function updateButtons() {
        const isDark = document.body.classList.contains('dark');
        document.getElementById('darkBtn').style.display = isDark ? 'none' : 'inline';
        document.getElementById('lightBtn').style.display = isDark ? 'inline' : 'none';
    }

    // Load saved theme
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
    }

    updateButtons();
</script>


</body>
</html>
