@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600/80 to-purple-600/80 rounded-lg border-2 border-indigo-500/50 shadow-md'
            : 'flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700/50 rounded-lg border border-gray-700/50 hover:border-gray-600/70 shadow-sm hover:shadow-md transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
