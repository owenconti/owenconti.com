@props(['as' => 'button'])

<{{ $as }} {{ $attributes->merge(['class' => 'whitespace-nowrap no-underline inline-flex items-center justify-center py-2 px-4 font-semibold rounded-md dark:text-zinc-900 dark:hover:text-zinc-900 dark:bg-zinc-50 dark:hover:bg-zinc-200  bg-zinc-950 text-zinc-100 hover:text-zinc-100 hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500']) }}>
    {{ $slot }}
</{{ $as }}>

