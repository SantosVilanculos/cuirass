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

        <form wire:submit="confirmPassword" class="card card-md">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        @isset(Auth::user()->image)
                            <span
                                class="avatar avatar-2 rounded"
                                style="background-image: url({{ Storage::disk('public')->url(Auth::user()->image) }})"
                            ></span>
                        @else
                            <span class="avatar avatar-2 rounded">
                                {{ Str::of(Auth::user()->name)->substr(0, 1) }}
                            </span>
                        @endisset
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
