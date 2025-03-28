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

        @session('status')
            <div class="card card-md card-active">
                <div class="card-body py-4">
                    <p class="text-body-secondary">{{ $value }}</p>
                </div>
            </div>
        @endsession

        <form wire:submit="login" class="card card-md">
            <div class="card-body">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email address') }}</label>
                    <input
                        wire:model="email"
                        name="email"
                        type="email"
                        id="email"
                        class="form-control"
                        autocomplete="email"
                        autofocus
                        required
                    />

                    @error('email')
                        <p class="d-block invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        {{ __('Password') }}

                        @if (Route::has('password.request'))
                            <span class="form-label-description">
                                <a class="link-primary" href="{{ route('password.request') }}" wire:navigate>
                                    {{ __('Forgot your password?') }}
                                </a>
                            </span>
                        @endif
                    </label>

                    <input
                        wire:model="password"
                        name="password"
                        type="password"
                        id="password"
                        class="form-control"
                        required
                        autocomplete="current-password"
                    />

                    @error('password')
                        <p class="d-block invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-check">
                        <input wire:model="remember" name="remember" type="checkbox" class="form-check-input" />
                        <span class="form-check-label">
                            {{ __('Remember me') }}
                        </span>
                    </label>
                </div>

                <div class="form-footer">
                    <button wire:loading.class="btn-loading" type="submit" class="btn btn-primary w-100">
                        {{ __('Log in') }}
                    </button>
                </div>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="mt-3 text-center text-secondary">
                {{ __('Don\'t have an account?') }}
                <a class="link-primary" href="{{ route('register') }}" wire:navigate>{{ __('Sign up') }}</a>
            </div>
        @endif
    </div>
</div>
