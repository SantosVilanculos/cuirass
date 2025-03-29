<form wire:submit="save" class="h-100 d-flex flex-column">
    <div class="card-body flex-grow-1">
        <h2 class="mb-4 card-title">My Profile</h2>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-label">Name</div>
                <input wire:model="name" class="form-control" id="name" type="text" autocomplete="name" />
                @error('name')
                    <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="card-footer bg-transparent mt-auto">
        <div class="btn-list justify-content-between">
            <button wire:loading.class="btn-loading" class="btn btn-primary" type="submit">Update profile</button>
            <a href="{{ route('settings.account.photo') }}" class="btn btn-link">Need to edit your avatar?</a>
        </div>
    </div>
</form>
