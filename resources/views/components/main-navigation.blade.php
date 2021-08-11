<nav class="hidden space-x-6 md:inline-flex">
    @foreach($items as $item)
        <a
            href="{{ $item['url'] }}"
            @class([
                'hover:underline',
                'text-gray-900 dark:text-white font-bold' => $item['active'],
                'font-normal text-gray-800 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white' => !$item['active']
            ])
        >{{ $item['label'] }}</a>
    @endforeach
</nav>

<div v-if="isOpen" class="fixed inset-0 bg-transparent" @click="isOpen = false"></div>
<div v-cloak class="inset-x-0 top-0 z-10 mt-6 transition origin-top-right transform md:hidden" :class="{ 'absolute' : isOpen , 'hidden' : !isOpen}" >
    <div class="relative bg-white divide-y-2 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 dark:bg-brand-dark divide-gray-50">
        <div class="px-5 pt-5 pb-6">
            <div class="absolute top-0 right-0 mt-3 mr-3">
                <button  @click="isOpen = !isOpen" type="button" class="inline-flex items-center justify-center p-2 text-gray-600 rounded-md hover:text-gray-500 hover:bg-gray-200 dark:hover:bg-brand-dark-lighten focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
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
                        class="block text-base text-gray-700 hover:underline hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100"
                    >{{ $item['label'] }}</a>
                @endforeach
            </nav>

            <div class="pt-4 mt-4 border-t border-gray-300">
                <x-search />
            </div>
        </div>
    </div>
</div>