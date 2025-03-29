<div x-data="{ open: $wire.entangle('showModal') }">
    <div>
        <h3 class="card-title">Password</h3>
        <p class="card-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <div>
            <button x-on:click="open = true" class="btn" type="button">Set new password</button>
        </div>
    </div>

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
                    <form wire:submit="save" class="modal-content">
                        <div class="modal-body">
                            @csrf

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
                            <button
                                x-on:click="open = false"
                                type="button"
                                class="btn btn-link link-secondary me-auto"
                            >
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
