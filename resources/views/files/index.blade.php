<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">Files</h1>
                <p class="mt-1 text-sm text-gray-300">Manage and organize client files</p>
            </div>
            <div class="flex items-center gap-3">
                @can('files.bulk')
                    <div id="bulk-actions-empty" class="flex items-center">
                        <button onclick="showBulkActions()" 
                                class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-purple-200 rounded-lg font-medium text-sm text-purple-700 hover:from-purple-100 hover:to-pink-100 hover:border-purple-300 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Bulk Actions
                        </button>
                    </div>
                    <div id="bulk-actions-selected" class="relative flex items-center gap-3" style="display: none;">
                        <span id="selected-count" class="px-3 py-1.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-sm font-semibold rounded-full shadow-md">0 selected</span>
                        <button onclick="toggleBulkMenu()" 
                                class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Actions
                            <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="bulk-menu" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl ring-1 ring-purple-200 border-2 border-purple-100 z-10 overflow-hidden" style="display: none;">
                            <div class="py-2">
                                <button onclick="performBulkAction('download')" class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 hover:text-blue-700 transition-colors">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Download (ZIP)
                                    </span>
                                </button>
                                <button onclick="performBulkAction('archive')" class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 hover:text-amber-700 transition-colors">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                        </svg>
                                        Archive
                                    </span>
                                </button>
                                <button onclick="performBulkAction('change_category')" class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 transition-colors">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        Change Category
                                    </span>
                                </button>
                                <button onclick="performBulkAction('change_financial_year')" class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 hover:text-purple-700 transition-colors">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Change Financial Year
                                    </span>
                                </button>
                                <div class="border-t border-gray-200 my-1"></div>
                                <button onclick="performBulkAction('delete')" class="block w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-colors">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Global Search & Filter Toggle -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl p-6 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" 
                               id="search-input"
                               value="{{ request('search', '') }}"
                               placeholder="Search files, clients, categories..." 
                               class="block w-full pl-12 pr-4 py-3 border-2 border-indigo-200 rounded-xl leading-5 bg-white/80 backdrop-blur-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 shadow-inner transition-all duration-200 sm:text-sm">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="toggleFilters()" 
                            id="filter-btn"
                            class="inline-flex items-center px-5 py-3 border-2 border-purple-300 rounded-xl font-medium text-sm text-purple-700 bg-gradient-to-r from-purple-50 to-pink-50 hover:from-purple-100 hover:to-pink-100 hover:border-purple-400 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filters
                    </button>
                    @can('files.upload')
                        <a href="{{ route('files.create') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Upload File
                        </a>
                    @endcan
                </div>
            </div>

            <!-- Advanced Filters Drawer -->
            <div id="filters-drawer" class="mt-6 pt-6 border-t-2 border-gradient-to-r from-indigo-200 to-purple-200 bg-gradient-to-br from-white/50 to-indigo-50/30 rounded-xl p-4" style="display: none;">
                <form method="GET" action="{{ route('files.index') }}" id="filters-form">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Client</label>
                            <select name="client_id" class="w-full rounded-lg border-2 border-indigo-200 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 text-sm bg-white transition-all duration-200">
                                <option value="">All Clients</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Category</label>
                            <select name="category_id" class="w-full rounded-lg border-2 border-purple-200 shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 text-sm bg-white transition-all duration-200">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Status</label>
                            <select name="status" class="w-full rounded-lg border-2 border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 text-sm bg-white transition-all duration-200">
                                <option value="">All Statuses</option>
                                <option value="uploaded" {{ request('status') == 'uploaded' ? 'selected' : '' }}>Uploaded</option>
                                <option value="pending_review" {{ request('status') == 'pending_review' ? 'selected' : '' }}>Pending Review</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="needs_correction" {{ request('status') == 'needs_correction' ? 'selected' : '' }}>Needs Correction</option>
                                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Uploaded By</label>
                            <select name="uploaded_by" class="w-full rounded-lg border-2 border-blue-200 shadow-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-300 text-sm bg-white transition-all duration-200">
                                <option value="">All Users</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('uploaded_by') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Financial Year</label>
                            <input type="text" name="financial_year" value="{{ request('financial_year', '') }}" placeholder="2023-2024" class="w-full rounded-lg border-2 border-indigo-200 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 text-sm bg-white transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Date From</label>
                            <input type="date" name="date_from" value="{{ request('date_from', '') }}" class="w-full rounded-lg border-2 border-purple-200 shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 text-sm bg-white transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Date To</label>
                            <input type="date" name="date_to" value="{{ request('date_to', '') }}" class="w-full rounded-lg border-2 border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 text-sm bg-white transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Lock Status</label>
                            <select name="is_locked" class="w-full rounded-lg border-2 border-amber-200 shadow-sm focus:border-amber-400 focus:ring-2 focus:ring-amber-300 text-sm bg-white transition-all duration-200">
                                <option value="">All</option>
                                <option value="1" {{ request('is_locked') === '1' ? 'selected' : '' }}>Locked</option>
                                <option value="0" {{ request('is_locked') === '0' ? 'selected' : '' }}>Unlocked</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 mt-6">
                        <button type="button" onclick="resetFilters()" class="px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                            Reset Filters
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bulk Action Form (Hidden) -->
        @can('files.bulk')
            <form id="bulk-action-form" method="POST" action="{{ route('files.bulk-action') }}" style="display: none;">
                @csrf
                <input type="hidden" name="action" id="bulk-action-type">
                <input type="hidden" name="category_id" id="bulk-category-id">
                <input type="hidden" name="financial_year" id="bulk-financial-year">
                <div id="bulk-file-ids"></div>
            </form>
        @endcan

        <!-- Table -->
        <div class="bg-white rounded-2xl border-2 border-indigo-200/60 shadow-xl overflow-hidden backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 sticky top-0 z-10 shadow-lg">
                        <tr>
                            @can('files.bulk')
                                <th class="px-6 py-4 text-left">
                                    <input type="checkbox" 
                                           id="select-all"
                                           onclick="toggleAllFiles()"
                                           class="rounded border-white bg-white/20 text-white focus:ring-white focus:ring-offset-indigo-600">
                                </th>
                            @endcan
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Client</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Financial Year</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Uploaded</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($files as $file)
                            <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:via-purple-50 hover:to-pink-50 transition-all duration-200 border-b border-gray-100 {{ $loop->even ? 'bg-gradient-to-r from-gray-50/50 to-indigo-50/30' : 'bg-white' }}">
                                @can('files.bulk')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" 
                                               name="file_ids[]" 
                                               value="{{ $file->id }}"
                                               class="file-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                               onchange="updateSelectedFiles()">
                                    </td>
                                @endcan
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($file->is_locked)
                                            <svg class="h-4 w-4 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" title="Locked">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        @endif
                                        <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">{{ $file->original_name }}</div>
                                            @if($file->category->retention_days)
                                                <div class="text-xs text-gray-600">
                                                    Retention: {{ $file->category->retention_days }} days
                                                    @if($file->archived_at)
                                                        • Archived {{ $file->archived_at->format('M d, Y') }}
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $file->client->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $file->category->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        // Ensure status always has a value
                                        $status = $file->status ?: 'uploaded';
                                        if (empty($status) || is_null($status)) {
                                            $status = 'uploaded';
                                        }
                                        
                                        $statusColors = [
                                            'uploaded' => 'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border-2 border-gray-300 shadow-sm',
                                            'pending_review' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border-2 border-amber-300 shadow-sm',
                                            'approved' => 'bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border-2 border-emerald-300 shadow-sm',
                                            'needs_correction' => 'bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border-2 border-red-300 shadow-sm',
                                            'archived' => 'bg-gradient-to-r from-slate-100 to-gray-100 text-slate-800 border-2 border-slate-300 shadow-sm',
                                        ];
                                        
                                        $statusColor = $statusColors[$status] ?? $statusColors['uploaded'];
                                        $statusLabel = str_replace('_', ' ', ucfirst($status));
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border {{ $statusColor }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $file->financial_year ?? '—' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $file->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-600">{{ $file->uploader->name ?? 'System' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <x-table-action-dropdown :item="$file">
                                        @can('files.preview')
                                            <button onclick="previewFile({{ $file->id }})" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">Preview</button>
                                        @endcan
                                        @can('files.download')
                                            <a href="{{ route('files.download', $file) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">Download</a>
                                        @endcan
                                        @can('files.view')
                                            <a href="{{ route('files.show', $file) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">View Details</a>
                                        @endcan
                                        @can('files.delete')
                                            <button onclick="showDeleteConfirm({{ $file->id }}, '{{ addslashes($file->original_name) }}')" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">Delete</button>
                                        @endcan
                                    </x-table-action-dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->can('files.bulk') ? '8' : '7' }}" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No files found</h3>
                                    <p class="mt-1 text-sm text-gray-300">Get started by uploading a new file.</p>
                                    @can('files.upload')
                                        <div class="mt-6">
                                            <a href="{{ route('files.create') }}">
                                                <x-primary-button>Upload File</x-primary-button>
                                            </a>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($files->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $files->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- File Preview Modal -->
    <x-modal name="file-preview">
        <div class="p-6">
            <h2 id="preview-title" class="text-lg font-semibold text-gray-900 mb-4">Loading preview...</h2>
            <div id="preview-loading" class="flex items-center justify-center py-12">
                <svg class="animate-spin h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div id="preview-content" style="display: none;"></div>
            <div id="preview-error" class="text-center py-12" style="display: none;">
                <p class="text-red-600 mb-4"></p>
            </div>
        </div>
    </x-modal>

    <!-- Delete Confirmation Modal -->
    <x-modal name="delete-confirm">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2 text-center">Confirm Deletion</h2>
            <p class="text-sm text-gray-300 mb-1 text-center">You are about to delete the file:</p>
            <p class="text-sm font-semibold text-gray-900 mb-6 text-center" id="delete-file-name"></p>
            <p class="text-sm text-red-600 mb-6 text-center font-medium">This action cannot be undone. Please enter your password to confirm.</p>
            
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="mb-4">
                    <label for="delete-password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" 
                           id="delete-password" 
                           name="password" 
                           required
                           autocomplete="current-password"
                           class="block w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm"
                           placeholder="Enter your password">
                    <p id="delete-password-error" class="mt-1 text-sm text-red-600" style="display: none;"></p>
                </div>
                
                <div class="flex items-center justify-end gap-3">
                    <button type="button" 
                            onclick="closeDeleteModal()" 
                            class="px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Delete File
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    <script>
        let selectedFiles = [];
        let searchTimeout = null;

        // Search functionality
        document.getElementById('search-input')?.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch();
            }, 500);
        });

        function performSearch() {
            const searchQuery = document.getElementById('search-input').value;
            const form = document.getElementById('filters-form');
            const formData = new FormData(form);
            
            const params = new URLSearchParams();
            if (searchQuery) params.set('search', searchQuery);
            
            formData.forEach((value, key) => {
                if (value) params.set(key, value);
            });
            
            window.location.href = '{{ route('files.index') }}?' + params.toString();
        }

        function toggleFilters() {
            const drawer = document.getElementById('filters-drawer');
            const btn = document.getElementById('filter-btn');
            if (drawer.style.display === 'none') {
                drawer.style.display = 'block';
                btn.classList.add('bg-gradient-to-r', 'from-purple-600', 'to-pink-600', 'text-white', 'border-purple-500');
                btn.classList.remove('border-purple-300', 'text-purple-700', 'from-purple-50', 'to-pink-50');
            } else {
                drawer.style.display = 'none';
                btn.classList.remove('bg-gradient-to-r', 'from-purple-600', 'to-pink-600', 'text-white', 'border-purple-500');
                btn.classList.add('border-purple-300', 'text-purple-700', 'from-purple-50', 'to-pink-50');
            }
        }

        function resetFilters() {
            window.location.href = '{{ route('files.index') }}';
        }

        @can('files.bulk')
        function showBulkActions() {
            // This function can be used to show bulk actions info
        }

        function toggleBulkMenu() {
            const menu = document.getElementById('bulk-menu');
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }

        function updateSelectedFiles() {
            const checkboxes = document.querySelectorAll('.file-checkbox:checked');
            selectedFiles = Array.from(checkboxes).map(cb => parseInt(cb.value));
            
            const emptyDiv = document.getElementById('bulk-actions-empty');
            const selectedDiv = document.getElementById('bulk-actions-selected');
            const countSpan = document.getElementById('selected-count');
            
            if (selectedFiles.length > 0) {
                emptyDiv.style.display = 'none';
                selectedDiv.style.display = 'flex';
                countSpan.textContent = selectedFiles.length + ' selected';
            } else {
                emptyDiv.style.display = 'flex';
                selectedDiv.style.display = 'none';
            }
            
            updateSelectAllCheckbox();
        }

        function toggleAllFiles() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.file-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            
            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
            });
            
            updateSelectedFiles();
        }

        function updateSelectAllCheckbox() {
            const checkboxes = document.querySelectorAll('.file-checkbox');
            const checkedCount = document.querySelectorAll('.file-checkbox:checked').length;
            const selectAll = document.getElementById('select-all');
            
            if (checkedCount === 0) {
                selectAll.checked = false;
                selectAll.indeterminate = false;
            } else if (checkedCount === checkboxes.length) {
                selectAll.checked = true;
                selectAll.indeterminate = false;
            } else {
                selectAll.checked = false;
                selectAll.indeterminate = true;
            }
        }

        function performBulkAction(action) {
            if (selectedFiles.length === 0) {
                alert('Please select at least one file.');
                return;
            }
            
            if (action === 'delete') {
                if (!confirm('Are you sure you want to delete ' + selectedFiles.length + ' file(s)?')) {
                    return;
                }
            }
            
            const form = document.getElementById('bulk-action-form');
            document.getElementById('bulk-action-type').value = action;
            const fileIdsContainer = document.getElementById('bulk-file-ids');
            fileIdsContainer.innerHTML = '';
            
            selectedFiles.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'file_ids[]';
                input.value = id;
                fileIdsContainer.appendChild(input);
            });
            
            if (action === 'change_category') {
                const categoryId = prompt('Enter category ID:');
                if (!categoryId) return;
                document.getElementById('bulk-category-id').value = categoryId;
                document.getElementById('bulk-financial-year').value = '';
            } else if (action === 'change_financial_year') {
                const financialYear = prompt('Enter financial year (e.g., 2023-2024):');
                if (!financialYear) return;
                document.getElementById('bulk-financial-year').value = financialYear;
                document.getElementById('bulk-category-id').value = '';
            } else {
                document.getElementById('bulk-category-id').value = '';
                document.getElementById('bulk-financial-year').value = '';
            }
            
            form.submit();
        }

        // Close bulk menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('bulk-menu');
            const button = event.target.closest('[onclick="toggleBulkMenu()"]');
            if (menu && !menu.contains(event.target) && !button) {
                menu.style.display = 'none';
            }
        });
        @endcan

        function previewFile(fileId) {
            const loadingDiv = document.getElementById('preview-loading');
            const contentDiv = document.getElementById('preview-content');
            const errorDiv = document.getElementById('preview-error');
            const titleEl = document.getElementById('preview-title');
            
            loadingDiv.style.display = 'flex';
            contentDiv.style.display = 'none';
            errorDiv.style.display = 'none';
            titleEl.textContent = 'Loading preview...';
            
            fetch(`/files/${fileId}/preview`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        errorDiv.querySelector('p').textContent = data.error;
                        errorDiv.style.display = 'block';
                        loadingDiv.style.display = 'none';
                        return;
                    }
                    
                    titleEl.textContent = data.name || 'File Preview';
                    loadingDiv.style.display = 'none';
                    contentDiv.innerHTML = '';
                    
                    if (data.mime_type === 'application/pdf') {
                        const iframe = document.createElement('iframe');
                        iframe.src = data.url;
                        iframe.className = 'w-full h-96 border border-gray-200 rounded';
                        contentDiv.appendChild(iframe);
                    } else if (data.mime_type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = data.url;
                        img.className = 'max-w-full h-auto mx-auto rounded';
                        contentDiv.appendChild(img);
                    } else {
                        contentDiv.innerHTML = `
                            <div class="text-center py-12">
                                <p class="text-gray-500 mb-4">Preview not available for this file type.</p>
                                <a href="${data.url}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                    Open in New Tab
                                </a>
                            </div>
                        `;
                    }
                    
                    contentDiv.style.display = 'block';
                    window.dispatchEvent(new CustomEvent('open-modal', { detail: 'file-preview' }));
                })
                .catch(err => {
                    errorDiv.querySelector('p').textContent = 'Failed to load preview. Please try again.';
                    errorDiv.style.display = 'block';
                    loadingDiv.style.display = 'none';
                });
        }

        let currentDeleteFileId = null;

        function showDeleteConfirm(fileId, fileName) {
            currentDeleteFileId = fileId;
            document.getElementById('delete-file-name').textContent = fileName;
            document.getElementById('delete-form').action = `/files/${fileId}`;
            document.getElementById('delete-password').value = '';
            document.getElementById('delete-password-error').style.display = 'none';
            document.getElementById('delete-password').classList.remove('border-red-500');
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-confirm' }));
        }

        function closeDeleteModal() {
            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'delete-confirm' }));
            document.getElementById('delete-password').value = '';
            document.getElementById('delete-password-error').style.display = 'none';
            document.getElementById('delete-password').classList.remove('border-red-500');
        }

        // Handle delete form submission
        document.getElementById('delete-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('delete-password').value;
            const errorDiv = document.getElementById('delete-password-error');
            const passwordInput = document.getElementById('delete-password');
            
            if (!password) {
                errorDiv.textContent = 'Password is required.';
                errorDiv.style.display = 'block';
                passwordInput.classList.add('border-red-500');
                return;
            }
            
            // Submit the form
            this.submit();
        });

        // Clear error on password input
        document.getElementById('delete-password')?.addEventListener('input', function() {
            const errorDiv = document.getElementById('delete-password-error');
            if (errorDiv.style.display !== 'none') {
                errorDiv.style.display = 'none';
                this.classList.remove('border-red-500');
            }
        });

        // Check for password errors on page load and reopen modal if needed
        @if($errors->has('password') && session('delete_file_id'))
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    showDeleteConfirm({{ session('delete_file_id') }}, '{{ addslashes(session('delete_file_name', 'this file')) }}');
                    const errorDiv = document.getElementById('delete-password-error');
                    const passwordInput = document.getElementById('delete-password');
                    errorDiv.textContent = '{{ $errors->first('password') }}';
                    errorDiv.style.display = 'block';
                    passwordInput.classList.add('border-red-500');
                }, 100);
            });
        @endif
    </script>
</x-app-layout>
