<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DeleteUserForm extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        /** @var \App\Models\User */
        $user = Auth::user();

        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        $user->delete();

        $this->redirect('/', navigate: true);
    }
}
