@php
$page = $page ?? null;
@endphp
<div class="space-y-2">
    @foreach($categories as $category)
        <div x-data="{ isOpen: {{ $page?->category_slug === $category->slug ? 'true' : 'false' }} }">
            <button @click="isOpen = !isOpen" class="w-full flex justify-between items-center text-left py-1 text-sm font-bold dark:text-gray-100 text-gray-800 rounded-lg rounded-tl-none rounded-br-none dark:hover:text-white hover:text-gray-900">
                <span>{{ $category->title }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" :class="{'rotate-90':isOpen}">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>

            <div x-show="isOpen" x-transition.opacity class="mt-2 ml-2">
                @foreach($category->pages as $categoryPage)
                    <a
                        href="{{ $categoryPage->url }}"
                        @class([
                            'border-l pl-2 py-2 text-sm flex flex-col w-full hover:text-gray-950 hover:border-gray-800 dark:hover:text-gray-100 hover:border-gray-200',
                            'dark:text-gray-100 dark:border-gray-200 text-gray-900 border-gray-600' => $page?->slug === $categoryPage->slug,
                            'dark:text-gray-400 dark:border-gray-500 text-gray-600 border-gray-300' => $page?->slug !== $categoryPage->slug,
                        ])
                    >
                        {{ $categoryPage->title }}
                        <time datetime="2021-08-03" class="text-xs opacity-75">{{ $categoryPage->updated_at->format('M d, Y') }}</time>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
  </div>
