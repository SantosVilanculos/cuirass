<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteUserModal extends Component
{
    public ?string $password = null;

    public function destroy(): void
    {
        /** @var \App\Models\User */
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

    public function render(): Factory|View
    {
        return view('livewire.settings.delete-user-modal');
    }
}
