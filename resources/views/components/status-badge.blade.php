@props(['status'])

@php
$classes = match($status) {
    'active' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'dormant' => 'bg-amber-50 text-amber-700 border-amber-200',
    'archived' => 'bg-gray-50 text-gray-700 border-gray-200',
    'enabled' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'disabled' => 'bg-gray-50 text-gray-700 border-gray-200',
    default => 'bg-gray-50 text-gray-700 border-gray-200',
};
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $classes }}">
    {{ ucfirst($status) }}
</span>
