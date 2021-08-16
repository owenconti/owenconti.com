<header v-scope="Header()" class="w-full border-t-4 border-accent">
    <div class="w-full max-w-6xl px-6 mx-auto">
        <div class="flex items-center justify-between py-6 md:justify-between md:space-x-10">
            <a href="/" class="flex items-center justify-between">
                <x-logo class="h-14" />
            </a>

            <div class="flex items-center">
                <div class="-my-2 -mr-2 md:hidden">
                    <button @click="isOpen = !isOpen" type="button" class="inline-flex items-center justify-center p-2 text-gray-600 bg-white rounded-md dark:bg-brand-dark dark:text-gray-400 hover:text-gray-500 dark:hover:text-gray-200 hover:bg-gray-200 dark:hover:bg-brand-dark-lighten focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Open menu</span>
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center h-10 md:h-auto md:p-0">
                    <x-main-navigation class="hidden space-x-6 md:inline-flex" />

                    <x-dark-mode-toggle />
                </div>
            </div>
        </div>
    </div>
</header>