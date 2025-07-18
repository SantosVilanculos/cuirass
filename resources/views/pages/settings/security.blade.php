<x-layouts.settings>
    @section('page-header')
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Profile</h2>
            </div>
        </div>
    @endsection

    <div class="card" id="pills-home">
        <!-- <div class="card-header"> -->
        <!--     <h3 class="card-title">Lorem, ipsum</h3> -->
        <!-- </div> -->

        <div class="card-body">
            <div class="space-y">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <p class="text-body-secondary">You can change your password here.</p>
                        @livewire('settings.password-modal')
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="space-y">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <p class="text-body-secondary">
                            Deleting your user will permanently delete all user data. You should download any data that
                            you wish to retain.
                        </p>
                        @livewire('settings.delete-user-modal')
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card-footer"> -->
        <!--     <div class="d-flex column-gap-2 align-items-center justify-content-between"> -->
        <!--         <p class="mb-0">Lorem, ipsum</p> -->
        <!--     </div> -->
        <!-- </div> -->
    </div>
</x-layouts.settings>
