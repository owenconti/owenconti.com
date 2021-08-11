<nav class="inline-block space-x-4">
    @foreach($items as $item)
        <a
            href="{{ $item['url'] }}"
            @class([
                'hover:underline',
                'text-gray-900 dark:text-white font-bold' => $item['active'],
                'font-normal text-gray-800 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white' => !$item['active']
            ])
        >{{ $item['label'] }}</a>
    @endforeach
</nav>