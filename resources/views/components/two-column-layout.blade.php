<x-app-layout>
    <div class="flex justify-between gap-8">
        <div class="hidden w-48 lg:w-64 md:block flex-shrink-0">
            <x-sidebar />
        </div>

        <div class="flex-1 max-w-2xl w-full mx-auto min-w-0">
            {{ $slot }}
        </div>
    </div>
</x-app-layout>
