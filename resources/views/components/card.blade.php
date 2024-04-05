<a href="{{ $card['url'] }}" class="block px-4 py-5 rounded-lg border border-gray-300 bg-transparent text-gray-900 hover:bg-gray-100 hover:border-gray-400 duration-150 hover:shadow-md dark:text-white dark:border-gray-700 hover:dark:bg-gray-900 hover:dark:border-gray-600">
    <x-dynamic-component :component="$card['icon']" class="w-8 h-8" />
    <h3 class="text-lg font-bold mt-4">{{ $card['label'] }}</h3>
    <p>{{ $card['description'] }}</p>
</a>
