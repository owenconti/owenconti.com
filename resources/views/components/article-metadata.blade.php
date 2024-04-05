<div {{ $attributes->merge(['class' => 'mt-1 text-sm text-gray-500 flex items-center dark:text-gray-400']) }}>
    <p>
        Posted on
        <time datetime="{{ $article->updated_at->format('Y-m-d') }}">{{ $article->updated_at->format('M d, Y') }}</time>
        @if($article->category)
            under <a href="{{ $article->category->url }}" class="font-bold text-gray-800 dark:text-white hover:underline">{{ $article->category->title }}</a>
        @endif
        by <a href="https://owenconti.com" class="font-bold text-gray-800 dark:text-white hover:underline">Owen Conti</a>.
    </p>

    @if ($article->video)
        <a title="Skip to the video" href="{{ $article->url }}#video">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
        </a>
    @endif
</div>
