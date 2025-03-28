<div class="page page-center">
    <div class="container container-tight space-y-4 py-4">
        <div class="text-center">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img
                    src="{{ asset('favicon.svg') }}"
                    alt="{{ config('app.name') }}"
                    class="w-6 h-6 navbar-brand-image"
                />
            </a>
        </div>

        <form wire:submit="resetPassword" class="card card-md">
            <div class="card-body">
                @csrf

                <p class="mb-3 text-body-secondary">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email address') }}</label>
                    <input
                        wire:model="email"
                        name="email"
                        type="email"
                        id="email"
                        class="form-control"
                        autocomplete="email"
                        required
                    />
                    @error('email')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <small class="form-hint">
                        {{ __('Your password must be 8-20 characters long.') }}
                    </small>
                    <input
                        wire:model="password"
                        name="password"
                        type="password"
                        id="password"
                        class="form-control"
                        autocomplete="new-password"
                        required
                        minlength="8"
                        maxlength="20"
                    />
                    @error('password')
                        <p class="d-block invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">
                        {{ __('Confirm Password') }}
                    </label>
                    <input
                        wire:model="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        id="password_confirmation"
                        class="form-control"
                        required
                        minlength="8"
                        maxlength="20"
                        autocomplete="new-password"
                    />
                </div>

                <div class="form-footer">
                    <button wire:loading.class="btn-loading" type="submit" class="mb-3 btn btn-primary w-100">
                        {{ __('Reset password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
