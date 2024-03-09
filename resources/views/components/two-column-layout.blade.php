<x-app-layout>
    <div class="flex">
        <div class="hidden w-64 lg:w-full lg:max-w-xs lg:block">
            <x-sidebar />
        </div>

        <div class="flex-1 w-0 max-w-full lg:pl-20">
            {{ $slot }}
        </div>
    </div>
</x-app-layout>
