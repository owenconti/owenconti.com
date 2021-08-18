<x-app-layout>
    <div>
        <h1 class="text-4xl font-bold">{{ $page->title }}</h1>
        <x-article-metadata :article="$page" class="mt-2" />
    </div>

    <div class="mt-8 prose prose-accent">
        {!! $content !!}
        
        @if($page->video)
            <div id="video" class="my-8" style="position:relative;padding-top:56.25%;">
                <iframe src="https://www.youtube-nocookie.com/embed/{{ $page->video }}" class="absolute top-0 bottom-0 left-0 right-0 w-full h-full"></iframe>
            </div>
        @endif

        <hr/>

        <h3>Thanks for reading this article!</h3>

        <p>Hopefully you found this article useful! If you did, share it on Twitter!</p>

        <div class="flex flex-wrap items-center space-x-4">
            <a
                href="https://twitter.com/share?ref_src=twsrc%5Etfw"
                class="twitter-share-button"
                data-size="large"
                data-related="owenconti"
                data-show-count="false"
                data-text="{{ $page->title }} by @owenconti"
            >Share this article on Twitter</a>
            
            <a href="https://twitter.com/owenconti?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-size="large" data-show-count="false">Follow @owenconti</a>

            <a href="https://twitter.com/messages/compose?recipient_id=40687266&ref_src=twsrc%5Etfw" class="twitter-dm-button" data-size="large" data-screen-name="owenconti" data-show-count="false">Message @owenconti</a>

            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div>
</x-app-layout>
