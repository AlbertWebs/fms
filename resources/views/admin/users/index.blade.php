<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold text-white">User Management</h1>
            <p class="mt-1 text-sm text-gray-300">Manage user roles and permissions</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filters -->
        <div class="bg-white rounded-lg border border-indigo-200/50 shadow-sm p-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <x-text-input name="search" placeholder="Search users..." value="{{ request('search') }}" class="w-full" />
                </div>
                <div class="sm:w-48">
                    <select name="role" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                        <option value="">All Roles</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3">
                    <x-primary-button type="submit">Filter</x-primary-button>
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New User
                    </a>
                </div>
            </form>
        </div>

        <!-- Users Table -->
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
                                    <span>User</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>Email</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span>Roles</span>
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
                        @forelse($users as $user)
                            <tr class="hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/30 transition-all duration-150 {{ $loop->even ? 'bg-gray-50/30' : 'bg-white' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-md">
                                            <span class="text-sm font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($user->roles as $role)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 border-2 border-indigo-200">
                                                {{ $role->name }}
                                            </span>
                                        @empty
                                            <span class="text-sm text-gray-400 italic">No roles assigned</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" onclick="event.stopPropagation()">
                                    <x-table-action-dropdown :item="$user">
                                        <button @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-user-roles-{{ $user->id }}' }))" 
                                                class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-indigo-700 transition-colors">
                                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit Roles
                                        </button>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                                              x-data="{ confirmDelete() { if(confirm('Are you sure you want to delete user {{ $user->name }}? This action cannot be undone.')) { this.submit(); } } }"
                                              @submit.prevent="confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-colors">
                                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete User
                                            </button>
                                        </form>
                                    </x-table-action-dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="px-6 py-4 bg-white border-t border-indigo-200/50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Edit User Roles Modals -->
    @foreach($users as $user)
        <x-modal name="edit-user-roles-{{ $user->id }}">
            <form method="POST" action="{{ route('admin.users.update-roles', $user) }}" 
                  x-data="{ submitting: false }" 
                  @submit="submitting = true">
                @csrf
                @method('PUT')
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Edit Roles for {{ $user->name }}</h2>
                    <p class="text-sm text-gray-300 mb-4">{{ $user->email }}</p>
                    
                    <div class="space-y-2">
                        @foreach($roles as $role)
                            <label class="flex items-center p-3 rounded-md hover:bg-gray-50 cursor-pointer border border-gray-200">
                                <input type="checkbox" 
                                       name="roles[]" 
                                       value="{{ $role->id }}"
                                       {{ $user->hasRole($role) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <div class="ml-3 flex-1">
                                    <span class="text-sm font-medium text-gray-900">{{ $role->name }}</span>
                                    <p class="text-xs text-gray-500">{{ $role->permissions->count() }} permissions</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <button type="button" @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'edit-user-roles-{{ $user->id }}' }))" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancel
                    </button>
                    <x-primary-button x-bind:disabled="submitting">
                        <span x-show="!submitting">Update Roles</span>
                        <span x-show="submitting" style="display: none;">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Updating...
                        </span>
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    @endforeach
</x-app-layout>
