@if($relatedArticles->count())
  <div class="mt-8">
    <x-article-list :articles="$relatedArticles" />
  </div>
@endif