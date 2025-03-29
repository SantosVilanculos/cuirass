<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48" type="image/x-icon" />
        <link rel="icon" href="{{ asset('favicon.svg') }}" sizes="any" type="image/svg+xml" />

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
                            {{-- <img src="{{ asset('favicon.svg') }}" alt="" class="navbar-brand-image" /> --}}
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 40 42"
                                class="navbar-brand-image text-primary"
                            >
                                <path
                                    fill="currentColor"
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M17.2 5.633 8.6.855 0 5.633v26.51l16.2 9 16.2-9v-8.442l7.6-4.223V9.856l-8.6-4.777-8.6 4.777V18.3l-5.6 3.111V5.633ZM38 18.301l-5.6 3.11v-6.157l5.6-3.11V18.3Zm-1.06-7.856-5.54 3.078-5.54-3.079 5.54-3.078 5.54 3.079ZM24.8 18.3v-6.157l5.6 3.111v6.158L24.8 18.3Zm-1 1.732 5.54 3.078-13.14 7.302-5.54-3.078 13.14-7.3v-.002Zm-16.2 7.89 7.6 4.222V38.3L2 30.966V7.92l5.6 3.111v16.892ZM8.6 9.3 3.06 6.222 8.6 3.143l5.54 3.08L8.6 9.3Zm21.8 15.51-13.2 7.334V38.3l13.2-7.334v-6.156ZM9.6 11.034l5.6-3.11v14.6l-5.6 3.11v-14.6Z"
                                ></path>
                            </svg>
                        </a>
                    </div>

                    <div class="navbar-nav flex-row order-md-last">
                        <div class="nav-item d-none d-md-flex me-3">
                            <form action="./" method="GET" autocomplete="off" novalidate>
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
                                            <circle cx="11" cy="11" r="8" />
                                            <path d="m21 21-4.3-4.3" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" />
                                </div>
                            </form>
                        </div>

                        <div class="d-none d-md-flex align-items-center">
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

                            <div class="nav-item dropdown d-none d-md-flex me-3">
                                <a
                                    href="#"
                                    class="nav-link px-0"
                                    data-bs-toggle="dropdown"
                                    tabindex="-1"
                                    aria-label="Show notifications"
                                >
                                    {{-- bell --}}
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
                                            d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"
                                        ></path>
                                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                                    </svg>
                                    <span class="badge bg-red"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Last updates</h3>
                                        </div>
                                        <div class="list-group list-group-flush list-group-hoverable">
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span
                                                            class="status-dot status-dot-animated bg-red d-block"
                                                        ></span>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-body d-block">Example 1</a>
                                                        <div class="d-block text-secondary text-truncate mt-n1">
                                                            Change deprecated html tags to text decoration classes
                                                            (#29604)
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions">
                                                            <!-- Download SVG icon from http://tabler.io/icons/icon/star -->
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
                                                                class="icon text-muted icon-2"
                                                            >
                                                                <path
                                                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"
                                                                ></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="status-dot d-block"></span>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-body d-block">Example 2</a>
                                                        <div class="d-block text-secondary text-truncate mt-n1">
                                                            justify-content:between ⇒ justify-content:space-between
                                                            (#29734)
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions show">
                                                            <!-- Download SVG icon from http://tabler.io/icons/icon/star -->
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
                                                                class="icon text-yellow icon-2"
                                                            >
                                                                <path
                                                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"
                                                                ></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="status-dot d-block"></span>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-body d-block">Example 3</a>
                                                        <div class="d-block text-secondary text-truncate mt-n1">
                                                            Update change-version.js (#29736)
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions">
                                                            <!-- Download SVG icon from http://tabler.io/icons/icon/star -->
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
                                                                class="icon text-muted icon-2"
                                                            >
                                                                <path
                                                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"
                                                                ></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span
                                                            class="status-dot status-dot-animated bg-green d-block"
                                                        ></span>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-body d-block">Example 4</a>
                                                        <div class="d-block text-secondary text-truncate mt-n1">
                                                            Regenerate package-lock.json (#29730)
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions">
                                                            <!-- Download SVG icon from http://tabler.io/icons/icon/star -->
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
                                                                class="icon text-muted icon-2"
                                                            >
                                                                <path
                                                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"
                                                                ></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a
                                href="#"
                                class="nav-link d-flex lh-1 text-reset p-0"
                                data-bs-toggle="dropdown"
                                aria-label="Open user menu"
                            >
                                <span class="avatar avatar-sm" style="background-image: url('')">
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
                                        {{ __('Log out') }}
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
                                                <span class="nav-link-title">Dashboard</span>
                                            </a>
                                        </li>

                                        <li @class(['nav-item', 'active' => Request::routeIs('empty-page')])>
                                            <a class="nav-link" href="{{ route('empty-page') }}">
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
                                            class="link-secondary"
                                            href="https://github.com/SantosVilanculos/cuirass/blob/main/LICENSE"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            License
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a
                                            class="link-secondary"
                                            href="https://github.com/SantosVilanculos/cuirass"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            Source code
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a
                                            class="link-secondary"
                                            href="https://github.com/SantosVilanculos/cuirass/issues"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            Issues
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">
                                        &copy; {{ now()->year }}
                                        <a
                                            href="https://github.com/SantosVilanculos"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="link-secondary"
                                        >
                                            Santos Vilanculos
                                        </a>
                                        . All rights reserved.
                                    </li>

                                    <li class="list-inline-item">
                                        <a
                                            href="https://packagist.org/packages/santosvilanculos/cuirass"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="link-secondary"
                                            rel="noopener"
                                        >
                                            v0.0.0
                                        </a>
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
