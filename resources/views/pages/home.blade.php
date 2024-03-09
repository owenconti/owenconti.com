<x-app-layout>
    <div class="flex flex-wrap items-center gap-12 flex-1 py-20">
        <div class="flex-1">
            <div class="prose">
                <h1>Hi, I'm Owen!</h1>
                <p>I build applications for the web, with a focus on rapid iteration.</p>
            </div>
            <div class="mt-6">
                <x-hero-button as="a" href="/articles">Read my articles</x-hero-button>
            </div>
        </div>
        <div class="prose max-w-xl">
            <div class="font-mono text-base dark:text-white text-zinc-700 bg-white rounded-t-lg px-4 py-2 border border-zinc-300 dark:border-zinc-800 z-10 relative dark:bg-black -mb-1">My Tech Stack</div>
            <pre class="m-0"><x-torchlight-code language='javascript'>
                function backend() {
                  return ['laravel', 'php', 'hybridly', 'postgres', 'redis'];
                }
                function frontend() {
                  return ['tailwindcss', 'vuejs', 'reactjs'];
                }
                function services() {
                  return ['aws', 'cloudflare', 'docker', 'github', 'git'];
                }
            </x-torchlight-code></pre>
        </div>
    </div>

    <div class="mt-32 space-y-12">
        <h2 class="text-4xl font-bold dark:text-white text-zinc-900 text-center">My content on the web</h2>

        <div class="grid md:grid-cols-2 gap-8">
            @foreach($cards as $card)
                <x-card :card="$card" />
            @endforeach
        </div>
    </div>

    <div class="mt-32 space-y-12">
        <h2 class="text-4xl font-bold dark:text-white text-zinc-900 text-center">Recent articles</h2>

        <div class="space-y-8 mx-auto max-w-lg">
            @foreach($articles as $article)
                <x-article-summary :article="$article" />
            @endforeach
        </div>
    </div>
</x-app-layout>
