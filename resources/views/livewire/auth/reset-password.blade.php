<div class="page page-center">
    <div class="container container-tight space-y-4 py-4">
        <div class="text-center">
            <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 42" class="navbar-brand-image h-6 text-primary">
                    <path
                        fill="currentColor"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M17.2 5.633 8.6.855 0 5.633v26.51l16.2 9 16.2-9v-8.442l7.6-4.223V9.856l-8.6-4.777-8.6 4.777V18.3l-5.6 3.111V5.633ZM38 18.301l-5.6 3.11v-6.157l5.6-3.11V18.3Zm-1.06-7.856-5.54 3.078-5.54-3.079 5.54-3.078 5.54 3.079ZM24.8 18.3v-6.157l5.6 3.111v6.158L24.8 18.3Zm-1 1.732 5.54 3.078-13.14 7.302-5.54-3.078 13.14-7.3v-.002Zm-16.2 7.89 7.6 4.222V38.3L2 30.966V7.92l5.6 3.111v16.892ZM8.6 9.3 3.06 6.222 8.6 3.143l5.54 3.08L8.6 9.3Zm21.8 15.51-13.2 7.334V38.3l13.2-7.334v-6.156ZM9.6 11.034l5.6-3.11v14.6l-5.6 3.11v-14.6Z"
                    ></path>
                </svg>
            </a>
        </div>

        <form wire:submit="resetPassword" class="card card-md">
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
