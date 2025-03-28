<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

        <link rel="stylesheet" href="{{ asset('vendor/inter/4.1/inter.min.css') }}" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/index.css', 'resources/js/index.js'])
        @endif
    </head>

    <body class="h-full">
        <script>
            /*!
             * Tabler v1.0.0 (https://tabler.io)
             * @version 1.0.0
             * @link https://tabler.io
             * Copyright 2018-2025 The Tabler Authors
             * Copyright 2018-2025 codecalm.net Paweł Kuna
             * Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
             */
            (function (factory) {
                typeof define === 'function' && define.amd ? define(factory) : factory();
            })(function () {
                'use strict';

                var themeStorageKey = 'tablerTheme';
                var defaultTheme = 'light';
                var selectedTheme;
                var params = new Proxy(new URLSearchParams(window.location.search), {
                    get: function get(searchParams, prop) {
                        return searchParams.get(prop);
                    }
                });
                if (!!params.theme) {
                    localStorage.setItem(themeStorageKey, params.theme);
                    selectedTheme = params.theme;
                } else {
                    var storedTheme = localStorage.getItem(themeStorageKey);
                    selectedTheme = storedTheme ? storedTheme : defaultTheme;
                }
                if (selectedTheme === 'dark') {
                    document.body.setAttribute('data-bs-theme', selectedTheme);
                } else {
                    document.body.removeAttribute('data-bs-theme');
                }
            });
        </script>

        <div class="page">
            <header class="navbar navbar-expand-md d-print-none">
                <div class="container-xl">
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbar-menu"
                        aria-controls="navbar-menu"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('favicon.svg') }}" alt="" class="navbar-brand-image" />
                        </a>
                    </div>

                    <div class="navbar-nav flex-row order-md-last">
                        <div class="nav-item d-none d-md-flex me-3">
                            <form action="./" method="get" autocomplete="off" novalidate>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        {{-- search --}}
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
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                    </span>
                                    <input
                                        type="text"
                                        value=""
                                        class="form-control"
                                        placeholder="Search…"
                                        aria-label="Search in website"
                                    />
                                </div>
                            </form>
                        </div>

                        <div class="d-none d-md-flex">
                            <a
                                href="?theme=dark"
                                class="nav-link px-0 hide-theme-dark"
                                title="Enable dark mode"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                            >
                                {{-- moon --}}
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
                                    <path
                                        d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"
                                    />
                                </svg>
                            </a>

                            <a
                                href="?theme=light"
                                class="nav-link px-0 hide-theme-light"
                                title="Enable light mode"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                            >
                                {{-- sun --}}
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
                                    <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path
                                        d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"
                                    />
                                </svg>
                            </a>
                        </div>

                        <div class="nav-item dropdown">
                            <a
                                href="#"
                                class="nav-link d-flex lh-1 text-reset p-0"
                                data-bs-toggle="dropdown"
                                aria-label="Open user menu"
                            >
                                <span class="avatar avatar-sm" style="background-image: url()">
                                    {{ Str::of(Auth::user()->name)->substr(0, 1) }}
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <a
                                    href="{{ route('settings.profile') }}"
                                    @class(['dropdown-item', 'active' => Request::routeIs('settings.*')])
                                >
                                    {{-- settings --}}
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
                                        class="icon dropdown-item-icon"
                                    >
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"
                                        />
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                    </svg>
                                    {{ __('Settings') }}
                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="{{ route('home') }}" class="dropdown-item">
                                    {{-- home --}}
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
                                        class="icon dropdown-item-icon"
                                    >
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>
                                    {{ __('Home') }}
                                </a>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="submit" class="dropdown-item">
                                        {{-- logout --}}
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
                                            class="icon dropdown-item-icon"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"
                                            ></path>
                                            <path d="M9 12h12l-3 -3"></path>
                                            <path d="M18 15l3 -3"></path>
                                        </svg>
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

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
                                                    {{-- dashboard --}}
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
                                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                                    </svg>
                                                </span>
                                                <span class="nav-link-title">Dashboard</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-wrapper">
                @hasSection('page-header')
                    <div class="page-header d-print-none">
                        <div class="container-xl">
                            @yield('page-header')
                        </div>
                    </div>
                @endif

                <div class="page-body">
                    <div class="container-xl">
                        {{ $slot }}
                    </div>
                </div>

                <footer class="footer footer-transparent d-print-none">
                    <div class="container-xl">
                        <div class="row text-center align-items-center flex-row-reverse">
                            <div class="col-lg-auto ms-lg-auto">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">
                                        <a
                                            href="https://github.com/SantosVilanculos/cuirass"
                                            target="_blank"
                                            class="link-secondary"
                                            rel="noopener"
                                        >
                                            Source code
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">
                                        &copy; {{ now()->year }}
                                        <a href="https://github.com/SantosVilanculos" class="link-secondary">
                                            Santos Vilanculos
                                        </a>
                                        . All rights reserved.
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#" class="link-secondary" rel="noopener">v0.1.0</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
