<nav class="hidden space-x-6 md:inline-flex">
    @foreach($items as $item)
        <a
            href="{{ $item['url'] }}"
            @class([
                'hover:underline',
                'text-zinc-900 dark:text-white font-bold' => !!$item['active'],
                'font-normal text-zinc-800 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white' => !$item['active']
            ])
        >{{ $item['label'] }}</a>
    @endforeach
</nav>

<div v-cloak class="inset-x-0 top-0 z-10 px-6 mt-6 transition origin-top-right md:hidden" :class="{ 'fixed' : isOpen , 'hidden' : !isOpen}" >
    <div class="relative bg-white divide-y-2 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 dark:bg-zinc-900 divide-zinc-50 dark:shadow-zinc-800">
        <div class="px-5 pt-5 pb-6">
            <div class="absolute top-0 right-0 mt-3 mr-3">
                <button  @click="isOpen = !isOpen" type="button" class="inline-flex items-center justify-center p-2 text-zinc-600 rounded-md hover:text-zinc-500 hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Close menu</span>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="space-y-4">
                @foreach($items as $item)
                    <a
                        href="{{ $item['url'] }}"
                        class="block text-base text-zinc-700 hover:underline hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-zinc-100"
                    >{{ $item['label'] }}</a>
                @endforeach
            </nav>

            <div class="pt-4 mt-4 border-t border-zinc-300">
                <x-search />
            </div>
        </div>
    </div>
</div>
