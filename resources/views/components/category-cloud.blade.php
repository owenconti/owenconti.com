<div class="pt-6 mt-6 border-t-4 border-gray-300">
    <h3 class="text-xl font-bold">Categories</h3>

    <div class="flex flex-wrap mt-2">
        @foreach($categories as $category)
            <a href="{{ $category->url }}" class="inline-block px-2 py-1 mb-2 mr-2 text-sm font-bold text-white rounded rounded-tl-none rounded-br-none bg-accent hover:underline">
                {{ $category->title }} <span class="text-sm font-normal">({{ $category->pages->count() }})</span>
            </a>
        @endforeach
    </div>
  </div>