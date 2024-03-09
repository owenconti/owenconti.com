<a href="{{ $card['url'] }}" class="block px-4 py-5 rounded-lg border border-zinc-300 bg-transparent text-zinc-900 hover:bg-zinc-100 hover:border-zinc-400 duration-150 hover:shadow-md dark:text-white dark:border-zinc-700 hover:dark:bg-zinc-900 hover:dark:border-zinc-600">
    <x-dynamic-component :component="$card['icon']" class="w-8 h-8" />
    <h3 class="text-lg font-bold mt-4">{{ $card['label'] }}</h3>
    <p>{{ $card['description'] }}</p>
</a>
