<x-app-layout>
    <div class="prose prose-accent">
        <h1>{{ $page->title }}</h1>

        {{ $page->url}}

        {!! Str::markdown($page->content) !!}
    </div>
</x-app-layout>
