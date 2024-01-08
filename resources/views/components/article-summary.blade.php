<div>
    <h2>
        <a
            href="{{ $article->url }}"
            class="text-xl font-bold hover:underline text-zinc-800 hover:text-zinc-700 dark:text-zinc-100 dark:hover:text-zinc-200"
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
