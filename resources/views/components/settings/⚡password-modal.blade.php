<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

new class extends Component {
    public bool $showModal = false;

    public ?string $current_password = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $this->authorize('update', $user);

        $this->validate([
            'current_password' => ['required', 'string', 'current_password', 'exclude'],
            'password' => ['required', 'string', Rules\Password::defaults(), 'confirmed'],
        ]);

        if (Hash::check((string) $this->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => __('The new password can\'t be the same as the current password.'),
            ]);
        }

        $user->update(['password' => Hash::make((string) $this->password)]);

        Auth::logoutOtherDevices((string) $this->password);

        $this->reset();
        $this->showModal = false;
        $this->dispatch('message', text: __('passwords.reset'), icon: 'success');
    }
};
?>

<div x-data="{ open: $wire.entangle('showModal') }">
    <button x-on:click="open = true" class="btn" type="button">Set new password</button>

    @teleport('body')
        <div>
            <div x-cloak x-show="open" class="modal-backdrop show"></div>

            <div
                x-cloak
                x-show="open"
                x-transition:enter.scale.80
                x-transition:leave.scale.90
                x-bind:aria-hidden="!open"
                class="modal modal-blur show"
                tabindex="-1"
            >
                <div
                    x-on:click.outside="open = false"
                    class="modal-dialog modal-md modal-dialog-centered"
                    role="document"
                >
                    <form wire:submit="save" class="modal-content border shadow-sm">
                        <div class="modal-body">
                            @csrf

                            <div class="modal-title">Update password</div>

                            <div class="mb-3">
                                <label class="form-label" for="current_password">Current password</label>
                                <input
                                    wire:model="current_password"
                                    class="form-control"
                                    id="current_password"
                                    type="password"
                                    autocomplete="current-password"
                                />
                                @error('current_password')
                                    <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">New password</label>
                                <small class="form-hint">
                                    Your password must be 8-20 characters long. Don't use a password form another site,
                                    or something too obvious like your pet's name.
                                </small>
                                <input
                                    wire:model="password"
                                    class="form-control"
                                    id="password"
                                    type="password"
                                    autocomplete="new-password"
                                />
                                @error('password')
                                    <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="password_confirmation">Confirm new password</label>
                                <input
                                    wire:model="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control"
                                    type="password"
                                    autocomplete="new-password"
                                />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button x-on:click="open = false" type="button" class="btn btn-link link-secondary me-auto">
                                Cancel
                            </button>

                            <button wire:loading.class="btn-loading" type="submit" class="btn btn-primary">
                                Reset password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endteleport
</div>
