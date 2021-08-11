<x-app-layout>
    <h3 class="text-lg font-light text-gray-700 uppercase dark:text-gray-300">{{ $category->title }}</h3>

    <div class="mt-6">
        <x-article-list :articles="$category->pages" />
    </div>
</x-app-layout>