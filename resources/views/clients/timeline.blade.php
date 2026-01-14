<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-white">Activity Timeline</h1>
                <p class="mt-1 text-sm text-gray-300">{{ $client->name }}</p>
            </div>
            <a href="{{ route('clients.show', $client) }}">
                <x-secondary-button>Back to Client</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filters -->
        <div class="bg-white rounded-lg border border-indigo-200/50 shadow-sm p-4">
            <form method="GET" action="{{ route('clients.timeline', $client) }}" class="flex flex-col sm:flex-row gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Date From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>
                <div class="flex items-end">
                    <x-primary-button type="submit">Filter</x-primary-button>
                </div>
            </form>
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-lg border border-indigo-200/50 shadow-sm">
            <div class="px-6 py-4 border-b border-indigo-200/50 bg-gradient-to-r from-indigo-50/50 to-transparent">
                <h2 class="text-lg font-semibold text-gray-900">Activity History</h2>
            </div>
            <div class="p-6">
                <div class="relative">
                    @forelse($activities as $activity)
                        <div class="flex items-start space-x-4 pb-6 {{ !$loop->last ? 'border-l-2 border-indigo-200 ml-2 pl-6' : '' }}">
                            <div class="flex-shrink-0">
                                <div class="h-3 w-3 rounded-full bg-indigo-500 ring-2 ring-indigo-200 mt-1.5"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900">{{ $activity->description }}</p>
                                    <span class="text-xs text-gray-500">{{ $activity->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="text-xs text-gray-500">{{ $activity->user->name ?? 'System' }}</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-700 border border-indigo-200">
                                        {{ $activity->action }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No activity found</h3>
                            <p class="mt-1 text-sm text-gray-300">Activity will appear here as actions are performed.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if($activities->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
