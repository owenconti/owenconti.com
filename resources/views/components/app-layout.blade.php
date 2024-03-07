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

        <link rel="icon" href="{{ asset('/favicon.svg') }}" sizes="any" type="image/svg+xml" />
        <link rel="icon" href="{{ asset('/favicon.png') }}" type="image/png" />

        <script type="text/javascript">
            let isDarkMode = false;

            determineDarkMode();

            function determineDarkMode() {
              const hasPreference = !!localStorage.darkModeEnabled;
              const preferenceDarkMode = localStorage.darkModeEnabled === 'true';
              const osDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

              isDarkMode = hasPreference ? preferenceDarkMode : osDarkMode;

              const $html = document.getElementsByTagName('html')[0];

              if (isDarkMode) {
                $html.classList.add('dark');
              } else {
                $html.classList.remove('dark');
              }
            }

            window.onDarkModeToggle = function () {
              if (isDarkMode) {
                localStorage.darkModeEnabled = 'false';
              } else {
                localStorage.darkModeEnabled = 'true';
              }

              determineDarkMode();
            };

            window.addEventListener('DOMContentLoaded', () => {
                document.getElementsByTagName('body')[0].classList.remove('hidden');
            });
        </script>

        <!-- Scripts -->
        {{ Vite::useBuildDirectory('dist')->withEntryPoints(['resources/js/app.js']) }}
    </head>

    <body class="font-sans text-base antialiased bg-white text-zinc-900 dark:bg-zinc-900 dark:text-zinc-50 transition-colors duration-300 hidden">
        <x-header />

        <div class="flex w-full max-w-6xl px-6 mx-auto mt-6">
            <div class="hidden w-64 lg:w-full lg:max-w-xs lg:block">
                <x-sidebar />
            </div>

            <div class="flex-1 w-0 max-w-full lg:pl-20">
                {{ $slot }}
            </div>
        </div>

        <x-footer />

        @env('production')
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-FKK5TT3852"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
              gtag('config', 'G-FKK5TT3852');
            </script>
        @endenv
    </body>
</html>
