<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-bold text-white">Create New User</h1>
            <p class="mt-1 text-sm text-gray-300">Add a new user to the system</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <form method="POST" action="{{ route('admin.users.store') }}" 
                  x-data="{ submitting: false }" 
                  @submit="submitting = true">
                @csrf
                
                <div class="p-8 space-y-8">
                    <!-- User Information Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            User Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" type="email" name="email" :value="old('email')" required class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Password
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Roles Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Roles
                        </h2>
                        <div class="space-y-2 max-h-64 overflow-y-auto border-2 border-indigo-200/50 rounded-xl p-4 bg-white/50">
                            @foreach($roles as $role)
                                <label class="flex items-center p-3 rounded-lg hover:bg-gradient-to-r hover:from-indigo-50/70 hover:to-purple-50/50 cursor-pointer border border-gray-200 hover:border-indigo-200/60 transition-all duration-200">
                                    <input type="checkbox" 
                                           name="roles[]" 
                                           value="{{ $role->id }}"
                                           {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:ring-2">
                                    <div class="ml-3 flex-1">
                                        <span class="text-sm font-semibold text-gray-900">{{ $role->name }}</span>
                                        <p class="text-xs text-gray-300 mt-0.5">{{ $role->permissions->count() }} permissions</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 px-8 py-4 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-t border-indigo-200/60">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <x-primary-button x-bind:disabled="submitting">
                        <span x-show="!submitting">Create User</span>
                        <span x-show="submitting" style="display: none;">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating...
                        </span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
