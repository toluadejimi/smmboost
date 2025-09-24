@extends(template() . 'layouts.app')
@section('title', trans('Login'))

@push('style')
    <style>
        /* ===========================================
                       ORANGE DARK MODE LOGIN FORM STYLES
                       =========================================== */

        /* CSS Custom Properties - Orange Dark Theme */
        :root {
            /* Primary Orange Color Scheme */
            --primary-color: #f97316;
            --primary-hover: #ea580c;
            --primary-light: #fb923c;
            --primary-dark: #c2410c;

            /* Status Colors */
            --success-color: #22c55e;
            --success-bg: #166534;
            --success-border: #16a34a;
            --error-color: #ef4444;
            --error-bg: #7f1d1d;
            --error-border: #dc2626;
            --warning-color: #f59e0b;
            --warning-bg: #92400e;
            --warning-border: #d97706;

            /* Dark Theme Text Colors */
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --text-muted: #9ca3af;
            --text-accent: #fed7aa;

            /* Dark Theme Backgrounds */
            --bg-primary: #1f2937;
            --bg-secondary: #111827;
            --bg-tertiary: #0f172a;
            --border-color: #374151;
            --border-focus: #f97316;

            /* Enhanced Dark Mode Shadows */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.3);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.4), 0 2px 4px -2px rgb(0 0 0 / 0.3);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.5), 0 4px 6px -4px rgb(0 0 0 / 0.4);
            --shadow-orange: 0 8px 25px -8px rgb(249 115 22 / 0.3);

            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
        }

        /* Base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #111827 0%, #0f172a 50%, #000000 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            line-height: 1.6;
            color: var(--text-primary);
        }

        /* Main container */
        .login-container {
            background: var(--bg-primary);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg), var(--shadow-orange);
            padding: 2.5rem;
            max-width: 28rem;
            width: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        /* Decorative elements */
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .login-container::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, var(--primary-color) 0%, transparent 70%);
            opacity: 0.03;
            pointer-events: none;
        }

        /* Header section */
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-icon {
            width: 4rem;
            height: 4rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            position: relative;
            box-shadow: var(--shadow-orange);
            border: 2px solid var(--primary-light);
        }

        .login-icon::after {
            content: '🔐';
            font-size: 1.5rem;
            filter: grayscale(1) brightness(2);
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Session Status Messages */
        .status-message {
            border-radius: var(--radius-md);
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-success {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success-color);
        }

        .status-success::before {
            content: '✓';
            font-weight: bold;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-size: 0.875rem;
            font-family: 'Inter', monospace, sans-serif;
            transition: all 0.2s ease;
            word-break: break-all;
            line-height: 1.4;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgb(249 115 22 / 0.2);
            background: var(--bg-tertiary);
        }

        .form-input.error {
            border-color: var(--error-color);
            box-shadow: 0 0 0 3px rgb(239 68 68 / 0.2);
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        .form-input[type="password"] {
            font-family: 'Courier New', 'Monaco', 'Consolas', monospace;
            letter-spacing: 0.05em;
        }

        /* Checkbox styling */
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .checkbox-input {
            width: 1rem;
            height: 1rem;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .checkbox-input:checked {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .checkbox-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgb(249 115 22 / 0.2);
        }

        .checkbox-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            cursor: pointer;
        }

        /* Error messages */
        .error-message {
            color: var(--error-color);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            word-break: break-word;
            padding: 0.75rem;
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            border-radius: var(--radius-md);
        }

        /* Enhanced error message for credentials */
        .credentials-error {
            background: var(--warning-bg);
            border-color: var(--warning-border);
            color: var(--warning-color);
            position: relative;
        }

        .credentials-error::before {
            content: '⚠️';
            margin-right: 0.5rem;
        }

        /* Button styling */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            border: none;
            border-radius: var(--radius-md);
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            box-shadow: var(--shadow-sm), var(--shadow-orange);
            border: 1px solid var(--primary-light);
            text-shadow: 0 1px 2px rgb(0 0 0 / 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-hover), var(--primary-dark));
            transform: translateY(-1px);
            box-shadow: var(--shadow-md), 0 12px 30px -12px rgb(249 115 22 / 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: var(--shadow-sm), var(--shadow-orange), 0 0 0 3px rgb(249 115 22 / 0.3);
        }

        /* Link styling */
        .link {
            color: var(--text-muted);
            text-decoration: underline;
            font-size: 0.875rem;
            transition: color 0.2s ease;
        }

        .link:hover {
            color: var(--primary-color);
        }

        .link:focus {
            outline: none;
            color: var(--primary-color);
            text-decoration: none;
        }

        /* Enhanced forgot password link when there are credential errors */
        .link.highlighted {
            color: var(--warning-color);
            font-weight: 600;
            animation: pulse 2s infinite;
        }

        .link.highlighted:hover {
            color: var(--primary-light);
        }

        /* Form actions */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.5rem;
        }

        /* Responsive design */
        @media (max-width: 640px) {
            .login-container {
                padding: 1.5rem;
                margin: 0.5rem;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .btn-primary {
                width: 100%;
            }
        }

        /* Animation for status messages */
        .status-message {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        /* Loading state for buttons */
        .btn-primary.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-primary.loading::after {
            content: '';
            width: 1rem;
            height: 1rem;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 0.5rem;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Special styling for long passwords/hashes */
        .password-toggle {
            position: relative;
        }

        .password-toggle-btn {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 0.875rem;
            padding: 0.25rem;
            transition: color 0.2s ease;
        }

        .password-toggle-btn:hover {
            color: var(--primary-color);
        }
    </style>
@endpush

@section('content')
    <!-- LOGIN-SIGNUP -->
    <div class="login-container" role="main" aria-labelledby="login-title">
        <!-- Header Section -->
        <header class="login-header">
            <div class="login-icon" aria-hidden="true"></div>
            <h1 id="login-title" class="login-title">
                Welcome Back
            </h1>
            <p class="login-subtitle">
                Sign in to your account
            </p>
        </header>

        <!-- Session Status -->

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" id="login-form" accept-charset="UTF-8">
            @csrf
            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    Email
                </label>
                <input id="email" class="form-input {{ $errors->any()? "error" : "" }}" type="text" name="username"
                value="{{ old('username', config('demo.IS_DEMO') ? request()->username ?? 'demouser' : '') }}"
                required="" autofocus="" autocomplete="username" placeholder="@lang('Enter Your Email Or Username')">

                @if ($errors->any())
                    <div class="error-message credentials-error" role="alert">
                        <div>These credentials do not match our records. If you have registered with us before, please use the "Forgot Password" link below to reset your password.</div>
                    </div>  
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">
                    Password
                </label>
                <div class="password-toggle">
                    <input id="password" class="form-input" type="password" name="password" required=""
                        autocomplete="current-password" placeholder="@lang('Enter your password')" spellcheck="false" autocorrect="off"
                        autocapitalize="off"
                        value="{{ old('password', config('demo.IS_DEMO') ? request()->password ?? 'demouser' : '') }}">
                    <button type="button" class="password-toggle-btn" id="toggle-password" tabindex="-1">👁️</button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="checkbox-container">
                <input id="remember_me" type="checkbox" class="checkbox-input" name="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label for="remember_me" class="checkbox-label">
                    @lang('Remember me')
                </label>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a class="link " href="{{ route('password.request') }}" id="forgot-password-link">
                    @lang('Forgot Your Password?')
                </a>

                <button type="submit" class="btn-primary" id="login-btn">
                    <span>@lang('Login')</span>
                </button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        /**
         * Enhanced Login Form Interactions
         * 
         * This script provides:
         * - Loading states for form submissions
         * - Form validation enhancements
         * - Password visibility toggle
         * - Support for all password formats including hashes
         * - Accessibility improvements
         * - Enhanced error handling for credential errors
         */

        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('login-form');
            const loginBtn = document.getElementById('login-btn');
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('toggle-password');
            const forgotPasswordLink = document.getElementById('forgot-password-link');

            // Handle form submission
            if (loginForm && loginBtn) {
                loginForm.addEventListener('submit', function(e) {
                    // Add loading state
                    loginBtn.classList.add('loading');
                    loginBtn.disabled = true;

                    // Ensure form accepts any password format
                    if (passwordInput && passwordInput.value) {
                        // Trim whitespace but preserve all characters
                        passwordInput.value = passwordInput.value.trim();
                    }
                });
            }

            // Password visibility toggle
            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.textContent = type === 'password' ? '👁️' : '🙈';
                });
            }

            // Enhanced form validation feedback
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.classList.add('error');
                    } else {
                        this.classList.remove('error');
                    }
                });

                input.addEventListener('input', function() {
                    this.classList.remove('error');
                });
            });

            // Special handling for password input to preserve all characters
            if (passwordInput) {
                passwordInput.addEventListener('paste', function(e) {
                    // Allow pasting of any content including hashes
                    setTimeout(() => {
                        // Ensure the input accepts the pasted content
                        this.dispatchEvent(new Event('input', {
                            bubbles: true
                        }));
                    }, 0);
                });

                // Prevent any automatic formatting or filtering
                passwordInput.addEventListener('input', function(e) {
                    // Store original value to prevent any unwanted modifications
                    const originalValue = this.value;

                    // Re-apply if browser tries to modify it
                    setTimeout(() => {
                        if (this.value !== originalValue) {
                            this.value = originalValue;
                        }
                    }, 0);
                });
            }

            // Add focus to forgot password link when there are credential errors
            if (forgotPasswordLink && forgotPasswordLink.classList.contains('highlighted')) {
                // Scroll the link into view if needed
                setTimeout(() => {
                    forgotPasswordLink.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }, 100);
            }
        });
    </script>
@endpush
