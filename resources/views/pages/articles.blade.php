<x-two-column-layout>
    <x-article-list :articles="$pages" />

    {{ $pages->onEachSide(5)->links() }}
</x-two-column-layout>
