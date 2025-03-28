<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Password extends Component
{
    public ?string $current_password = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $this->authorize('update', $user);

        $this->validate([
            'current_password' => ['required', 'string', 'current_password', 'exclude'],
            'password' => ['required', 'string', Rules\Password::defaults(), 'confirmed'],
        ]);

        if (Hash::check((string) $this->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => __('The new password can\'t be the same as the current password.'),
            ]);
        }

        $user->update(['password' => Hash::make((string) $this->password)]);

        Auth::logoutOtherDevices((string) $this->password);

        $this->reset();
        $this->dispatch('message', text: __('passwords.reset'), icon: 'success');
    }

    public function render(): Factory|View
    {
        return view('livewire.settings.password');
    }
}
