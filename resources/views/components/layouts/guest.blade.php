<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48" type="image/x-icon" />
        <link rel="icon" href="{{ asset('favicon.svg') }}" sizes="any" type="image/svg+xml" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        @stack('assets')
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
                    document.documentElement.setAttribute('data-bs-theme', selectedTheme);
                } else {
                    document.documentElement.removeAttribute('data-bs-theme');
                }
            });
        </script>

        {{ $slot }}

        @stack('scripts')
    </body>
</html>
