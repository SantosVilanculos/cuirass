<x-layouts::settings>
    @section('page-header')
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Profile</h2>
            </div>
        </div>
    @endsection

    @livewire('update-user-image-form')
    @livewire('update-user-name-form')
    @livewire('update-user-email-form')
    </x-layouts.settings>
