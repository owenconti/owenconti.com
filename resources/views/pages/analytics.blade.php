@seo([
    'title' => 'Analytics',
    'image' => 'https://snaps-proxy.owenconti.workers.dev?w=1200&h=632&dpi=2&url=https://owenconti.com/og-image/?data='.base64_encode(json_encode(['title' => 'Analytics']))
])

<x-app-layout>
    <div class="prose">
        <h1>Analytics</h1>

        <div class="mt-8">
            <iframe src="https://app.usefathom.com/share/nophtzsw/owenconti.com" class="w-full h-screen border-none"></iframe>
        </div>
    </div>
</x-app-layout>