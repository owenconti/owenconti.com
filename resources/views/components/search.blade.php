<form method="GET" action="/search" {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input type="text" name="query" class="w-full bg-transparent p-2 rounded ring-2 ring-zinc-100 dark:ring-zinc-800/25 focus:ring-4 focus:ring-zinc-200 dark:focus:ring-zinc-800/50 outline-none" placeholder="Search...">
    <button type="submit" class="w-5 h-5 -ml-8 text-zinc-300 hover:text-zinc-400 dark:text-zinc-600 dark:hover:text-zinc-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </button>
</form>
