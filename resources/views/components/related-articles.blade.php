@if($relatedArticles->count())
<div class="pt-6">
  <h3 class="text-xl font-bold">Related Articles</h3>
  <div class="space-y-4 mt-2">
    @foreach($relatedArticles as $article)
    <h3>
      <a href="{{ $article->url }}"
        class="text-sm font-medium hover:underline text-zinc-800 hover:text-zinc-700 dark:text-zinc-200 dark:hover:text-zinc-100">
        {{ $article->title}}
      </a>
    </h3>
    @endforeach
  </div>
</div>
@endif
