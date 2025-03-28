<form wire:submit="save">
    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="card mb-5">
            <div class="card-body">
                <p class="text-body-secondary">
                    Your email address is unverified. Please check your inbox for a verification email and click the
                    link to confirm your email. If you didn\'t receive the email, we will gladly send you another.
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
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email address</label>
            <input wire:model="email" class="form-control" id="email" type="email" autocomplete="email" />
            @error('email')
                <p class="invalid-feedback d-block">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-footer">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
