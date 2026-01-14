<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold text-white">System Settings</h1>
            <p class="mt-1 text-sm text-gray-300">Manage system name, logo, and account information</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg border border-indigo-200/50 shadow-sm">
            <form method="POST" action="{{ route('admin.settings.update') }}" 
                  x-data="{ submitting: false }" 
                  @submit="submitting = true"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="p-8 space-y-8">
                    <!-- Application Information Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Application Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="app_name" :value="__('Application Name')" />
                                <x-text-input id="app_name" type="text" name="app_name" :value="old('app_name', $settings['app_name'])" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('app_name')" class="mt-2" />
                                <p class="mt-1 text-xs text-gray-300">The name displayed throughout the application</p>
                            </div>
                        </div>
                    </div>

                    <!-- Company Information Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Company Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="company_name" :value="__('Company Name')" />
                                <x-text-input id="company_name" type="text" name="company_name" :value="old('company_name', $settings['company_name'])" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="company_email" :value="__('Company Email')" />
                                <x-text-input id="company_email" type="email" name="company_email" :value="old('company_email', $settings['company_email'])" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="company_phone" :value="__('Company Phone')" />
                                <x-text-input id="company_phone" type="text" name="company_phone" :value="old('company_phone', $settings['company_phone'])" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('company_phone')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="company_website" :value="__('Company Website')" />
                                <x-text-input id="company_website" type="url" name="company_website" :value="old('company_website', $settings['company_website'])" class="mt-1 block w-full" placeholder="https://example.com" />
                                <x-input-error :messages="$errors->get('company_website')" class="mt-2" />
                            </div>
                            
                            <div class="md:col-span-2">
                                <x-input-label for="company_address" :value="__('Company Address')" />
                                <textarea id="company_address" name="company_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Enter company physical address">{{ old('company_address', $settings['company_address']) }}</textarea>
                                <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Logo Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Logo
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="logo" :value="__('Logo Upload')" />
                                <div class="mt-1 flex items-center gap-4">
                                    <label for="logo" class="cursor-pointer">
                                        <div class="px-4 py-2 bg-indigo-50 border-2 border-dashed border-indigo-300 rounded-lg hover:bg-indigo-100 hover:border-indigo-400 transition-colors">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                                <span class="text-sm font-medium text-indigo-700">Choose File</span>
                                            </div>
                                        </div>
                                        <input id="logo" type="file" name="logo" accept="image/*" class="hidden" onchange="document.getElementById('logo-file-name').textContent = this.files[0]?.name || 'No file chosen'">
                                    </label>
                                    <span id="logo-file-name" class="text-sm text-gray-500">No file chosen</span>
                                </div>
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                <p class="mt-2 text-xs text-gray-500">Recommended: PNG or SVG format, maximum 2MB. The logo will be displayed in the sidebar and application header.</p>
                            </div>
                            @if($settings['logo_path'])
                                <div class="pt-4 border-t border-gray-200">
                                    <p class="text-sm font-medium text-gray-700 mb-3">Current Logo:</p>
                                    <div class="inline-block p-4 bg-gray-50 rounded-lg border border-gray-200">
                                        <img src="{{ asset('storage/' . $settings['logo_path']) }}" alt="Current Logo" class="h-16 w-auto max-w-xs">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 px-8 py-4 bg-gray-50 border-t border-gray-200">
                    <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancel
                    </a>
                    <x-primary-button x-bind:disabled="submitting">
                        <span x-show="!submitting">Save Settings</span>
                        <span x-show="submitting" style="display: none;">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Saving...
                        </span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
