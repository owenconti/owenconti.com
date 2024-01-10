<footer class="py-8 mt-12 border-t-4 border-zinc-200 dark:border-zinc-800">
    <nav class="px-4 space-x-4 text-center md:spacing-x-8">
        @foreach($nav['main'] as $item)
            <a href="{{ $item['url'] }}" class="text-base text-zinc-800 hover:text-zinc-700 dark:text-zinc-300 dark:hover:text-zinc-100 hover:underline">{{ $item['label'] }}</a>
        @endforeach
    </nav>

    <div class="flex justify-center mt-8 space-x-6">
        @foreach($nav['links'] as $link)
            <a href="{{ $link['url'] }}" class="text-zinc-800 hover:text-zinc-700 dark:text-zinc-200 dark:hover:text-zinc-100">
                <x-dynamic-component :component="$link['component']" class="w-6 h-6" />
            </a>
        @endforeach
    </div>

    <p class="mt-8 text-base text-center text-zinc-700 dark:text-zinc-500">
        &copy; Owen Conti. All rights reserved.
    </p>
</footer>
