<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DeleteUserModal extends Component
{
    public ?string $password = null;

    public function destroy1(): void
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

        $user->delete();

        $this->redirectRoute('login', navigate: true);
    }

    public function render(): Factory|View
    {
        return view('livewire.settings.delete-user-modal');
    }
}
