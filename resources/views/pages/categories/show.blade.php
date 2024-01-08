<x-app-layout>
    <h3 class="text-2xl font-light text-zinc-700 lowercase dark:text-zinc-300">{{ strtolower($category->title) }}</h3>

    <div class="mt-6">
        <x-article-list :articles="$category->pages" />
    </div>
</x-app-layout>
