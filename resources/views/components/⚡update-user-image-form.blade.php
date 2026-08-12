<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public ?TemporaryUploadedFile $image = null;

    public function updatedImage(): void
    {
        $this->save();
    }

    public function save(): void
    {
        /** @var User $disk */
        $user = Auth::user();

        $this->authorize('update', $user);

        $this->validate([
            'image' => [
                'required',
                File::types(['image/jpeg', 'image/png'])
                    ->extensions(['jpg', 'jpeg', 'jpe', 'jif', 'jfif', 'jfi', 'png'])
                    ->max(2048),
                Rule::dimensions()
                    ->minWidth(192)
                    ->minHeight(192),
            ],
        ]);

        if ($this->image instanceof TemporaryUploadedFile) {
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk = Storage::disk('public');

            $path = Image::fromUpload($this->image)
                ->cover(400, 400)
                ->storeAs(path: $user->getTable(), name: $this->image->hashName(), disk: 'public');

            if (is_string($path) && $disk->fileExists((string) $user->image)) {
                $disk->delete((string) $user->image);
                $user->image = null;
            }

            if (is_string($path)) {
                $user->update(['image' => $path]);
            }
        }

        $this->reset();
        $this->dispatch('user:updated');
        $this->dispatch('message', text: __('Changes saved.'), icon: 'success');
    }

    public function destroy(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->authorize('update', $user);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        if ($disk->fileExists((string) $user->image)) {
            $disk->delete((string) $user->image);
        }

        $user->update(['image' => null]);
        $this->dispatch('user:updated');
        $this->dispatch('message', text: __('Changes saved.'), icon: 'success');
    }
};
?>

<div x-data class="card">
    <!-- <div class="card-header"> -->
    <!--     <h3 class="card-title">Lorem, ipsum</h3> -->
    <!-- </div> -->

    <div class="card-body">
        <div class="space-y">
            <div class="row align-items-center">
                <div class="col-auto">
                    @isset(Auth::user()->image)
                        <span
                            class="avatar avatar-xl"
                            style="background-image: url({{ Storage::disk('public')->url(Auth::user()->image) }})"
                        ></span>
                    @else
                        <span class="avatar avatar-xl"> {{ Str::of(Auth::user()->name)->substr(0, 1) }} </span>
                    @endisset
                </div>
                <input
                    wire:model.live="image"
                    x-ref="input"
                    style="display: none"
                    type="file"
                    accept="image/png,image/jpeg"
                />
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
                @isset(Auth::user()->image)
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
        </div>
    </div>

    <div class="card-footer">
        <div class="d-flex column-gap-2 align-items-center justify-content-between">
            <p class="mb-0 text-body-secondary">It's recommended that you use a square picture that's at least 192x192 pixels and 2 MB or less. Use a PNG or JPG file.</p>
        </div>
    </div>
</div>
