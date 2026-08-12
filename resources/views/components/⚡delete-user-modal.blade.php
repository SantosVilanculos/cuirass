<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

new class extends Component {
    public ?string $password = null;

    public function destroy(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->authorize('delete', $user);

        $this->validate([
            'password' => ['required', 'string', 'current_password', 'exclude'],
        ]);

        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();

        $path = $user->image;

        $user->delete();

        if (is_string($path) && Storage::disk('public')->fileExists($path)) {
            Storage::disk('public')->delete($path);
        }

        $this->redirectRoute('login', navigate: true);
    }
};
?>

<div x-data="{ open: false }">
    <button x-on:click="open = true" class="btn text-danger" type="button">Delete my account</button>

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
                    <form wire:submit="destroy" class="modal-content border shadow-sm">
                        <div class="modal-body">
                            @csrf

                            <div class="modal-title">Are you sure?</div>

                            <p class="text-body-secondary">If you proceed, you will lose all your personal data. Please enter your password to confirm that you would like to permanently delete your personal data.</p>

                            <div class="mb-3">
                                <label for="password" class="form-label">Current password</label>
                                <input
                                    wire:model="password"
                                    class="form-control"
                                    id="password"
                                    type="password"
                                    minlength="8"
                                    maxlength="20"
                                    autocomplete="current-password"
                                    required
                                />
                                @error('password')
                                    <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button x-on:click="open = false" type="button" class="btn btn-link link-secondary me-auto">
                                Cancel
                            </button>

                            <button wire:loading.class="btn-loading" type="submit" class="btn btn-danger">
                                Yes, delete all my data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endteleport
</div>
