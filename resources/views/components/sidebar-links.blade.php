<div class="pt-6">
    <h3 class="text-xl font-bold">Links</h3>

    <div class="grid grid-cols-2 gap-4 mt-2">
        @foreach($links as $link)
            <a href="{{ $link['url'] }}" class="inline-flex items-center gap-2 p-2 text-sm font-bold text-white rounded-lg rounded-tl-none rounded-br-none bg-zinc-800 hover:bg-zinc-700 dark:bg-zinc-800/25 hover:underline dark:hover:bg-zinc-800/50">
                <x-dynamic-component :component="$link['component']" class="w-4 h-4" />
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>
</div>
