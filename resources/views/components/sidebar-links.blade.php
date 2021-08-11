<div class="pt-6 mt-6 border-t-4 border-gray-300">
    <h3 class="text-xl font-bold">Links</h3>

    <div class="flex flex-wrap mt-2">
        @foreach($links as $link)
            <a href="{{ $link['url'] }}" class="inline-flex items-center p-2 mb-2 mr-2 text-sm font-bold text-white rounded bg-accent hover:underline">
                <x-dynamic-component :component="$link['component']" class="w-4 h-4 mr-2" />
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>
</div>