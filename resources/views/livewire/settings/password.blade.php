<form wire:submit="save">
    <div class="row mb-3">
        <div class="col-md-6">
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
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label" for="password">New password</label>
            <small class="form-hint">
                Your password must be 8-20 characters long. Don't use a password form another site, or something too
                obvious like your pet's name.
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
    </div>

    <div class="row">
        <div class="col-md-6">
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

    <div class="form-footer">
        <div class="btn-list justify-content-start">
            <button wire:loading.class="btn-loading" class="btn btn-primary" type="submit">Save</button>
            {{-- <button wire:dirty class="btn" wire:click="">Reset</button> --}}
        </div>
    </div>
</form>
