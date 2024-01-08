<div class="pt-6">
    <h3 class="text-xl font-bold">Categories</h3>

    <div class="flex flex-wrap mt-2">
        @foreach($categories as $category)
            <a href="{{ $category->url }}" class="inline-block px-2 py-1 mb-2 mr-2 text-sm font-bold text-white rounded-lg rounded-tl-none rounded-br-none bg-zinc-800 hover:bg-zinc-700 dark:bg-zinc-800/25 hover:underline dark:hover:bg-zinc-800/50">
                {{ $category->title }} <span class="text-sm font-normal">({{ $category->pages->count() }})</span>
            </a>
        @endforeach
    </div>
  </div>
