<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-white">Roles & Permissions</h1>
                <p class="mt-1 text-sm text-gray-300">Manage user roles and their permissions</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.permissions.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-sm text-gray-700 hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all duration-200 shadow-sm hover:shadow">
                Manage Permissions
            </a>
            <button @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-role' }))" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm hover:shadow-md">
                New Role
            </button>
        </div>
        
        <!-- Roles List -->
        <div class="bg-white rounded-lg border border-indigo-200/50 shadow-sm">
            <div class="px-6 py-4 border-b border-indigo-200/50 bg-gradient-to-r from-indigo-50/50 to-transparent">
                <h2 class="text-lg font-semibold text-gray-900">Roles</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($roles as $role)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $role->name }}</h3>
                                        <span class="text-xs text-gray-500">({{ $role->permissions->count() }} permissions)</span>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Permissions:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @forelse($role->permissions as $permission)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 border border-indigo-200">
                                                    {{ $permission->name }}
                                                </span>
                                            @empty
                                                <span class="text-sm text-gray-400">No permissions assigned</span>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-2 ml-4">
                                    <button @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-role-{{ $role->id }}' }))" 
                                            class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    @if($role->name !== 'Admin')
                                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" 
                                              x-data="{ confirmDelete() { if(confirm('Are you sure you want to delete this role?')) { this.submit(); } } }"
                                              @submit.prevent="confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Permission Assignment -->
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <form method="POST" action="{{ route('admin.roles.update-permissions', $role) }}" 
                                      x-data="{ submitting: false }" 
                                      @submit="submitting = true">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                        @foreach($permissions as $permission)
                                            <label class="flex items-center p-2 rounded-md hover:bg-gray-50 cursor-pointer">
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       value="{{ $permission->id }}"
                                                       {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}
                                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <span class="ml-2 text-sm text-gray-700">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    
                                    <div class="mt-4 flex justify-end">
                                        <x-primary-button x-bind:disabled="submitting" class="text-sm">
                                            <span x-show="!submitting">Update Permissions</span>
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Create Role Modal -->
    <x-modal name="create-role">
        <form method="POST" action="{{ route('admin.roles.store') }}" 
              x-data="{ submitting: false }" 
              @submit="submitting = true">
            @csrf
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Create New Role</h2>
                
                <div>
                    <x-input-label for="name" :value="__('Role Name')" />
                    <x-text-input id="name" type="text" name="name" required autofocus />
                    <x-input-error :messages="$errors->get('name')" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-200">
                <button type="button" @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'create-role' }))" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Cancel
                </button>
                <x-primary-button x-bind:disabled="submitting">
                    <span x-show="!submitting">Create Role</span>
                    <span x-show="submitting" style="display: none;">Creating...</span>
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Edit Role Modals -->
    @foreach($roles as $role)
        <x-modal name="edit-role-{{ $role->id }}">
            <form method="POST" action="{{ route('admin.roles.update', $role) }}" 
                  x-data="{ submitting: false }" 
                  @submit="submitting = true">
                @csrf
                @method('PUT')
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Edit Role</h2>
                    
                    <div>
                        <x-input-label for="name-{{ $role->id }}" :value="__('Role Name')" />
                        <x-text-input id="name-{{ $role->id }}" type="text" name="name" :value="$role->name" required />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <button type="button" @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'edit-role-{{ $role->id }}' }))" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancel
                    </button>
                    <x-primary-button x-bind:disabled="submitting">
                        <span x-show="!submitting">Update Role</span>
                        <span x-show="submitting" style="display: none;">Updating...</span>
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    @endforeach
</x-app-layout>
