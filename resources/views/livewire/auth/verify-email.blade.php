<div class="page page-center">
    <div class="container container-tight space-y-4 py-4">
        <div class="text-center">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('favicon.svg') }}" alt="{{ config('app.name') }}" class="w-6 h-6 navbar-brand-image" />
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
                <p class="mb-3 text-body-secondary">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                <form wire:submit="sendVerification" class="mb-3">
                    @csrf

                    <button wire:loading.class="btn-loading" wire:target="sendVerification" type="submit"
                        class="btn btn-primary w-100">
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
