<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
            </div>
            <x-input-error :messages="$errors->get('email')" class="input-error" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="input-error" />
        </div>

        <!-- Login Button -->
        <button type="submit" class="auth-btn">
            Login
        </button>

        <!-- Remember Me & Forgot Password -->
        <div class="auth-options">
            <label for="remember_me" class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Footer -->
        <div class="auth-footer">
            <a href="{{ url('/homepage') }}">Continue as Guest</a>
        </div>
    </form>
</x-guest-layout>
