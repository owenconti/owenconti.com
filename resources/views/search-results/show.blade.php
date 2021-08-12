<x-app-layout>
    <h1 class="text-3xl font-bold font-heading">{{ $title }}</h1>

    <div class="mt-8">
      @if($results->count() > 0)
        <x-article-list :articles="$results" />
      @else
        <div>
          <p>We couldn't find any results for that serach term, but check out some of our recent articles:</p>

          <x-article-list class="mt-4" :articles="$recentArticles" />
        </div>
      @endif
    </div>
</x-app-layout>