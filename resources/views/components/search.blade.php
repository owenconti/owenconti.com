<form method="GET" action="/search" {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input type="text" name="query" class="w-full bg-transparent p-2 rounded ring-2 text-sm ring-gray-200 dark:ring-gray-800/50 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-700/50 outline-none dark:placeholder:text-gray-700" placeholder="Press enter to search..." />

    <button type="submit" class="w-5 h-5 -ml-8 text-gray-300 hover:text-gray-400 dark:text-gray-600 dark:hover:text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </button>
</form>
