@extends(template() . 'layouts.app')
@section('title', trans('Register'))

@push('style')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 25%, #16213e 50%, #0f3460 75%, #533483 100%);
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
            transform: translateY(-2px);
        }

        .gradient-button {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #dc2626 100%);
            transition: all 0.3s ease;
        }

        .gradient-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(249, 115, 22, 0.4);
        }

        .step-indicator {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .step-indicator.active {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            transform: scale(1.1);
        }

        .step-indicator.completed {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .step-indicator.pending {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        .step-content {
            display: none;
            animation: fadeInSlide 0.5s ease-out;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .progress-line {
            height: 2px;
            background: rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #f97316, #ea580c);
            transition: width 0.5s ease;
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: rgba(255, 255, 255, 0.6);
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #f97316;
        }
    </style>
@endpush

@section('content')
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-r from-orange-500/20 to-purple-500/20 rounded-full blur-3xl floating-animation">
        </div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-r from-blue-500/20 to-teal-500/20 rounded-full blur-3xl floating-animation"
            style="animation-delay: -3s;"></div>
    </div>

    <div class="w-full max-w-md glass-card p-8 rounded-2xl relative z-10">
        <!-- Progress Indicator -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <div class="step-indicator active" id="step-1-indicator">1</div>
                <div class="step-indicator pending" id="step-2-indicator">2</div>
                <div class="step-indicator pending" id="step-3-indicator">3</div>
                <div class="step-indicator pending" id="step-4-indicator">4</div>
            </div>
            <div class="progress-line">
                <div class="progress-fill" id="progress-fill" style="width: 25%"></div>
            </div>
            <div class="text-center mt-3">
                <span class="text-gray-300 text-sm" id="step-title">Personal Information</span>
            </div>
        </div>

        <!-- Display Laravel validation errors -->

        <form method="POST" action="{{ route('register') }}" id="registration-form">
            @csrf
            <!-- Step 1: Personal Information -->
            <div class="step-content active" id="step-1">
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Personal Information</h2>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-200">First Name</label>
                        <input type="text" name="first_name" id="name" required value="{{old('first_name')}}"
                            placeholder="Enter your first name"
                            class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                        <div class="error-message text-red-400 text-xs mt-1 hidden"></div>
                    </div>
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-200">Last Name</label>
                        <input type="text" name="last_name" id="name" required value="{{old('last_name')}}"
                            placeholder="Enter your last name"
                            class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                        <div class="error-message text-red-400 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="space-y-2">
                        <label for="username" class="block text-sm font-medium text-gray-200">Username</label>
                        <input type="text" name="username" id="username" required value="{{old('username')}}"
                            placeholder="Choose a unique username (3+ characters, letters/numbers/underscore only)"
                            pattern="[a-zA-Z0-9_]{3,}"
                            class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                        <p class="text-gray-400 text-xs mt-1">Username must be at least 3 characters and contain only
                            letters, numbers, and underscores</p>
                        <div class="error-message text-red-400 text-xs mt-1 hidden"></div>
                    </div>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="button" onclick="nextStep(1)"
                        class="gradient-button px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300">
                        Next Step
                    </button>
                </div>
            </div>

            <!-- Step 2: Contact Information -->
            <div class="step-content" id="step-2">
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Contact Information</h2>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="phone" class="block text-sm font-medium text-gray-200">Phone Number</label>
                        <input type="tel" name="phone" id="phone" required value="{{old('phone')}}"
                            placeholder="Enter 11 digit phone number" maxlength="11" pattern="[0-9]{11}"
                            class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                        <p class="text-gray-400 text-xs mt-1">Please enter exactly 11 digits (e.g., 08012345678)</p>
                        <div class="error-message text-red-400 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-200">Email Address</label>
                        <input type="email" name="email" id="email" required value=""
                            placeholder="Enter your email address"
                            class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                        <div class="error-message text-red-400 text-xs mt-1 hidden"></div>
                    </div>
                </div>

                <div class="pt-6 flex justify-between">
                    <button type="button" onclick="prevStep(2)"
                        class="px-6 py-3 rounded-xl text-gray-300 border border-gray-600 hover:bg-gray-700 transition-all duration-300">
                        Previous
                    </button>
                    <button type="button" onclick="nextStep(2)"
                        class="gradient-button px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300">
                        Next Step
                    </button>
                </div>
            </div>

            <!-- Step 3: Security -->
            <div class="step-content" id="step-3">
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Security</h2>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                        <div class="password-container">
                            <input type="password" name="password" id="password" required minlength="8"
                                placeholder="Create a strong password (min 8 characters)"
                                class="input-field w-full px-4 py-3 pr-12 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <svg id="password-eye-closed" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                        clip-rule="evenodd"></path>
                                    <path
                                        d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z">
                                    </path>
                                </svg>
                                <svg id="password-eye-open" class="w-5 h-5 hidden" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-400 text-xs mt-1">Password must be at least 8 characters long</p>
                        <div class="error-message text-red-400 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Confirm
                            Password</label>
                        <div class="password-container">
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                placeholder="Confirm your password"
                                class="input-field w-full px-4 py-3 pr-12 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                            <button type="button" class="password-toggle"
                                onclick="togglePassword('password_confirmation')">
                                <svg id="password_confirmation-eye-closed" class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                        clip-rule="evenodd"></path>
                                    <path
                                        d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z">
                                    </path>
                                </svg>
                                <svg id="password_confirmation-eye-open" class="w-5 h-5 hidden" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="error-message text-red-400 text-xs mt-1 hidden"></div>
                    </div>
                </div>

                <div class="pt-6 flex justify-between">
                    <button type="button" onclick="prevStep(3)"
                        class="px-6 py-3 rounded-xl text-gray-300 border border-gray-600 hover:bg-gray-700 transition-all duration-300">
                        Previous
                    </button>
                    <button type="button" onclick="nextStep(3)"
                        class="gradient-button px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300">
                        Review
                    </button>
                </div>
            </div>

            <!-- Step 4: Review & Submit -->
            <div class="step-content" id="step-4">
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Review Information</h2>

                <div class="space-y-4 mb-6">
                    <div class="glass-card p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-white mb-3">Personal Information</h3>
                        <p class="text-gray-300 text-sm"><strong>Name:</strong> <span id="review-name"></span></p>
                        <p class="text-gray-300 text-sm"><strong>Username:</strong> <span id="review-username"></span></p>
                    </div>

                    <div class="glass-card p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-white mb-3">Contact Information</h3>
                        <p class="text-gray-300 text-sm"><strong>Phone:</strong> <span id="review-phone"></span></p>
                        <p class="text-gray-300 text-sm"><strong>Email:</strong> <span id="review-email"></span></p>
                    </div>
                </div>

                <div class="pt-6 flex justify-between">
                    <button type="button" onclick="prevStep(4)"
                        class="px-6 py-3 rounded-xl text-gray-300 border border-gray-600 hover:bg-gray-700 transition-all duration-300">
                        Previous
                    </button>
                    <button type="submit"
                        class="gradient-button px-8 py-3 rounded-xl text-white font-semibold transition-all duration-300">
                        Create Account
                    </button>
                </div>
            </div>
        </form>

        <!-- Login Link -->
        <div class="text-center pt-6 border-t border-gray-700 mt-8">
            <a href="{{ route('login') }}"
                class="text-gray-300 hover:text-orange-400 transition-colors duration-300 text-sm group">
                Already have an account?
                <span
                    class="font-medium border-b border-transparent group-hover:border-orange-400 transition-all duration-300">
                    Sign in here
                </span>
            </a>
        </div>
    </div>

@endsection

@push('script')
    <script>
        let currentStep = 1;
        const totalSteps = 4;

        const stepTitles = {
            1: "Personal Information",
            2: "Contact Information",
            3: "Security",
            4: "Review & Submit"
        };

        function updateProgressIndicator() {
            const progressPercentage = (currentStep / totalSteps) * 100;
            document.getElementById('progress-fill').style.width = progressPercentage + '%';
            document.getElementById('step-title').textContent = stepTitles[currentStep];

            // Update step indicators
            for (let i = 1; i <= totalSteps; i++) {
                const indicator = document.getElementById(`step-${i}-indicator`);
                if (i < currentStep) {
                    indicator.className = 'step-indicator completed';
                    indicator.innerHTML = '✓';
                } else if (i === currentStep) {
                    indicator.className = 'step-indicator active';
                    indicator.innerHTML = i;
                } else {
                    indicator.className = 'step-indicator pending';
                    indicator.innerHTML = i;
                }
            }
        }

        function getErrorDiv(input) {
            // For regular inputs, look in the parent container
            let errorDiv = input.parentElement.querySelector('.error-message');

            // If not found and this is a password field, look in the grandparent container
            if (!errorDiv && input.closest('.password-container')) {
                errorDiv = input.closest('.space-y-2').querySelector('.error-message');
            }

            return errorDiv;
        }

        function validateStep(step) {
            console.log(`=== Validating step ${step} ===`);
            let isValid = true;
            const stepElement = document.getElementById(`step-${step}`);
            const inputs = stepElement.querySelectorAll('input[required]');

            inputs.forEach(input => {
                const errorDiv = getErrorDiv(input);
                console.log(`Validating ${input.id}:`, input.value);

                if (!errorDiv) {
                    console.warn(`No error div found for ${input.id}`);
                    return;
                }

                if (!input.value.trim()) {
                    const message = `${input.getAttribute('placeholder')} is required.`;
                    errorDiv.textContent = message;
                    errorDiv.classList.remove('hidden');
                    console.log(`Error for ${input.id}: ${message}`);
                    isValid = false;
                } else {
                    // Special validation for username
                    if (input.id === 'username') {
                        const usernameValue = input.value.trim();
                        const usernameRegex = /^[a-zA-Z0-9_]{3,}$/;
                        if (!usernameRegex.test(usernameValue)) {
                            const message =
                                'Username must be at least 3 characters and contain only letters, numbers, and underscores.';
                            errorDiv.textContent = message;
                            errorDiv.classList.remove('hidden');
                            console.log(`Error for ${input.id}: ${message}`);
                            isValid = false;
                        } else {
                            errorDiv.classList.add('hidden');
                        }
                    }
                    // Special validation for phone number
                    else if (input.type === 'tel') {
                        const phoneValue = input.value.trim();
                        if (!/^\d{11}$/.test(phoneValue)) {
                            const message = 'Phone number must be exactly 11 digits.';
                            errorDiv.textContent = message;
                            errorDiv.classList.remove('hidden');
                            console.log(`Error for ${input.id}: ${message}`);
                            isValid = false;
                        } else {
                            errorDiv.classList.add('hidden');
                        }
                    }
                    // Special validation for email
                    else if (input.type === 'email') {
                        const emailValue = input.value.trim();
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(emailValue)) {
                            const message = 'Please enter a valid email address.';
                            errorDiv.textContent = message;
                            errorDiv.classList.remove('hidden');
                            console.log(`Error for ${input.id}: ${message}`);
                            isValid = false;
                        } else {
                            errorDiv.classList.add('hidden');
                        }
                    } else {
                        errorDiv.classList.add('hidden');
                    }
                }
            });

            // Additional validation for step 3 (password confirmation)
            if (step === 3) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                const passwordErrorDiv = getErrorDiv(document.getElementById('password'));
                const confirmErrorDiv = getErrorDiv(document.getElementById('password_confirmation'));

                console.log('Password validation:', {
                    password: password,
                    confirmPassword: confirmPassword,
                    passwordLength: password.length,
                    passwordsMatch: password === confirmPassword
                });

                // Password length validation
                if (password.length < 8) {
                    const message = 'Password must be at least 8 characters long.';
                    passwordErrorDiv.textContent = message;
                    passwordErrorDiv.classList.remove('hidden');
                    console.log(`Password error: ${message}`);
                    isValid = false;
                } else {
                    passwordErrorDiv.classList.add('hidden');
                }

                // Password confirmation validation
                if (password !== confirmPassword) {
                    const message = 'Passwords do not match.';
                    confirmErrorDiv.textContent = message;
                    confirmErrorDiv.classList.remove('hidden');
                    console.log(`Confirm password error: ${message}`);
                    isValid = false;
                } else if (confirmPassword.length > 0) {
                    confirmErrorDiv.classList.add('hidden');
                }
            }

            console.log(`Step ${step} validation result: ${isValid}`);
            return isValid;
        }

        // Password toggle functionality
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeClosedIcon = document.getElementById(fieldId + '-eye-closed');
            const eyeOpenIcon = document.getElementById(fieldId + '-eye-open');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeClosedIcon.classList.add('hidden');
                eyeOpenIcon.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                eyeClosedIcon.classList.remove('hidden');
                eyeOpenIcon.classList.add('hidden');
            }
        }

        function nextStep(step) {
            console.log(`=== Attempting to go from step ${step} to step ${step + 1} ===`);

            if (validateStep(step)) {
                console.log(`Step ${step} validation passed - proceeding`);

                if (step === 3) {
                    // Update review information
                    document.getElementById('review-name').textContent = document.getElementById('name').value;
                    document.getElementById('review-username').textContent = document.getElementById('username').value;
                    document.getElementById('review-phone').textContent = document.getElementById('phone').value;
                    document.getElementById('review-email').textContent = document.getElementById('email').value;
                }

                document.getElementById(`step-${currentStep}`).classList.remove('active');
                currentStep++;
                document.getElementById(`step-${currentStep}`).classList.add('active');
                updateProgressIndicator();
                console.log(`Successfully moved to step ${currentStep}`);
            } else {
                console.log(`Step ${step} validation failed - staying on current step`);
            }
        }

        function prevStep(step) {
            document.getElementById(`step-${currentStep}`).classList.remove('active');
            currentStep--;
            document.getElementById(`step-${currentStep}`).classList.add('active');
            updateProgressIndicator();
        }

        // Initialize
        updateProgressIndicator();

        // Phone number input restriction
        document.getElementById('phone').addEventListener('input', function(e) {
            // Remove any non-digit characters
            this.value = this.value.replace(/\D/g, '');

            // Limit to 11 digits
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11);
            }
        });

        // Username input restriction
        document.getElementById('username').addEventListener('input', function(e) {
            // Only allow letters, numbers, and underscores
            this.value = this.value.replace(/[^a-zA-Z0-9_]/g, '');
        });
    </script>
@endpush
