@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-emerald-400 text-sm font-medium leading-5 text-green-900 focus:outline-none focus:border-white transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-white hover:bg-green-200 hover:text-green-800 hover:border-green-200 focus:outline-none focus:text-green-700 focus:border-green-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
