<form wire:submit="save">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label" for="name">Name</label>
            <input wire:model="name" class="form-control" id="name" type="text" autocomplete="name" />
            @error('name')
                <p class="invalid-feedback d-block">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-footer">
        <button wire:loading.class="btn-loading" class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
