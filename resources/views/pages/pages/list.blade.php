<x-app-layout>
    <x-article-list :articles="$pages" />

    {{ $pages->onEachSide(5)->links() }}
</x-app-layout>
