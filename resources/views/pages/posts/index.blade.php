<x-two-column-layout>
    <x-article-list :articles="$articles" />

    {{ $articles->onEachSide(5)->links() }}
</x-two-column-layout>

