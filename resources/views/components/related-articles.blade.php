@if($relatedArticles->count())
<div class="pt-6">
  <h3 class="text-xl font-bold">Related Articles</h3>
  <div class="space-y-4 mt-2">
    @foreach($relatedArticles as $article)
    <h3>
      <a href="{{ $article->url }}"
        class="text-sm font-medium hover:underline text-gray-800 hover:text-gray-700 dark:text-gray-200 dark:hover:text-gray-100">
        {{ $article->title}}
      </a>
    </h3>
    @endforeach
  </div>
</div>
@endif
