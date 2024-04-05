<footer class="max-w-6xl w-full mx-auto p-6 mt-12 border-t border-gray-200 text-center md:text-left flex gap-4 flex-col-reverse md:flex-row items-center justify-between dark:border-gray-800">
    <div>
        <p class="text-sm text-gray-700 dark:text-gray-500">
            &copy; Owen Conti. All rights reserved.
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-700 mt-1">
            Syntax highlighting provided by <a href="https://torchlight.dev" class="font-bold hover:underline">Torchlight.dev</a>.
        </p>
    </div>

    <div class="flex justify-center gap-6">
        @foreach($nav['links'] as $link)
            <a href="{{ $link['url'] }}" class="text-gray-800 hover:text-gray-700 dark:text-gray-200 dark:hover:text-gray-100">
                <x-dynamic-component :component="$link['component']" class="w-6 h-6" />
            </a>
        @endforeach
    </div>

</footer>
