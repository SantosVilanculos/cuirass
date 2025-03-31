<form wire:submit="save">
    <h3 class="card-title">Email</h3>
    <p class="card-subtitle">The email address used for authentication and notifications.</p>
    <div>
        <div class="row g-2">
            <div class="col-auto">
                <input wire:model="email" class="form-control" id="email" type="email" autocomplete="email" />
            </div>
            <div class="col-auto">
                <button wire:click="save" wire:loading.class="btn-loading" class="btn" type="submit">Change</button>
            </div>
        </div>
        @error('email')
            <p class="invalid-feedback d-block">{{ $message }}</p>
        @enderror
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="mt-4">
            <p class="text-body-secondary">
                Your email address is unverified. Please check your inbox for a verification email and click the link to
                confirm your email. If you didn\'t receive the email, we will gladly send you another.
            </p>
            <button
                wire:click="sendEmailVerificationNotification"
                wire:loading.class="btn-loading"
                class="btn icon-sm"
                type="button"
            >
                Resend the verification email.
            </button>
        </div>
    @endif
</form>
