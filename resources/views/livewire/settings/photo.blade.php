<form x-data enctype="multipart/form-data">
    <h3 class="mb-4 card-title">Update Your Avatar</h3>
    <p class="card-subtitle">
        It's recommended that you use a square picture that's at least 192x192 pixels and 2 MB or less. Use a PNG or JPG
        file.
    </p>
    <div class="row align-items-center">
        <div class="col-auto">
            @isset($user->image)
                <span
                    class="avatar avatar-xl"
                    style="background-image: url({{ Storage::disk('public')->url($user->image) }})"
                ></span>
            @else
                <span class="avatar avatar-xl">
                    {{ Str::of(Auth::user()->name)->substr(0, 1) }}
                </span>
            @endisset
        </div>
        <input wire:model="image" x-ref="input" style="display: none" type="file" accept="image/png,image/jpeg" />
        <div class="col-auto">
            <button
                wire:loading.class="btn-loading"
                wire:target="image"
                x-on:click="$refs.input.click()"
                class="btn"
                type="submit"
            >
                Change avatar
            </button>
        </div>
        @isset($user->image)
            <div class="col-auto">
                <button
                    wire:click="destroy"
                    wire:loading.class="btn-loading"
                    wire:target="destroy"
                    class="btn btn-ghost-danger"
                    type="button"
                >
                    Delete avatar
                </button>
            </div>
        @endisset
    </div>
    @error('image')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</form>
