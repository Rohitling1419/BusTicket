@extends('frontend.Master')
@section('content')

<div class="container" style="margin-top: 60px;">
    <div class="profile-section">
        <!-- Profile Information Section -->
        <div class="profile-block">
            <div class="section-header">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    {{ __('Profile Information') }}
                </h2>
                <p>{{ __("Update your account's profile information and email address.") }}</p>
            </div>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div class="form-group">
                    <x-input-label for="name" :value="__('Name')" class="form-label" />
                    <div class="input-wrapper">
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    </div>
                    <x-input-error class="mt-2 error-message" :messages="$errors->get('name')" />
                </div>

                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" class="form-label" />
                    <div class="input-wrapper">
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    </div>
                    <x-input-error class="mt-2 error-message" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="verification-alert">
                        <p class="verification-text">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="verification-link">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                        <p class="verification-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="form-actions">
                    <x-primary-button class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        {{ __('Save Changes') }}
                    </x-primary-button>

                    @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="success-message">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Change Password Section -->
        <div class="profile-block">
            <div class="section-header">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    {{ __('Update Password') }}
                </h2>
                <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
            </div>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div class="form-group password-field">
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" class="form-label" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 error-message" />
                </div>

                <div class="form-group password-field">
                    <x-input-label for="update_password_password" :value="__('New Password')" class="form-label" />
                    <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-progress" id="passwordStrength"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Password strength: Too weak</div>
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 error-message" />
                </div>

                <div class="form-group password-field">
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="form-label" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 error-message" />
                </div>


                <div class="form-actions">
                    <x-primary-button class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        {{ __('Update Password') }}
                    </x-primary-button>

                    @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="success-message">{{ __('Password updated.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    :root {
        --primary-color: rgb(147, 7, 231);
        --primary-hover: rgb(126, 6, 199);
        --primary-light: rgba(147, 7, 231, 0.05);
        --secondary-color: #3579e4;
        --text-dark: #2d3748;
        --text-medium: #4a5568;
        --text-light: #718096;
        --bg-light: #f9fafb;
        --bg-white: #ffffff;
        --border-color: #e2e8f0;
        --success-color: #059669;
        --success-light: #d1fae5;
        --error-color: #e53e3e;
        --error-light: #fee2e2;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --radius-sm: 6px;
        --radius-md: 8px;
        --radius-lg: 12px;
        --transition: all 0.3s ease;
    }

    body {
        background-color: #f9fafb;
        color: var(--text-dark);
        font-family: 'Inter', 'Segoe UI', Roboto, -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.6;
    }

    /* Container */
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .page-title {
        text-align: center;
        margin-bottom: 2.5rem;
        position: relative;
    }

    .page-title h1 {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .page-title p {
        color: var(--text-medium);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Profile Section */
    .profile-section {
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
    }

    .profile-block {
        background-color: var(--bg-white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
        padding: 2.5rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .profile-block::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    }

    .section-header {
        margin-bottom: 2rem;
        position: relative;
    }

    .section-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-header h2 svg {
        color: var(--primary-color);
    }

    .section-header p {
        color: var(--text-medium);
        font-size: 0.95rem;
    }

    /* Form Styles */
    .mt-1 {
        margin-top: 0.25rem;
    }

    .mt-2 {
        margin-top: 0.5rem;
    }

    .mt-6 {
        margin-top: 1.5rem;
    }

    .space-y-6>*+* {
        margin-top: 1.5rem;
    }

    .block {
        display: block;
    }

    .w-full {
        width: 100%;
    }

    .text-lg {
        font-size: 1.125rem;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .font-medium {
        font-weight: 500;
    }

    .text-gray-900 {
        color: var(--text-dark);
    }

    .text-gray-600 {
        color: var(--text-medium);
    }

    .flex {
        display: flex;
    }

    .items-center {
        align-items: center;
    }

    .gap-4 {
        gap: 1rem;
    }

    /* Enhanced Form Elements */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        display: block;
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select,
    textarea {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        font-size: 1rem;
        transition: var(--transition);
        background-color: var(--bg-light);
        color: var(--text-dark);
        box-shadow: var(--shadow-sm);
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    select:focus,
    textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(147, 7, 231, 0.15);
        outline: none;
        background-color: var(--bg-white);
    }

    /* Password Field Styling */
    .password-field {
        position: relative;
    }

    .password-field input {
        padding-right: 2.5rem;
    }

    .password-toggle {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-medium);
        cursor: pointer;
        transition: var(--transition);
        padding: 0.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover {
        color: var(--primary-color);
    }

    .password-toggle:focus {
        outline: none;
    }

    /* Button Styles */
    .btn {
        padding: 0.875rem 1.75rem;
        font-size: 1rem;
        font-weight: 600;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 6px rgba(147, 7, 231, 0.2);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(147, 7, 231, 0.25);
    }

    .btn:active {
        transform: translateY(0);
    }

    .btn:disabled {
        background: #cbd5e0;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .btn:hover::after {
        left: 100%;
    }

    /* Success Message */
    .success-message {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        background-color: var(--success-light);
        color: var(--success-color);
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        animation: fadeIn 0.3s ease;
        box-shadow: 0 2px 4px rgba(5, 150, 105, 0.1);
    }

    .success-message::before {
        content: '✓';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        background-color: var(--success-color);
        color: white;
        border-radius: 50%;
        font-size: 0.75rem;
    }

    /* Error Message */
    .error-message {
        color: var(--error-color);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .error-message::before {
        content: '!';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 16px;
        height: 16px;
        background-color: var(--error-color);
        color: white;
        border-radius: 50%;
        font-size: 0.75rem;
    }

    /* Verification Alert */
    .verification-alert {
        margin-top: 0.75rem;
        padding: 1rem;
        background-color: #eff6ff;
        border-left: 3px solid #3b82f6;
        border-radius: var(--radius-md);
    }

    .verification-text {
        font-size: 0.875rem;
        color: #1e40af;
    }

    .verification-link {
        background: none;
        border: none;
        color: var(--primary-color);
        text-decoration: underline;
        font-size: 0.875rem;
        cursor: pointer;
        transition: color 0.3s ease;
        padding: 0;
        margin: 0;
        box-shadow: none;
    }

    .verification-link:hover {
        color: var(--secondary-color);
        background: none;
        transform: none;
        box-shadow: none;
    }

    .verification-link::after {
        display: none;
    }

    .verification-success {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--success-color);
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    /* Password Strength Meter */
    .password-strength {
        margin-top: 0.5rem;
    }

    .strength-bar {
        height: 4px;
        background-color: var(--border-color);
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .strength-progress {
        height: 100%;
        width: 0;
        background: linear-gradient(to right, #ef4444, #f59e0b, #10b981);
        transition: width 0.3s ease;
    }

    .strength-text {
        font-size: 0.75rem;
        color: var(--text-medium);
    }

    /* Password Tips */
    .password-tips {
        margin-top: 1.5rem;
        padding: 1rem;
        background-color: var(--primary-light);
        border-radius: var(--radius-md);
        border-left: 3px solid var(--primary-color);
    }

    .tips-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tips-list {
        list-style-type: none;
        padding-left: 0;
        margin: 0.5rem 0 0;
    }

    .tips-list li {
        font-size: 0.8125rem;
        color: var(--text-medium);
        margin-bottom: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tips-list li::before {
        content: "✓";
        color: var(--primary-color);
        font-weight: bold;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media screen and (min-width: 768px) {
        .profile-section {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media screen and (max-width: 768px) {
        .container {
            padding: 20px 15px;
        }

        .profile-block {
            padding: 1.5rem;
        }

        .section-header h2 {
            font-size: 1.25rem;
        }

        .btn {
            width: 100%;
        }

        .flex.items-center.gap-4 {
            flex-direction: column;
            align-items: flex-start;
        }

        .flex.items-center.gap-4>* {
            width: 100%;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const passwordFields = document.querySelectorAll('input[type="password"]');

        passwordFields.forEach(field => {
            // Create toggle button
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'password-toggle';
            toggleBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            toggleBtn.setAttribute('aria-label', 'Toggle password visibility');

            // Add toggle functionality
            toggleBtn.addEventListener('click', function() {
                const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
                field.setAttribute('type', type);

                // Change icon based on password visibility
                if (type === 'text') {
                    this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
                } else {
                    this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
                }
            });

            // Add toggle button to password field container
            field.parentNode.appendChild(toggleBtn);
        });

        // Password strength meter
        const passwordInput = document.getElementById('update_password_password');
        const strengthBar = document.getElementById('passwordStrength');
        const strengthText = document.getElementById('strengthText');

        if (passwordInput && strengthBar && strengthText) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let width = '0%';
                let text = 'Too weak';

                if (password.length > 0) {
                    // Calculate password strength
                    if (password.length >= 8) strength += 25;
                    if (/[A-Z]/.test(password)) strength += 25;
                    if (/[0-9]/.test(password)) strength += 25;
                    if (/[^A-Za-z0-9]/.test(password)) strength += 25;

                    width = strength + '%';

                    // Update text based on strength
                    if (strength <= 25) {
                        text = 'Too weak';
                        strengthBar.style.backgroundColor = '#ef4444';
                    } else if (strength <= 50) {
                        text = 'Could be stronger';
                        strengthBar.style.backgroundColor = '#f59e0b';
                    } else if (strength <= 75) {
                        text = 'Strong';
                        strengthBar.style.backgroundColor = '#10b981';
                    } else {
                        text = 'Very strong';
                        strengthBar.style.backgroundColor = '#059669';
                    }
                }

                strengthBar.style.width = width;
                strengthText.textContent = 'Password strength: ' + text;
            });
        }

        // Check password match
        const confirmInput = document.getElementById('update_password_password_confirmation');

        if (passwordInput && confirmInput) {
            confirmInput.addEventListener('input', function() {
                if (passwordInput.value && this.value) {
                    if (passwordInput.value === this.value) {
                        this.style.borderColor = '#10b981';
                        this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
                    } else {
                        this.style.borderColor = '#ef4444';
                        this.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
                    }
                } else {
                    this.style.borderColor = '';
                    this.style.boxShadow = '';
                }
            });
        }
    });
</script>
@endsection