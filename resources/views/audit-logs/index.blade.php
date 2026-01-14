<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold text-white">Audit Logs</h1>
            <p class="mt-1 text-sm text-gray-300">Track all system activity and changes</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filters -->
        <div class="bg-white rounded-lg border border-indigo-200/50 shadow-sm p-4">
            <form method="GET" action="{{ route('audit-logs.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <x-text-input name="action" placeholder="Action" value="{{ request('action') }}" class="w-full" />
                </div>
                <div>
                    <x-text-input name="date_from" type="date" value="{{ request('date_from') }}" class="w-full" />
                </div>
                <div>
                    <x-text-input name="date_to" type="date" value="{{ request('date_to') }}" class="w-full" />
                </div>
                <x-primary-button type="submit" class="w-full sm:w-auto">Filter</x-primary-button>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($logs as $log)
                            <tr class="hover:bg-indigo-50/30 transition-colors border-b border-gray-100/50 {{ $loop->even ? 'bg-gray-50/30' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'System' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 border border-indigo-200">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">{{ $log->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $log->created_at->format('M d, Y H:i') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No audit logs found</h3>
                                    <p class="mt-1 text-sm text-gray-300">Activity will appear here as users interact with the system.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>