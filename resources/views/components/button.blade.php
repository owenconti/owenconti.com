@props(['as' => 'button'])

<{{ $as }} {{ $attributes->merge(['class' => 'inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500']) }}>
    {{ $slot }}
</{{ $as }}>

