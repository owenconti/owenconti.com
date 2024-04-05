<div>
    <h2>
        <a
            href="{{ $article->url }}"
            class="text-xl font-bold hover:underline text-gray-800 hover:text-gray-700 dark:text-gray-100 dark:hover:text-gray-200"
        >
            {{ $article->title}}
        </a>
    </h2>

    <x-article-metadata :article="$article" />

    @if($article->excerpt)
        <div class="mt-3">
            {!! Str::markdown($article->excerpt) !!}
        </div>
    @endif
</div>
