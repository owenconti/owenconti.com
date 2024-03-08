<x-app-layout>
    <h3 class="text-2xl font-light text-zinc-700 dark:text-zinc-300">Category: <span class="font-bold">{{ $category->title }}</span></h3>

    <div class="mt-6">
        <x-article-list :articles="$category->pages" />
    </div>
</x-app-layout>
