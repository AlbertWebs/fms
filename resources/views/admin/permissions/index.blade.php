<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-white">Permissions</h1>
                <p class="mt-1 text-sm text-gray-300">Manage system permissions</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-sm text-gray-700 hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all duration-200 shadow-sm hover:shadow">
                Manage Roles
            </a>
            <button @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-permission' }))" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm hover:shadow-md">
                New Permission
            </button>
        </div>
        
        <!-- Permissions by Group -->
        @foreach($grouped as $group => $groupPermissions)
            <div class="bg-white rounded-lg border border-indigo-200/50 shadow-sm">
                <div class="px-6 py-4 border-b border-indigo-200/50 bg-gradient-to-r from-indigo-50/50 to-transparent">
                    <h2 class="text-lg font-semibold text-gray-900 capitalize">{{ $group }} Permissions</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($groupPermissions as $permission)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-indigo-300 transition-colors">
                                <span class="text-sm font-medium text-gray-900">{{ $permission->name }}</span>
                                <div class="flex items-center gap-2">
                                    <button @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-permission-{{ $permission->id }}' }))" 
                                            class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}" 
                                          x-data="{ confirmDelete() { if(confirm('Are you sure you want to delete this permission?')) { this.submit(); } } }"
                                          @submit.prevent="confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Create Permission Modal -->
    <x-modal name="create-permission">
        <form method="POST" action="{{ route('admin.permissions.store') }}" 
              x-data="{ submitting: false }" 
              @submit="submitting = true">
            @csrf
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Create New Permission</h2>
                
                <div>
                    <x-input-label for="name" :value="__('Permission Name')" />
                    <x-text-input id="name" type="text" name="name" placeholder="e.g., reports.view" required autofocus />
                    <x-input-error :messages="$errors->get('name')" />
                    <p class="mt-1 text-xs text-gray-300">Use dot notation: resource.action (e.g., files.view, clients.create)</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-200">
                <button type="button" @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'create-permission' }))" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Cancel
                </button>
                <x-primary-button x-bind:disabled="submitting">
                    <span x-show="!submitting">Create Permission</span>
                    <span x-show="submitting" style="display: none;">Creating...</span>
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Edit Permission Modals -->
    @foreach($permissions as $permission)
        <x-modal name="edit-permission-{{ $permission->id }}">
            <form method="POST" action="{{ route('admin.permissions.update', $permission) }}" 
                  x-data="{ submitting: false }" 
                  @submit="submitting = true">
                @csrf
                @method('PUT')
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Edit Permission</h2>
                    
                    <div>
                        <x-input-label for="name-{{ $permission->id }}" :value="__('Permission Name')" />
                        <x-text-input id="name-{{ $permission->id }}" type="text" name="name" :value="$permission->name" required />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <button type="button" @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'edit-permission-{{ $permission->id }}' }))" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancel
                    </button>
                    <x-primary-button x-bind:disabled="submitting">
                        <span x-show="!submitting">Update Permission</span>
                        <span x-show="submitting" style="display: none;">Updating...</span>
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    @endforeach
</x-app-layout>
