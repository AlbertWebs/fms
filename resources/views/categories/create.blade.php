<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-bold text-white">Create Category</h1>
            <p class="mt-1 text-sm text-gray-300">Add a new file category</p>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <form method="POST" action="{{ route('categories.store') }}" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf

                <div class="p-8 space-y-8">
                    <!-- Category Information Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Category Information
                        </h2>
                        <div class="space-y-6">
                            <!-- Category Name -->
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        Category Name
                                    </span>
                                </label>
                                <input id="name" 
                                       type="text" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autofocus
                                       class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="Enter category name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Description
                                    </span>
                                </label>
                                <textarea id="description" 
                                          name="description" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 bg-white text-gray-900 font-medium transition-all duration-200 resize-none" 
                                          placeholder="Enter category description (optional)">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            @can('files.retention.manage')
                                <!-- Retention Period -->
                                <div>
                                    <label for="retention_days" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Retention Period (Days)
                                        </span>
                                    </label>
                                    <input id="retention_days" 
                                           type="number" 
                                           name="retention_days" 
                                           value="{{ old('retention_days') }}" 
                                           min="0" 
                                           class="block w-full px-4 py-3 border-2 border-pink-200 rounded-xl shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                           placeholder="Leave empty for no auto-archiving" />
                                    <x-input-error :messages="$errors->get('retention_days')" class="mt-2" />
                                    <p class="mt-2 text-xs font-medium text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Files in this category will be auto-archived after this many days. Leave empty to disable.
                                    </p>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="bg-gradient-to-br from-indigo-50/50 to-purple-50/30 rounded-xl border-2 border-indigo-200 p-6">
                        <h3 class="text-sm font-bold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tips
                        </h3>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Use clear, descriptive names that make it easy to identify the category's purpose.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Add a description to help team members understand when to use this category.</span>
                            </li>
                            @can('files.retention.manage')
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Set a retention period to automatically archive files after a specified number of days.</span>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 px-8 py-6 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-t-2 border-indigo-200">
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                            x-bind:disabled="submitting"
                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                        <span x-show="!submitting" class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create Category
                        </span>
                        <span x-show="submitting" style="display: none;" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
