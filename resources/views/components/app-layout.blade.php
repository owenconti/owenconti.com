@php
  $accentColors = ['#B353FF', '#3B82F6', '#14B8A6', '#FC8800', '#FF1E1E', '#F50A73'];
  $accentColor = collect($accentColors)->random();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <x-seo::meta />
        <x-feed-links />

        <!-- Fonts -->
        <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://rsms.me/inter/inter.css">

        <link rel="icon" href="{{ asset('/dist/favicon.svg') }}" sizes="any" type="image/svg+xml" />
        <link rel="icon" href="{{ asset('/dist/favicon.png') }}" type="image/png" />

        <!-- Scripts -->
        @vite(js/app.js)

        <style type="text/css">
        :root {
            --osm-accent: {{ $accentColor }};
        }
        </style>
    </head>
    <body class="font-sans text-base antialiased bg-white text-dark dark:bg-brand-dark-darken dark:text-brand-light">
        <x-header />

        <div class="flex w-full max-w-6xl px-6 mx-auto mt-6">
            <div class="hidden w-64 lg:w-full lg:max-w-xs md:block">
                <x-sidebar />
            </div>

            <div class="flex-1 w-0 max-w-full md:pl-20">
                {{ $slot }}
            </div>
        </div>

        <x-footer />
    </body>
</html>
