<div>
    @foreach($articles as $article)
        <x-article-summary :article="$article" />
    @endforeach
</div>