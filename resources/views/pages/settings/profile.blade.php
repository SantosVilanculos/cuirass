<x-layouts.app>
    @section('page-header')
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Account Settings</h2>
            </div>
        </div>
    @endsection

    <div class="row gy-4 gy-md-0 gx-md-4 gx-lg-5">
        <div class="col-12 col-md-4 col-lg-3">
            <ul class="nav nav-pills nav-vertical">
                <li class="nav-item">
                    <a href="" @class(['nav-link', 'active' => Request::routeIs('settings.profile')])>Profile</a>
                </li>

                <li class="nav-item">
                    <a href="#menu-0" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
                        Lorem ipsum
                        <span class="nav-link-toggle"></span>
                    </a>

                    <ul class="nav nav-pills collapse" id="menu-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#menu-1" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
                        Lorem ipsum
                        <span class="nav-link-toggle"></span>
                    </a>

                    <ul class="nav nav-pills collapse" id="menu-1">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-12 col-md-8 col-lg-9">
            @livewire('settings.profile')

            <div class="hr"></div>

            @livewire('settings.email')

            <div class="hr"></div>

            @livewire('settings.password')

            <div class="hr"></div>

            @livewire('settings.destroy')
        </div>
    </div>
</x-layouts.app>
