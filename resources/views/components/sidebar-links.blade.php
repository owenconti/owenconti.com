<div {{ $attributes->merge(['class' => 'flex flex-col lg:flex-row flex-wrap gap-2']) }}>
    @foreach($links as $link)
        <a href="{{ $link['url'] }}" class="w-full flex-1 lg:flex-grow-0 flex lg:inline-flex items-center gap-2 py-2 px-3 text-sm font-bold text-white rounded-lg rounded-tl-none rounded-br-none bg-gray-800 hover:bg-gray-700 dark:text-gray-800 dark:bg-gray-50 hover:underline dark:hover:bg-gray-200">
            <x-dynamic-component :component="$link['component']" class="w-4 h-4" />
            {{ $link['label'] }}
        </a>
    @endforeach
</div>
