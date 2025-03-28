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

        <form wire:submit="confirmPassword" class="card card-md">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <span class="avatar avatar-2 rounded" style="background-image: url('')">
                            {{ Str::of(Auth::user()->name)->substr(0, 1) }}
                        </span>
                    </div>

                    <div class="col">
                        <div class="text-body-secondary">{{ __('Logged in as') }}</div>
                        <div class="text-body fw-medium">{{ Auth::user()->name }}</div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @csrf

                <p class="mb-3 text-body-secondary">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        {{ __('Password') }}
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

                <div class="form-footer">
                    <button wire:loading.class="btn-loading" type="submit" class="btn btn-primary w-100">
                        {{-- lock-open --}}
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
                            <path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                            <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M8 11v-5a4 4 0 0 1 8 0" />
                        </svg>
                        {{ __('Confirm') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
