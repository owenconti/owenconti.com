@props(['as' => 'button'])

<{{ $as }} {{ $attributes->merge(['class' => 'whitespace-nowrap no-underline inline-flex items-center justify-center py-2 px-4 font-semibold rounded-md dark:text-gray-900 dark:hover:text-gray-900 dark:bg-gray-50 dark:hover:bg-gray-200  bg-gray-950 text-gray-100 hover:text-gray-100 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500']) }}>
    {{ $slot }}
</{{ $as }}>

