@props(['as' => 'button'])

<{{ $as }} {{ $attributes->merge(['class' => 'inline-flex items-center justify-center p-2 rounded-md text-zinc-700 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500']) }}>
    {{ $slot }}
</{{ $as }}>

