@if($relatedArticles->count())
<div class="mt-8">
  <h3 class="text-xl font-bold">Related Articles</h3>
  <div class="space-y-4 mt-2">
    @foreach($relatedArticles as $article)
    <h3>
      <a href="{{ $article->url }}"
        class="text-sm font-medium hover:underline text-brand-dark-lighten hover:text-brand-dark-darken dark:text-brand-light dark:hover:text-brand-light-lighten">
        {{ $article->title}}
      </a>
    </h3>
    @endforeach
  </div>
</div>
@endif
