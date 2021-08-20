@if($relatedArticles->count())
  <div {{ $attributes->merge(['class' => 'mt-8']) }}>
    <x-article-list :articles="$relatedArticles" />
  </div>
@endif