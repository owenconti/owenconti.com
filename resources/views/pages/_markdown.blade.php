<x-two-column-layout>
    <div>
        <h1 class="text-4xl font-bold">{{ $page->title }}</h1>
        <x-article-metadata :article="$page" class="mt-2" />
    </div>

    <div class="mt-8 prose prose-zinc-800 dark:prose-zinc-100">
        {!! $content !!}

        @if($page->video)
            <div id="video" class="my-8" style="position:relative;padding-top:56.25%;">
                <iframe src="https://www.youtube-nocookie.com/embed/{{ $page->video }}" class="absolute top-0 bottom-0 left-0 right-0 w-full h-full"></iframe>
            </div>
        @endif

        <hr class="my-8 border-t-0 border-b border-zinc-200 dark:border-zinc-700" />

        <h3 class="text-lg font-bold">Thanks for reading this article!</h3>
        <p>Hopefully you found this article useful! If you did, share it on Twitter!</p>
        <div class="flex flex-wrap items-center gap-2">
            <a
                class="bg-zinc-950 !text-white dark:bg-white dark:!text-zinc-950 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-1 !no-underline hover:bg-zinc-900 dark:hover:bg-zinc-100"
                href="https://twitter.com/intent/post?related=owenconti&text={{ urlencode($page->title) }}%20by%20%40owenconti&url={{ urlencode(url()->current()) }}"
                target="_blank"
            >
                <x-twitter-icon class="w-4 h-4" /> Share this post
            </a>
            <a
                class="bg-zinc-950 !text-white dark:bg-white dark:!text-zinc-950 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-1 !no-underline hover:bg-zinc-900 dark:hover:bg-zinc-100"
                href="https://twitter.com/intent/follow?region=follow_link&screen_name=owenconti"
                target="_blank"
            >
                <x-twitter-icon class="w-4 h-4" /> Follow @owenconti
            </a>
        </div>

        <p>Found an issue with the article? <a href="https://github.com/owenconti/owenconti.com/blob/main/content/pages/{{ substr($page->slug, strrpos($page->slug, '/') + 1) }}.md">Submit your edits</a> against the repository.</p>
    </div>
</x-two-column-layout>
