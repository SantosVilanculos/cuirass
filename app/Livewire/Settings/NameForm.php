<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Livewire\Component;

class NameForm extends Component
{
    public ?string $name = null;

    public function save(): void
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $this->authorize('update', $user);

        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
        ]);

        $user->update([
            'name' => $this->name,
        ]);

        $this->dispatch('user:updated');
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
        return view('livewire.settings.name-form');
    }
}
