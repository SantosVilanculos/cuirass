<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Email extends Component
{
    public ?string $email = null;

    public function save(): void
    {
        /** @var User */
        $user = Auth::user();

        $this->authorize('update', $user);

        $this->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:254', Rule::unique(User::class)->ignoreModel($user)],
        ]);

        $user->fill([
            'email' => $this->email,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($user->wasChanged('email') && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail) {
            $user->sendEmailVerificationNotification();
        }

        $this->dispatch('message', text: __('Changes saved.'), icon: 'success');
    }

    public function sendEmailVerificationNotification(): void
    {
        /** @var User */
        $user = Auth::user();

        if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }

        $this->dispatch('message', text: __('A new verification link has been sent to your email address.'), icon: 'success');
    }

    public function mount(): void
    {
        /** @var User */
        $user = Auth::user();

        $this->email = $user->email;
    }

    public function render(): Factory|View
    {
        /** @var User */
        $user = Auth::user();

        return view('livewire.settings.email', ['user' => $user]);
    }
}
