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

        @if (session('status') == 'verification-link-sent')
            <div class="card card-md card-active">
                <div class="card-body py-4">
                    <p class="text-body-secondary">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </p>
                </div>
            </div>
        @endif

        <div class="card card-md">
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
                <p class="mb-3 text-body-secondary">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                <div class="form-footer">
                    <form wire:submit="sendVerification" class="mb-3">
                        @csrf
                        <button
                            wire:loading.class="btn-loading"
                            wire:target="sendVerification"
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            {{ __('Resend verification email') }}
                        </button>
                    </form>
                    <form wire:submit="logout">
                        @csrf
                        <button type="submit" class="btn w-100">{{ __('Log out') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
