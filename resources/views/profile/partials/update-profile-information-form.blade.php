<!-- <section class="profile-info-section">
    <header class="section-header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" class="form-label" />
            <div class="input-wrapper">
                <x-text-input id="name" name="name" type="text" class="form-input" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </span>
            </div>
            <x-input-error class="error-message" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" class="form-label" />
            <div class="input-wrapper">
                <x-text-input id="email" name="email" type="email" class="form-input" :value="old('email', $user->email)" required autocomplete="username" />
                <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                </span>
            </div>
            <x-input-error class="error-message" :messages="$errors->get('email')" />

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
            <x-primary-button class="save-button">
                <span class="button-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                </span>
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="success-message"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    {{ __('Saved.') }}
                </p>
            @endif 
        </div>
    </form>
</section>

<style>
    /* Enhanced Profile Form Styles */
    .profile-info-section {
        background-color: white;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .section-header {
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 1rem;
    }

    .section-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .section-header p {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 500;
        font-size: 0.875rem;
        color: #4b5563;
        margin-bottom: 0.5rem;
    }

    .input-wrapper {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f9fafb;
        color: #1f2937;
    }

    .form-input:focus {
        border-color: rgb(147, 7, 231);
        box-shadow: 0 0 0 3px rgba(147, 7, 231, 0.2);
        outline: none;
        background-color: white;
    }

    .input-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }

    .form-input:focus + .input-icon {
        color: rgb(147, 7, 231);
    }

    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .verification-alert {
        margin-top: 0.75rem;
        padding: 0.75rem;
        background-color: #eff6ff;
        border-left: 3px solid #3b82f6;
        border-radius: 0.375rem;
    }

    .verification-text {
        font-size: 0.875rem;
        color: #1e40af;
    }

    .verification-link {
        background: none;
        border: none;
        color: rgb(147, 7, 231);
        text-decoration: underline;
        font-size: 0.875rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .verification-link:hover {
        color: #3b82f6;
    }

    .verification-success {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #047857;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .save-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(to right, rgb(147, 7, 231), #3b82f6);
        color: white;
        font-weight: 500;
        padding: 0.625rem 1.25rem;
        border-radius: 0.5rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .save-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background: linear-gradient(to right, rgb(126, 6, 199), #2563eb);
    }

    .button-icon {
        display: flex;
        align-items: center;
    }

    .success-message {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        color: #059669;
        font-size: 0.875rem;
        background-color: #d1fae5;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .form-actions {
            flex-direction: column;
            align-items: flex-start;
        }

        .save-button {
            width: 100%;
            justify-content: center;
        }

        .success-message {
            margin-top: 0.75rem;
        }
    }
</style> -->