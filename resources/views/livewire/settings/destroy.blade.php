<div x-data="{ open: false }">
    <div>
        <p class="text-body-secondary">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
            your account, please download any data or information that you wish to retain.
        </p>

        <div class="form-footer">
            <button x-on:click="open = true" class="btn btn-danger" type="button">Delete account</button>
        </div>
    </div>

    @teleport('body')
        <div>
            <div x-cloak x-show="open" class="modal-backdrop show"></div>

            <div x-cloak x-show="open" x-transition:enter.scale.80 x-transition:leave.scale.90 class="modal modal-blur show"
                tabindex="-1" aria-hidden="true">
                <div x-on:click.outside="open = false" class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <form wire:submit="destroy1" class="modal-content">
                        <div class="modal-body">
                            @csrf

                            <div class="modal-title">Are you sure?</div>

                            <p class="text-body-secondary">
                                If you proceed, you will lose all your personal data. Please enter your password to confirm
                                that you would like to permanently delete your personal data.
                            </p>

                            <div class="mb-3">
                                <label for="password" class="form-label">Current password</label>
                                <input wire:model="password" class="form-control" id="password" type="password"
                                    minlength="8" maxlength="20" autocomplete="current-password" required />
                                @error('password')
                                    <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button x-on:click="open = false" type="button" class="btn btn-link link-secondary me-auto">
                                Cancel
                            </button>

                            <button wire:loading.class="btn-loading" type="submit" class="btn btn-danger">Yes, delete all
                                my data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endteleport
</div>
