<html>

<head>
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"
        href="https://rsms.me/inter/inter.css">

    {{ Vite::useBuildDirectory('dist')->withEntryPoints(['resources/js/app.js']) }}
</head>

<body>
    <div
        class="w-[1200px] h-[632px] relative flex items-center justify-center px-4 text-center text-white border-4 bg-zinc-900">
        <div>
            <h1 class="px-6 py-4 text-5xl font-bold text-white bg-zinc-800 leading-normal rounded-3xl rounded-tl-none rounded-br-none">{{ $title }}</h1>
            @if ($excerpt ?? null)
                <p class="inline-block p-4 mt-8 text-lg text-white border-l-4 border-zinc-700 bg-zinc-800">{{ $excerpt }}</p>
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
