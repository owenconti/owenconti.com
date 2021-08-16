<footer class="py-8 mt-12 border-t-4 border-accent">
    <nav class="px-4 space-x-4 text-center md:spacing-x-8">
        @foreach($nav['main'] as $item)
            <a href="{{ $item['url'] }}" class="text-base font-bold text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100 hover:underline">{{ $item['label'] }}</a>
        @endforeach
    </nav>

    <div class="flex justify-center mt-8 space-x-6">
        @foreach($nav['links'] as $link)
            <a href="{{ $link['url'] }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100">
                <x-dynamic-component :component="$link['component']" class="w-6 h-6" />
            </a>
        @endforeach
    </div>

    <p class="mt-8 text-base text-center text-gray-700 dark:text-gray-400">
        &copy; Owen Conti. All rights reserved.
    </p>

    @env('production')
        <script src="https://albatross.ohseesoftware.com/script.js" site="NOPHTZSW" defer></script>
    @endenv
</footer>