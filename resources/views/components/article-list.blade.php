<div {{ $attributes->merge(['class' => 'space-y-8']) }}>
    @foreach($articles as $article)
        <x-article-summary :article="$article" />
    @endforeach
</div>
