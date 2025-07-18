<form wire:submit="save">
    <div class="card">
        <!-- <div class="card-header"> -->
        <!--     <h3 class="card-title">Lorem, ipsum</h3> -->
        <!-- </div> -->

        <div class="card-body">
            <div class="space-y">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-label">Email</div>
                        <input wire:model="email" class="form-control" id="email" type="email" autocomplete="email" />
                        @error('email')
                            <p class="invalid-feedback d-block">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-body-secondary">
                                Your email address is unverified. Please check your inbox for a verification email and
                                click the link to confirm your email. If you didn\'t receive the email, we will gladly
                                send you another.
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
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex column-gap-2 align-items-center justify-content-end">
                <button wire:loading.class="btn-loading" class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
</form>
