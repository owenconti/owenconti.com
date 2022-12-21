<x-app-layout>
    <h3 class="text-lg font-light text-gray-700 lowercase dark:text-gray-300">{{ strtolower($category->title) }}</h3>

    <div class="mt-6">
        <x-article-list :articles="$category->pages" />
    </div>
</x-app-layout>
