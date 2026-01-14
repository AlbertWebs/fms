<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-bold text-white">Categories</h1>
            <p class="mt-1 text-sm text-gray-300">Organize files by category</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Statistics Card -->
        <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-2xl border-2 border-indigo-200/60 p-6 hover:border-indigo-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 group-hover:from-indigo-600 group-hover:to-purple-600 transition-all duration-200 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-semibold text-gray-300 uppercase tracking-wide">Total Categories</p>
                    <p class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mt-1">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl p-6 backdrop-blur-sm">
            <form method="GET" action="{{ route('categories.index') }}" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Search Categories</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search by name or description..." 
                                   class="block w-full pl-12 pr-4 py-3 border-2 border-indigo-200 rounded-xl bg-white text-gray-900 font-medium placeholder-gray-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 transition-all duration-200 shadow-sm" />
                        </div>
                    </div>
                    @can('categories.manage')
                        <div class="flex items-end">
                            <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                New Category
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
                        @if(request('search'))
                            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
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

        @if (session('success'))
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 border-2 border-emerald-200 text-emerald-700 px-6 py-4 rounded-xl shadow-md">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl overflow-hidden backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 sticky top-0 z-10 shadow-lg">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span>Name</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Description</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Files</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center justify-end space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/30 transition-all duration-200 {{ $loop->even ? 'bg-gray-50/30' : 'bg-white' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="p-2 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg">
                                                <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-bold text-gray-900">{{ $category->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-800 max-w-md">{{ $category->description ?? '—' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 border border-indigo-200">
                                        {{ $category->files_count }} {{ Str::plural('file', $category->files_count) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <x-table-action-dropdown :item="$category">
                                        @can('categories.manage')
                                            <a href="{{ route('categories.edit', $category) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </div>
                                            </a>
                                            <a href="{{ route('categories.show', $category) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </div>
                                            </a>
                                            <form method="POST" action="{{ route('categories.destroy', $category) }}" 
                                                  x-data="{ confirmDelete() { if(confirm('Are you sure you want to delete this category?')) { this.submit(); } } }"
                                                  @submit.prevent="confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Delete
                                                    </div>
                                                </button>
                                            </form>
                                        @endcan
                                    </x-table-action-dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="p-4 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full mb-4">
                                            <svg class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-2 text-sm font-bold text-gray-900">No categories found</h3>
                                        <p class="mt-1 text-sm font-medium text-gray-600">Get started by creating a new category.</p>
                                        @can('categories.manage')
                                            <div class="mt-6">
                                                <a href="{{ route('categories.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    New Category
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

            @if($categories->hasPages())
                <div class="px-6 py-4 border-t-2 border-indigo-200 bg-gradient-to-r from-gray-50 to-indigo-50/30">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
