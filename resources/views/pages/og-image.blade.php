<html>

<head>
    @php
        $accentColors = ['#B353FF', '#3B82F6', '#14B8A6', '#FC8800', '#FF1E1E', '#F50A73'];
        $accentColor = collect($accentColors)->random();
    @endphp

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"
        href="https://rsms.me/inter/inter.css">

    @vite(js/app.js)

    <style type="text/css">
        :root {
            --osm-accent: #111827;
        }

    </style>

</head>

<body>
    <div
        class="w-[1200px] h-[632px] relative flex items-center justify-center px-4 text-center text-white border-4 bg-brand-dark border-accent">
        <div>
            <h1 class="px-6 py-3 text-5xl font-bold text-white bg-accent">{{ $title }}</h1>
            @if ($excerpt ?? null)
                <p class="inline-block p-4 mt-8 text-lg text-white border-l-2 border-accent bg-brand-dark-lighten">
                    &ldquo;{{ $excerpt }}&rdquo;</p>
            @endif
        </div>

        @if (isset($category) || isset($date))
            <p class="absolute bottom-0 left-0 mb-4 ml-10 text-xl">
                @if (isset($date))
                    {{ $date }}
                @endif
                @if (isset($date) && isset($category))
                    //
                @endif
                @if (isset($category))
                    #{{ $category }}
                @endif
            </p>
        @endif
        <p class="absolute bottom-0 right-0 mb-4 mr-10 text-xl">owenconti.com</p>
    </div>
</body>

</html>
