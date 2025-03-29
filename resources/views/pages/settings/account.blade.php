<x-layouts.settings>
    @section('page-header')
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Account Settings</h2>
            </div>
        </div>
    @endsection

    <div class="card-body">@livewire('settings.email')</div>
    <div class="card-body">@livewire('settings.password')</div>
    <div class="card-body">@livewire('settings.delete')</div>
</x-layouts.settings>
