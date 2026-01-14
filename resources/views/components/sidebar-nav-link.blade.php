@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600/80 to-purple-600/80 rounded-lg border-2 border-indigo-500/50 shadow-md'
            : 'flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700/50 rounded-lg border border-gray-700/50 hover:border-gray-600/70 shadow-sm hover:shadow-md transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} 
   x-data="{ loading: false }"
   @click="loading = true"
   x-bind:class="{ 'cursor-wait': loading }">
    <svg x-show="loading" 
         class="w-5 h-5 animate-spin text-white shrink-0" 
         xmlns="http://www.w3.org/2000/svg" 
         fill="none" 
         viewBox="0 0 24 24" 
         style="display: none;">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
    <span x-show="!loading" class="flex items-center space-x-3">
        {{ $slot }}
    </span>
</a>
