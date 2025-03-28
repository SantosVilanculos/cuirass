<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public ?string $name = null;

    public function save(): void
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $this->authorize('update', $user);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'name' => $this->name,
        ]);

        $this->dispatch('message', text: __('Changes saved.'), icon: 'success');
    }

    public function mount(): void
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $this->name = $user->name;
    }

    public function render(): Factory|View
    {
        return view('livewire.settings.profile');
    }
}
