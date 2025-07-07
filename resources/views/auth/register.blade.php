<x-guest-layout>
    <div class="floating-shapes">
        <div class="shape1" style="top: 15%; right: 10%; width: 60px; height: 60px; background: var(--primary-color); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;"></div>
        <div class="shape2" style="bottom: 15%; left: 10%; width: 45px; height: 45px; background: var(--secondary-color); border-radius: 63% 37% 30% 70% / 50% 45% 55% 50%;"></div>
    </div>

    <h2 class="text-center text-3xl font-bold mb-8" style="color: var(--text-primary);">Create Account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- User Type Selection -->
        <div class="mb-6">
            <label class="form-label">I am a:</label>
            <div class="user-type-cards">
                <label class="user-type-card">
                    <input type="radio" name="user_type" value="entrepreneur" checked>
                    <div class="card-content">
                        <i class="fas fa-lightbulb icon"></i>
                        <div class="title">Entrepreneur</div>
                        <div class="description">Start your journey with innovative ideas</div>
                    </div>
                </label>
                <label class="user-type-card">
                    <input type="radio" name="user_type" value="government">
                    <div class="card-content">
                        <i class="fas fa-building icon"></i>
                        <div class="title">Government</div>
                        <div class="description">Connect with innovative solutions</div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Name -->
        <div class="mb-6">
            <label for="name" class="form-label">
                <i class="fas fa-user text-gray-400 mr-2"></i>
                {{ __('Full Name') }}
            </label>
            <input id="name" type="text" class="form-input" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="form-label">
                <i class="fas fa-envelope text-gray-400 mr-2"></i>
                {{ __('Email Address') }}
            </label>
            <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="form-label">
                <i class="fas fa-lock text-gray-400 mr-2"></i>
                {{ __('Password') }}
            </label>
            <div class="relative">
                <input id="password" type="password" class="form-input" name="password" required placeholder="Create a password">
                <button type="button" onclick="togglePassword('password', 'toggleIcon1')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-eye" id="toggleIcon1"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="form-label">
                <i class="fas fa-lock text-gray-400 mr-2"></i>
                {{ __('Confirm Password') }}
            </label>
            <div class="relative">
                <input id="password_confirmation" type="password" class="form-input" name="password_confirmation" required placeholder="Confirm your password">
                <button type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-eye" id="toggleIcon2"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="btn-primary">
            {{ __('Create Account') }}
        </button>
    </form>

    <div class="social-login">
        <p>Or sign up with</p>
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
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </div>

    <style>
        .user-type-option {
            cursor: pointer;
        }

        .option-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .user-type-option input:checked + .option-content {
            border-color: var(--primary-color);
            background: rgba(74, 144, 226, 0.1);
            color: var(--primary-color);
        }

        .option-content i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
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
            const password = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
