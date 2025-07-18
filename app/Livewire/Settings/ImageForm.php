<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ImageForm extends Component
{
    use WithFileUploads;

    public ?TemporaryUploadedFile $image = null;

    public function updatedImage(): void
    {
        $this->save();
    }

    public function save(): void
    {
        /** @var User */
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
            /** @var \Illuminate\Filesystem\FilesystemAdapter */
            $disk = Storage::disk('public');

            $path = $this->image->store(
                $user->getTable(),
                ['disk' => 'public']
            );

            if (is_string($path)) {
                $manager = new ImageManager(Driver::class);
                $manager->read($disk->path($path))
                    ->coverDown(256, 256)
                    ->save();
            }

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
        /**
         * @var User
         */
        $user = Auth::user();

        $this->authorize('update', $user);

        /** @var \Illuminate\Filesystem\FilesystemAdapter */
        $disk = Storage::disk('public');

        if ($disk->fileExists((string) $user->image)) {
            $disk->delete((string) $user->image);
        }

        $user->update(['image' => null]);
        $this->dispatch('user:updated');
        $this->dispatch('message', text: __('Changes saved.'), icon: 'success');
    }

    public function render(): Factory|View
    {
        /** @var User */
        $user = Auth::user();

        return view('livewire.settings.image-form', ['user' => $user]);
    }
}
