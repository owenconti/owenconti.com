<x-two-column-layout>
    <h3 class="text-2xl font-light text-gray-700 dark:text-gray-300">Category: <span class="font-bold">{{ $category->title }}</span></h3>

    <div class="mt-6">
        <x-article-list :articles="$category->pages" />
    </div>
</x-two-column-layout>
