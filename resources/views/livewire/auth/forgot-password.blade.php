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
                <div class="card-body">
                    <p>
                        {{ $value }}
                    </p>
                </div>
            </div>
        @endsession

        <form wire:submit="sendPasswordResetLink" class="card card-md">
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
                        autofocus
                        required
                    />

                    @error('email')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-footer">
                    <button wire:loading.class="btn-loading" type="submit" class="btn btn-primary w-100">
                        {{-- mail --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                            <path d="M3 7l9 6l9 -6" />
                        </svg>

                        {{ __('Email password reset link') }}
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-3 text-center text-secondary">
            {{ __('Or, return to') }}
            <a href="{{ route('login') }}" wire:navigate>{{ __('log in') }}</a>
        </div>
    </div>
</div>
