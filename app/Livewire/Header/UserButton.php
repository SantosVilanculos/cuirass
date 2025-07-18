<?php

declare(strict_types=1);

namespace App\Livewire\Header;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('user:updated')]
class UserButton extends Component
{
    public function logout(): void
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        $this->redirect('/');
    }

    public function render(): Factory|View
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        return view('livewire.header.user-button', ['user' => $user]);
    }
}
