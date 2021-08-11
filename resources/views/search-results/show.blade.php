<x-app-layout>
    <h2 class="text-3xl font-bold font-heading">Search Results</h2>

    <div class="mt-8">
      <div>
        @foreach($articles as $article)
          <x-article-summary :article="$article" />
        @endforeach
      </div>
    </div>
</x-app-layout>