<x-app-layout>
    <div class="space-y-12">
        @foreach($categories as $category)
            <div>
                <h3 class="text-base text-gray-700 dark:text-gray-300">
                    <a href="{{ route('show.category', $category) }}" class="hover:underline">
                        {{ $category->title }}
                    </a>
                </h3>

                <div class="mt-6">
                    <x-article-list :articles="$category->pages" />
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>