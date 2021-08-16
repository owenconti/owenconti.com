<div>
    <h2>
        <a
            href="{{ $article->url }}"
            class="text-2xl font-bold hover:underline text-brand-dark hover:text-brand-dark-darken dark:text-brand-light dark:hover:text-brand-light-lighten"
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