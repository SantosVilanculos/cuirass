<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component {
    public ?string $name = null;

    public function save(): void
    {
        /** @var User $user */
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
        /** @var User $user */
        $user = Auth::user();

        $this->name = $user->name;
    }
};
?>

<form wire:submit="save">
    <div class="card">
        <!-- <div class="card-header"> -->
        <!--     <h3 class="card-title">Lorem, ipsum</h3> -->
        <!-- </div> -->

        <div class="card-body">
            <div class="space-y">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-label">Name</div>
                        <input wire:model="name" class="form-control" id="name" type="text" autocomplete="name" />
                        @error('name')
                            <p class="invalid-feedback d-block">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex column-gap-2 align-items-center justify-content-end">
                <button wire:loading.class="btn-loading" class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
</form>
