@extends('admin.loyout.master')
@section('content')
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        </script>
    @endif
    <div class=" flex items-center justify-center px-4 py-12 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
        <div class="w-full max-w-md fade-in">
            <!-- Logo / Brand -->
            <div class="text-center mb-8">

                <h2 class="text-3xl font-extrabold text-gray-800">Reset Password</h2>
                <p class="text-sm text-gray-500 mt-2">Enter your email and create a new password</p>
            </div>

            <!-- Card -->
            <div class="card-glass rounded-2xl shadow-2xl p-8 border border-white/20">
                <!-- Success Message -->
                <div id="successMessage"
                    class="hidden mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg text-sm flex items-start gap-3">
                    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                    <span id="successText">Password reset successfully!</span>
                </div>

                <!-- Error Message -->
                <div id="errorMessage"
                    class="hidden mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg text-sm flex items-start gap-3">
                    <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                    <span id="errorText">Please fix the errors below.</span>
                </div>

                <form action="{{ route('password.forget') }}" method="POST" class="space-y-6" novalidate>
                    @csrf <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                            <i class="fas fa-envelope mr-2 text-indigo-500"></i>Email Address
                        </label>
                        <div class="relative">
                            <input type="email" id="email" name="email" placeholder="admin@example.com" required
                                class="w-full px-4 py-3 pl-11 bg-white/80 border @error('email') border-red-600 @enderror border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus-effect transition-all duration-200"
                                autocomplete="email" readonly value="{{ old('email',AdminLogin()->email ?? "") }}">
                            @error('email')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror

                            <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                        </div>
                        <p id="emailError" class="mt-1.5 text-xs text-red-500 hidden flex items-center gap-1">
                            <i class="fas fa-circle-exclamation"></i>
                            <span id="emailErrorText">Please enter a valid email address.</span>
                        </p>
                    </div>

                    <!-- New Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                            <i class="fas fa-lock mr-2 text-indigo-500"></i>New Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Enter new password" required
                                minlength="8"
                                class="w-full px-4 py-3 pl-11 bg-white/80 border @error('password') border-red-600 @enderror border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus-effect transition-all duration-200"
                                autocomplete="new-password">
                            @error('password')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                            <i class="fas fa-key absolute left-3 top-3.5 text-gray-400"></i>
                            <button type="button" id="togglePassword"
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <p id="passwordError" class="mt-1.5 text-xs text-red-500 hidden flex items-center gap-1">
                            <i class="fas fa-circle-exclamation"></i>
                            <span id="passwordErrorText">Password must be at least 8 characters.</span>
                        </p>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>Minimum 8 characters required
                        </p>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="confirmPassword" class="block text-sm font-semibold text-gray-700 mb-1">
                            <i class="fas fa-check-circle mr-2 text-indigo-500"></i>Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" id="confirmPassword" name="password_confirmation"
                                placeholder="Confirm new password" required
                                class="w-full px-4 py-3 pl-11 bg-white/80 border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus-effect transition-all duration-200"
                                autocomplete="new-password">
                            <i class="fas fa-check-double absolute left-3 top-3.5 text-gray-400"></i>
                            <button type="button" id="toggleConfirmPassword"
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <p id="confirmError" class="mt-1.5 text-xs text-red-500 hidden flex items-center gap-1">
                            <i class="fas fa-circle-exclamation"></i>
                            <span id="confirmErrorText">Passwords do not match.</span>
                        </p>
                    </div>

                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-medium text-gray-500">Password strength:</span>
                            <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                <div id="strengthBar"
                                    class="h-full w-0 bg-red-500 transition-all duration-300 rounded-full"></div>
                            </div>
                            <span id="strengthText" class="text-xs font-medium text-gray-500">Weak</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn"
                        class="btn-hover w-full flex justify-center items-center gap-2 py-3.5 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                        <i class="fas fa-sync-alt"></i>
                        <span id="btnText">Reset Password</span>
                        <i id="spinner" class="fas fa-spinner fa-spin hidden"></i>
                    </button>

                </form>


            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        (function() {
            'use strict';

            const form = document.getElementById('resetPasswordForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirmPassword');

            const emailError = document.getElementById('emailError');
            const emailErrorText = document.getElementById('emailErrorText');
            const passwordError = document.getElementById('passwordError');
            const passwordErrorText = document.getElementById('passwordErrorText');
            const confirmError = document.getElementById('confirmError');
            const confirmErrorText = document.getElementById('confirmErrorText');

            const successMessage = document.getElementById('successMessage');
            const successText = document.getElementById('successText');
            const errorMessage = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');

            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const spinner = document.getElementById('spinner');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');

            // Toggle password visibility
            document.getElementById('togglePassword').addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
                const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Hide messages initially
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
            emailError.classList.add('hidden');
            passwordError.classList.add('hidden');
            confirmError.classList.add('hidden');

            // Email validation
            function validateEmail() {
                const email = emailInput.value.trim();
                if (email === '') {
                    emailError.classList.remove('hidden');
                    emailErrorText.textContent = 'Email address is required.';
                    emailInput.classList.add('border-red-400', 'ring-1', 'ring-red-400');
                    return false;
                }
                if (!isValidEmail(email)) {
                    emailError.classList.remove('hidden');
                    emailErrorText.textContent = 'Please enter a valid email address (e.g., name@domain.com).';
                    emailInput.classList.add('border-red-400', 'ring-1', 'ring-red-400');
                    return false;
                }
                emailError.classList.add('hidden');
                emailInput.classList.remove('border-red-400', 'ring-1', 'ring-red-400');
                return true;
            }

            function isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Password strength checker
            function checkPasswordStrength(password) {
                let score = 0;
                if (password.length >= 8) score++;
                if (password.length >= 12) score++;
                if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
                if (/\d/.test(password)) score++;
                if (/[^a-zA-Z0-9]/.test(password)) score++;
                return score;
            }

            function updateStrengthBar(score) {
                const percentages = [0, 20, 40, 60, 80, 100];
                const colors = ['#ef4444', '#f59e0b', '#f59e0b', '#3b82f6', '#22c55e', '#22c55e'];
                const labels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong', 'Very Strong'];

                strengthBar.style.width = percentages[score] + '%';
                strengthBar.style.backgroundColor = colors[score] || '#ef4444';
                strengthText.textContent = labels[score] || 'Weak';
                strengthText.style.color = colors[score] || '#ef4444';
            }

            // Real-time validation
            emailInput.addEventListener('blur', function() {
                validateEmail();
            });

            emailInput.addEventListener('input', function() {
                if (!emailError.classList.contains('hidden')) {
                    emailError.classList.add('hidden');
                    emailInput.classList.remove('border-red-400', 'ring-1', 'ring-red-400');
                }
                if (!errorMessage.classList.contains('hidden')) {
                    errorMessage.classList.add('hidden');
                }
            });

            passwordInput.addEventListener('input', function() {
                const strength = checkPasswordStrength(this.value);
                updateStrengthBar(strength);

                if (!passwordError.classList.contains('hidden')) {
                    passwordError.classList.add('hidden');
                    this.classList.remove('border-red-400', 'ring-1', 'ring-red-400');
                }
                if (!errorMessage.classList.contains('hidden')) {
                    errorMessage.classList.add('hidden');
                }

                // Check confirm password match in real-time
                if (confirmInput.value !== '') {
                    if (this.value !== confirmInput.value) {
                        confirmError.classList.remove('hidden');
                        confirmErrorText.textContent = 'Passwords do not match.';
                        confirmInput.classList.add('border-red-400', 'ring-1', 'ring-red-400');
                    } else {
                        confirmError.classList.add('hidden');
                        confirmInput.classList.remove('border-red-400', 'ring-1', 'ring-red-400');
                    }
                }
            });

            confirmInput.addEventListener('input', function() {
                if (passwordInput.value !== this.value) {
                    confirmError.classList.remove('hidden');
                    confirmErrorText.textContent = 'Passwords do not match.';
                    this.classList.add('border-red-400', 'ring-1', 'ring-red-400');
                } else {
                    confirmError.classList.add('hidden');
                    this.classList.remove('border-red-400', 'ring-1', 'ring-red-400');
                }
                if (!errorMessage.classList.contains('hidden')) {
                    errorMessage.classList.add('hidden');
                }
            });

            // Validate password
            function validatePassword() {
                const password = passwordInput.value;
                if (password.length < 8) {
                    passwordError.classList.remove('hidden');
                    passwordErrorText.textContent = 'Password must be at least 8 characters.';
                    passwordInput.classList.add('border-red-400', 'ring-1', 'ring-red-400');
                    return false;
                }
                passwordError.classList.add('hidden');
                passwordInput.classList.remove('border-red-400', 'ring-1', 'ring-red-400');
                return true;
            }

            // Validate confirm password
            function validateConfirm() {
                if (passwordInput.value !== confirmInput.value) {
                    confirmError.classList.remove('hidden');
                    confirmErrorText.textContent = 'Passwords do not match.';
                    confirmInput.classList.add('border-red-400', 'ring-1', 'ring-red-400');
                    return false;
                }
                confirmError.classList.add('hidden');
                confirmInput.classList.remove('border-red-400', 'ring-1', 'ring-red-400');
                return true;
            }

            // Form submit
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Reset UI
                successMessage.classList.add('hidden');
                errorMessage.classList.add('hidden');

                // Validate all fields
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();
                const isConfirmValid = validateConfirm();

                if (!isEmailValid || !isPasswordValid || !isConfirmValid) {
                    errorText.textContent = 'Please fix the errors above.';
                    errorMessage.classList.remove('hidden');

                    form.classList.add('shake');
                    setTimeout(() => form.classList.remove('shake'), 400);

                    if (!isEmailValid) {
                        emailInput.focus();
                    } else if (!isPasswordValid) {
                        passwordInput.focus();
                    } else if (!isConfirmValid) {
                        confirmInput.focus();
                    }
                    return;
                }

                // ---- Simulate API call ----
                submitBtn.disabled = true;
                btnText.textContent = 'Resetting...';
                spinner.classList.remove('hidden');
                submitBtn.classList.add('opacity-70', 'cursor-not-allowed');

                const email = emailInput.value.trim();
                const password = passwordInput.value;

                // Simulate network delay
                setTimeout(function() {
                    // Simulate success (always success for demo)
                    const success = true;

                    if (success) {
                        // Show success
                        successText.textContent =
                            `Password reset successfully for ${email}! You can now login with your new password.`;
                        successMessage.classList.remove('hidden');

                        // Clear form
                        emailInput.value = '';
                        passwordInput.value = '';
                        confirmInput.value = '';
                        strengthBar.style.width = '0%';
                        strengthText.textContent = 'Weak';
                        strengthText.style.color = '#ef4444';

                        // Hide any errors
                        emailError.classList.add('hidden');
                        passwordError.classList.add('hidden');
                        confirmError.classList.add('hidden');
                        errorMessage.classList.add('hidden');

                        // Remove error styles
                        [emailInput, passwordInput, confirmInput].forEach(input => {
                            input.classList.remove('border-red-400', 'ring-1', 'ring-red-400');
                        });
                    } else {
                        errorText.textContent = 'Something went wrong. Please try again later.';
                        errorMessage.classList.remove('hidden');
                        form.classList.add('shake');
                        setTimeout(() => form.classList.remove('shake'), 400);
                    }

                    // Reset button
                    submitBtn.disabled = false;
                    btnText.textContent = 'Reset Password';
                    spinner.classList.add('hidden');
                    submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');

                    // Auto hide success after 6s
                    if (success) {
                        setTimeout(() => {
                            successMessage.classList.add('hidden');
                        }, 6000);
                    }

                }, 1800);
            });

            // Back to login link
            document.querySelector('a[href="#"]')?.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Navigate to login page (demo)');
            });

        })();
    </script>
@endsection
