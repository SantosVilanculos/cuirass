<form wire:submit="save">
    <div class="card">
        <!-- <div class="card-header"> -->
        <!--     <h3 class="card-title">Lorem, ipsum</h3> -->
        <!-- </div> -->

        <div class="card-body">
            <div class="space-y">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-label">Name</div>
                        <input wire:model="name" class="form-control" id="name" type="text" autocomplete="name" />
                        @error('name')
                            <p class="invalid-feedback d-block">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex column-gap-2 align-items-center justify-content-end">
                <button wire:loading.class="btn-loading" class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
</form>
