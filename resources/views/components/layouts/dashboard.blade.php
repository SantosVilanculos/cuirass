<x-layouts.app>
    @section('navbar')
        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar">
                    <div class="container-xl">
                        <div class="row flex-fill align-items-center">
                            <div class="col">
                                <ul class="navbar-nav">
                                    <li @class(['nav-item', 'active' => Request::routeIs('dashboard')])>
                                        <a class="nav-link" href="{{ route('dashboard') }}">
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                {{-- chart-line --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon"
                                                >
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 19l16 0" />
                                                    <path d="M4 15l4 -6l4 2l4 -5l4 4" />
                                                </svg>
                                            </span>
                                            <span class="nav-link-title">Overview</span>
                                        </a>
                                    </li>

                                    <li @class(['nav-item', 'active' => Request::routeIs('dashboard.empty-page')])>
                                        <a class="nav-link" href="{{ route('dashboard.empty-page') }}">
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                {{-- file --}}
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-1"
                                                >
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path
                                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"
                                                    />
                                                </svg>
                                            </span>

                                            <span class="nav-link-title">Empty page</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endsection

    {{ $slot }}
</x-layouts.app>
