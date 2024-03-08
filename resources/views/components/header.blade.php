<header x-data="{ isOpen: false }" class="w-full border-t-4 border-zinc-900">
    <div class="w-full max-w-6xl px-6 mx-auto">
        <div class="flex items-center justify-between py-6 md:justify-between md:space-x-10 gap-8">
            <a href="/" class="flex items-center justify-between">
                <x-logo class="h-9" />
            </a>

            <x-search class="flex-1 max-w-sm hidden md:flex" />

            <div class="flex items-center gap-2">
                <div class="-my-2 -mr-2 hidden">
                    <x-button @click="isOpen = !isOpen">
                        <span class="sr-only">Open menu</span>
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </x-button>
                </div>

                <div class="flex items-center gap-2 h-10 md:h-auto md:p-0">
                    <x-dark-mode-toggle />
                </div>
            </div>
        </div>
    </div>
</header>
