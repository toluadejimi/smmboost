@extends('layouts.app')
@section('title')
    @lang('Email Verify')
@endsection

@section('content')
    <div class="verification-container" role="main" aria-labelledby="verification-title">
        <!-- Header Section -->
        <header class="verification-header">
            <div class="verification-icon" aria-hidden="true"></div>
            <h1 id="verification-title" class="verification-title selectable-text">
                Verify Your Email
            </h1>
            <p class="verification-subtitle selectable-text">
                We're almost there! Just one more step.
            </p>
        </header>

        <!-- Main Verification Message -->
        <div class="verification-message selectable-text" role="alert" aria-live="polite">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we
            just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <!-- Success Message (Conditional) -->

        <!-- Action Buttons -->
        <div class="verification-actions">
            <!-- Resend Verification Email Form -->
            <form method="POST" action="{{ route('verification.resend') }}" id="resend-form">
                @csrf
                <button type="submit" class="btn-primary" id="resend-btn" aria-describedby="resend-help">
                    <span>Resend Verification Email</span>
                </button>
            </form>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="btn-secondary" aria-label="Sign out of your account">
                    Sign Out
                </button>
            </form>
        </div>

        <!-- Help Text -->
        <div class="help-text">
            <p id="resend-help" class="selectable-text">
                Still having trouble? Check your spam folder or contact our support team for assistance.
            </p>
        </div>
    </div>
@endsection

@push('script')
    <script>
        /**
         * Enhanced Email Verification Page Interactions
         * 
         * This script provides:
         * - Loading states for form submissions
         * - Success message display
         * - Form validation
         * - Accessibility enhancements
         * - Zoom prevention
        */
        document.addEventListener('DOMContentLoaded', function() {
            const resendForm = document.getElementById('resend-form');
            const resendBtn = document.getElementById('resend-btn');

            // Prevent zoom on iOS double-tap
            let lastTouchEnd = 0;
            document.addEventListener('touchend', function(event) {
                const now = (new Date()).getTime();
                if (now - lastTouchEnd <= 300) {
                    event.preventDefault();
                }
                lastTouchEnd = now;
            }, false);

            // Prevent pinch-to-zoom
            document.addEventListener('gesturestart', function(e) {
                e.preventDefault();
            });

            document.addEventListener('gesturechange', function(e) {
                e.preventDefault();
            });

            document.addEventListener('gestureend', function(e) {
                e.preventDefault();
            });

            // Prevent wheel zoom
            document.addEventListener('wheel', function(e) {
                if (e.ctrlKey) {
                    e.preventDefault();
                }
            }, {
                passive: false
            });

            // Prevent keyboard zoom
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && (e.keyCode === 61 || e.keyCode === 107 || e.keyCode ===
                        173 || e.keyCode === 109 || e.keyCode === 187 || e.keyCode === 189)) {
                    e.preventDefault();
                }
            });

            // Handle resend form submission
            if (resendForm && resendBtn) {
                resendForm.addEventListener('submit', function(e) {
                    // Add loading state
                    resendBtn.classList.add('loading');
                    resendBtn.disabled = true;

                    // The form will submit normally, this just provides visual feedback
                });
            }

            // Handle logout form submission with confirmation
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to sign out?')) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
@endpush
