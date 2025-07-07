<x-guest-layout>
    <div class="floating-shapes">
        <div class="shape1" style="top: 20%; left: 10%; width: 50px; height: 50px; background: var(--primary-color); border-radius: 28% 72% 70% 30% / 53% 51% 49% 47%;"></div>
        <div class="shape2" style="top: 60%; right: 10%; width: 40px; height: 40px; background: var(--secondary-color); border-radius: 41% 59% 41% 59% / 40% 48% 52% 60%;"></div>
    </div>

    <h2 class="text-center text-3xl font-bold mb-8" style="color: var(--text-primary);">Welcome Back!</h2>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="form-label">
                <i class="fas fa-envelope text-gray-400 mr-2"></i>
                {{ __('Email Address') }}
            </label>
            <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="form-label">
                <i class="fas fa-lock text-gray-400 mr-2"></i>
                {{ __('Password') }}
            </label>
            <div class="relative">
                <input id="password" type="password" class="form-input" name="password" required placeholder="Enter your password">
                <button type="button" onclick="togglePassword('password', 'toggleIcon')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-6 flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" class="form-checkbox" name="remember">
                <span class="ml-2 text-sm" style="color: var(--text-secondary);">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="auth-link text-sm" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary">
            {{ __('Sign In') }}
        </button>
    </form>

    <div class="social-login">
        <p>Or continue with</p>
        <div class="social-buttons">
            <a href="{{ route('google.login') }}" class="social-button">
                <i class="fab fa-google"></i>
            </a>
            <a href="{{ route('facebook.login') }}" class="social-button">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ route('github.login') }}" class="social-button">
                <i class="fab fa-github"></i>
            </a>
        </div>
    </div>

    <div class="auth-footer">
        Don't have an account? <a href="{{ route('register') }}">Sign up</a>
    </div>

    <style>
        .form-checkbox {
            width: 1rem;
            height: 1rem;
            border-radius: 4px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-checkbox:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .social-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .social-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #4a90e2;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .social-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: #357abd;
        }

        .social-login {
            margin-top: 2rem;
            text-align: center;
        }

        .social-login p {
            color: #6b7280;
            margin-bottom: 1rem;
        }
    </style>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
