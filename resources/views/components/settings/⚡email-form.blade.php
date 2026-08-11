<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component {
    public ?string $email = null;

    public function save(): void
    {
        /** @var User */
        $user = Auth::user();

        $this->authorize('update', $user);

        $this->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:254', Rule::unique(User::class)->ignoreModel($user)],
        ]);

        $user->fill([
            'email' => $this->email,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($user->wasChanged('email') && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail) {
            $user->sendEmailVerificationNotification();
        }

        $this->dispatch('user:updated');
        $this->dispatch('message', text: __('Changes saved.'), icon: 'success');
    }

    public function sendEmailVerificationNotification(): void
    {
        /** @var User */
        $user = Auth::user();

        if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }

        $this->dispatch('message', text: __('A new verification link has been sent to your email address.'), icon: 'success');
    }

    public function mount(): void
    {
        /** @var User */
        $user = Auth::user();

        $this->email = $user->email;
    }
};
?>

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

                @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-body-secondary">Your email address is unverified. Please check your inbox for a verification email and click the link to confirm your email. If you didn\'t receive the email, we will gladly send you another.</p>
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
