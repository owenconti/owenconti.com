<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <x-seo::meta />
        <x-feed-links />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" fetchpriority="high">

        <link rel="icon" href="{{ asset('/favicon.png') }}" type="image/png" />

        <script type="text/javascript">
            let isDarkMode = false;

            determineDarkMode();

            function determineDarkMode() {
              const hasPreference = !!localStorage.darkModeEnabled;
              const preferenceDarkMode = localStorage.darkModeEnabled === 'true';
              const osDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

              isDarkMode = hasPreference ? preferenceDarkMode : osDarkMode;

              document.getElementsByTagName('html')[0].classList.toggle('dark', isDarkMode)
            }

            window.onDarkModeToggle = function () {
              localStorage.darkModeEnabled = isDarkMode ? 'false' : 'true';
              determineDarkMode();
            };
        </script>

        <!-- Scripts -->
        {{ Vite::useBuildDirectory('dist')->withEntryPoints(['resources/js/app.js']) }}
    </head>

    <body class="font-sans text-base antialiased bg-white text-gray-900 dark:bg-gray-950 dark:text-gray-50 transition-colors duration-300">
        <x-header />

        <div class="w-full max-w-6xl px-6 mx-auto mt-6">
            {{ $slot }}
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
