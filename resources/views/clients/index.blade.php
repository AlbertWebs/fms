<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-bold text-white">Clients</h1>
            <p class="mt-1 text-sm text-gray-300">Manage your client database</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-2xl border-2 border-indigo-200/60 p-6 hover:border-indigo-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 group-hover:from-indigo-600 group-hover:to-purple-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-300 uppercase tracking-wide">Total Clients</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mt-1">{{ $totalClients }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 rounded-2xl border-2 border-emerald-200/60 p-6 hover:border-emerald-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 group-hover:from-emerald-600 group-hover:to-green-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Active</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent mt-1">{{ $activeClients }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 rounded-2xl border-2 border-amber-200/60 p-6 hover:border-amber-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 group-hover:from-amber-600 group-hover:to-orange-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Dormant</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent mt-1">{{ $dormantClients }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-50 via-gray-50 to-zinc-50 rounded-2xl border-2 border-slate-200/60 p-6 hover:border-slate-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-slate-500 to-gray-500 group-hover:from-slate-600 group-hover:to-gray-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Archived</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-slate-600 to-gray-600 bg-clip-text text-transparent mt-1">{{ $archivedClients }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl p-6 backdrop-blur-sm">
            <form method="GET" action="{{ route('clients.index') }}" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Search Clients</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search by name, email, phone, or KRA PIN..." 
                                   class="block w-full pl-12 pr-4 py-3 border-2 border-indigo-200 rounded-xl bg-white text-gray-900 font-medium placeholder-gray-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 transition-all duration-200 shadow-sm" />
                        </div>
                    </div>
                    <div class="sm:w-48">
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Status</label>
                        <select name="status" class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl bg-white text-gray-900 font-medium focus:border-purple-400 focus:ring-2 focus:ring-purple-300 transition-all duration-200 shadow-sm">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="dormant" {{ request('status') == 'dormant' ? 'selected' : '' }}>Dormant</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    @can('clients.create')
                        <div class="flex items-end">
                            <a href="{{ route('clients.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                New Client
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="flex items-center justify-between pt-4 border-t-2 border-indigo-200">
                    <div class="flex gap-3">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Apply Filters
                        </button>
                        @if(request('search') || request('status'))
                            <a href="{{ route('clients.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Clear Filters
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl overflow-hidden backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 sticky top-0 z-10 shadow-lg">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Client</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>Contact</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span>KRA PIN</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($clients as $client)
                            <tr class="hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/30 transition-all duration-150 {{ $loop->even ? 'bg-gray-50/30' : 'bg-white' }} cursor-pointer group" onclick="window.location.href='{{ route('clients.show', $client) }}'">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center group-hover:from-indigo-600 group-hover:to-purple-600 transition-all duration-200 shadow-md">
                                            <span class="text-sm font-bold text-white">{{ strtoupper(substr($client->name, 0, 2)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition-colors">{{ $client->name }}</div>
                                            @if($client->company_name)
                                                <div class="text-xs font-medium text-gray-600 mt-0.5">{{ $client->company_name }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" onclick="event.stopPropagation()">
                                    <div class="space-y-1.5">
                                        @if($client->contact_email ?? $client->email)
                                            <a href="mailto:{{ $client->contact_email ?? $client->email }}" class="flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-700 hover:underline transition-colors">
                                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                {{ $client->contact_email ?? $client->email }}
                                            </a>
                                        @else
                                            <span class="text-sm text-gray-400">—</span>
                                        @endif
                                        @if($client->contact_phone ?? $client->phone)
                                            <a href="tel:{{ $client->contact_phone ?? $client->phone }}" class="flex items-center text-sm font-semibold text-purple-600 hover:text-purple-700 hover:underline transition-colors">
                                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                {{ $client->contact_phone ?? $client->phone }}
                                            </a>
                                        @else
                                            <span class="text-sm text-gray-400">—</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-800 font-mono">{{ $client->kra_pin ?? '—' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" onclick="event.stopPropagation()">
                                    <x-status-badge :status="$client->status" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" onclick="event.stopPropagation()">
                                    <x-table-action-dropdown :item="$client">
                                        <a href="{{ route('clients.show', $client) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 hover:text-blue-700 transition-colors">
                                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View Details
                                        </a>
                                        @can('clients.update')
                                            <a href="{{ route('clients.edit', $client) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-indigo-700 transition-colors">
                                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                        @endcan
                                        @can('clients.delete')
                                            <form method="POST" action="{{ route('clients.destroy', $client) }}" 
                                                  x-data="{ confirmDelete() { if(confirm('Are you sure you want to delete this client? This action cannot be undone.')) { this.submit(); } } }"
                                                  @submit.prevent="confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-colors">
                                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </x-table-action-dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 mb-4">
                                            <svg class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900">No clients found</h3>
                                        <p class="mt-2 text-sm text-gray-600 max-w-sm">
                                            @if(request('search') || request('status'))
                                                No clients match your current filters. Try adjusting your search criteria.
                                            @else
                                                Get started by creating your first client.
                                            @endif
                                        </p>
                                        @can('clients.create')
                                            <div class="mt-6">
                                                <a href="{{ route('clients.create') }}">
                                                    <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Create First Client
                                                    </button>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($clients->hasPages())
                <div class="px-6 py-4 border-t-2 border-indigo-200 bg-gradient-to-r from-gray-50 to-indigo-50/30">
                    {{ $clients->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
