<x-layouts.settings>
    @section('page-header')
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Account Photo</h2>
            </div>
        </div>
    @endsection

    <div class="card-body">@livewire('settings.photo')</div>
</x-layouts.settings>
