@extends(template() . 'layouts.app')
@section('title', trans($pageSeo['page_title'] ?? 'Email Verify'))


@push('style')
    <style>
        /* ===========================================
           ORANGE DARK MODE FORGOT PASSWORD STYLES
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
        .forgot-password-container {
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
        .forgot-password-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }
        
        .forgot-password-container::after {
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
        .forgot-password-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .forgot-password-icon {
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
        
        .forgot-password-icon::after {
            content: '🔑';
            font-size: 1.5rem;
            filter: grayscale(1) brightness(2);
        }
        
        .forgot-password-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        
        .forgot-password-subtitle {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }
        
        /* Info message */
        .info-message {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
            line-height: 1.5;
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
            margin-bottom: 1.5rem;
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
            transition: all 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgb(249 115 22 / 0.2);
            background: var(--bg-tertiary);
        }
        
        .form-input::placeholder {
            color: var(--text-muted);
        }
        
        /* Error messages */
        .error-message {
            color: var(--error-color);
            font-size: 0.8rem;
            margin-top: 0.5rem;
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
            width: 100%;
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
        
        /* Back link */
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }
        
        .back-link a {
            color: var(--text-muted);
            text-decoration: underline;
            font-size: 0.875rem;
            transition: color 0.2s ease;
        }
        
        .back-link a:hover {
            color: var(--primary-color);
        }
        
        .back-link a:focus {
            outline: none;
            color: var(--primary-color);
            text-decoration: none;
        }
        
        /* Responsive design */
        @media (max-width: 640px) {
            .forgot-password-container {
                padding: 1.5rem;
                margin: 0.5rem;
            }
            
            .forgot-password-title {
                font-size: 1.5rem;
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
    </style>
@endpush

@section('content')
    <div class="forgot-password-container" role="main" aria-labelledby="forgot-password-title">
        <!-- Header Section -->
        <header class="forgot-password-header">
            <div class="forgot-password-icon" aria-hidden="true"></div>
            <h1 id="forgot-password-title" class="forgot-password-title">
                @lang(@$forgotPasswordContent->description->title)
            </h1>
            <p class="forgot-password-subtitle">
                {!! __(@$forgotPasswordContent->description->description) !!}
            </p>
        </header>

        <!-- Info Message -->
        <div class="info-message" role="alert" aria-live="polite">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <!-- Session Status -->

        <!-- Forgot Password Form -->
        <form method="POST" action="{{ route('user.password.email') }}" id="forgot-password-form">
            @csrf
            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    Email
                </label>
                <input id="email" class="form-input" type="email" name="email" value="{{old('email')}}" required=""
                    autofocus="" placeholder="@lang('Enter Your Email Address')" style="border-color: var(--error-color);">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary" id="reset-btn">
                <span>@lang('Send Password Reset Link')</span>
            </button>
        </form>

        <!-- Back to Login Link -->
        <div class="back-link">
            <a href="{{ route('login') }}">
                ← Back to Login
            </a>
        </div>
    </div>
@endsection

@push('script')
    <script>
        /**
         * Enhanced Forgot Password Form Interactions
         * 
         * This script provides:
         * - Loading states for form submissions
         * - Form validation enhancements
         * - Accessibility improvements
         */

        document.addEventListener('DOMContentLoaded', function() {
            const forgotPasswordForm = document.getElementById('forgot-password-form');
            const resetBtn = document.getElementById('reset-btn');

            // Handle form submission
            if (forgotPasswordForm && resetBtn) {
                forgotPasswordForm.addEventListener('submit', function(e) {
                    // Add loading state
                    resetBtn.classList.add('loading');
                    resetBtn.disabled = true;

                    // The form will submit normally, this just provides visual feedback
                });
            }

            // Enhanced form validation feedback
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.style.borderColor = 'var(--error-color)';
                    } else if (this.value && !this.validity.valid) {
                        this.style.borderColor = 'var(--error-color)';
                    } else {
                        this.style.borderColor = 'var(--border-color)';
                    }
                });

                emailInput.addEventListener('input', function() {
                    this.style.borderColor = 'var(--border-color)';
                });
            }
        });
    </script>
@endpush
