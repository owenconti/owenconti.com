<footer class="max-w-6xl w-full mx-auto p-6 mt-12 border-t border-zinc-200 flex items-center justify-between dark:border-zinc-800">
    <p class="text-sm text-center text-zinc-700 dark:text-zinc-500">
        &copy; Owen Conti. All rights reserved.
    </p>

    <div class="flex justify-center gap-6">
        @foreach($nav['links'] as $link)
            <a href="{{ $link['url'] }}" class="text-zinc-800 hover:text-zinc-700 dark:text-zinc-200 dark:hover:text-zinc-100">
                <x-dynamic-component :component="$link['component']" class="w-6 h-6" />
            </a>
        @endforeach
    </div>

</footer>
