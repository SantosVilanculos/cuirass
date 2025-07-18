<x-layouts.settings>
    @section('page-header')
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Profile</h2>
            </div>
        </div>
    @endsection

    @livewire('settings.image-form')
    @livewire('settings.name-form')
    @livewire('settings.email-form')
</x-layouts.settings>
