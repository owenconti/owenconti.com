<div>
    <h2>
        <a
            href="{{ $article->url }}"
            class="text-3xl font-bold hover:underline text-brand-dark hover:text-brand-dark-darken dark:text-brand-light dark:hover:text-brand-light-lighten"
        >
            {{ $article->title}}
        </a>
    </h2>
    
    <p class="mt-2 text-sm text-gray-700 uppercase dark:text-gray-300">
        <time datetime="2021-08-03">{{ $article->updated_at->format('M d, Y') }}</time>
        under <a href="{{ $article->category->url }}" class="font-bold text-gray-800 dark:text-white hover:underline">{{ $article->category->title }}</a>
    </p>

    @if($article->excerpt)
        <div class="mt-3">
            {!! Str::markdown($article->excerpt) !!}
        </div>
    @endif
</div>