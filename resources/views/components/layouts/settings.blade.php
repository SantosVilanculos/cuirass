<x-layouts.app>
    <div class="card">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <h4 class="subheader">Account</h4>
                    <div class="list-group list-group-transparent">
                        <a
                            href="{{ route('settings.account') }}"
                            @class(['list-group-item list-group-item-action d-flex align-items-center', 'active' => Request::routeIs('settings.account')])
                        >
                            Account Credentials
                        </a>

                        <a
                            href="{{ route('settings.account.profile') }}"
                            @class(['list-group-item list-group-item-action d-flex align-items-center', 'active' => Request::routeIs('settings.account.profile', 'settings.account.photo')])
                        >
                            Account Profile
                        </a>

                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            Site Preferences
                        </a>

                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            Notifications
                        </a>
                    </div>
                    <h4 class="subheader mt-4">Billing</h4>
                    <div class="list-group list-group-transparent">
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            Manage Subscription
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            Invoices
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-9 d-flex flex-column">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.app>
