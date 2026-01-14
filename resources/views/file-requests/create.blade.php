<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-bold text-white">Request File from Client</h1>
            <p class="mt-1 text-sm text-gray-300">Send a secure upload link to a client</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <form method="POST" action="{{ route('file-requests.store') }}" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf

                <div class="p-8 space-y-8">
                    <!-- Request Details Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Request Details
                        </h2>
                        <div class="space-y-6">
                            <!-- Client Selection -->
                            <div>
                                <label for="client_id" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Client
                                    </span>
                                </label>
                                <select id="client_id" 
                                        name="client_id" 
                                        required
                                        class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 bg-white text-gray-900 font-medium transition-all duration-200">
                                    <option value="">Select Client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }} {{ $client->email ? '(' . $client->email . ')' : '' }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                            </div>

                            <!-- Request Title -->
                            <div>
                                <label for="title" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        Request Title
                                    </span>
                                </label>
                                <input id="title" 
                                       type="text" 
                                       name="title" 
                                       value="{{ old('title') }}" 
                                       placeholder="e.g., Tax Documents for 2023-2024" 
                                       required 
                                       autofocus
                                       class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 bg-white text-gray-900 font-medium transition-all duration-200" />
                                <p class="mt-2 text-xs font-medium text-gray-600">A clear title that describes what files you need</p>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Description (Optional)
                                    </span>
                                </label>
                                <textarea id="description" 
                                          name="description" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border-2 border-pink-200 rounded-xl shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                          placeholder="Provide additional details about the files you need...">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- File Classification Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            File Classification
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        Category
                                    </span>
                                </label>
                                <select id="category_id" 
                                        name="category_id" 
                                        class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 bg-white text-gray-900 font-medium transition-all duration-200">
                                    <option value="">Select Category (Optional)</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>

                            <!-- Financial Year -->
                            <div>
                                <label for="financial_year" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Financial Year
                                    </span>
                                </label>
                                <select id="financial_year" 
                                        name="financial_year" 
                                        class="block w-full px-4 py-3 border-2 border-pink-200 rounded-xl shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 bg-white text-gray-900 font-medium transition-all duration-200">
                                    <option value="">Select Financial Year (Optional)</option>
                                    @foreach($financialYears as $year)
                                        <option value="{{ $year }}" {{ old('financial_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('financial_year')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Link Settings Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Link Settings
                        </h2>
                        <div>
                            <label for="expires_in_days" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Link Expires In (Days)
                                </span>
                            </label>
                            <input id="expires_in_days" 
                                   type="number" 
                                   name="expires_in_days" 
                                   value="{{ old('expires_in_days', 30) }}" 
                                   min="1" 
                                   max="90"
                                   class="block w-full px-4 py-3 border-2 border-violet-200 rounded-xl shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-300 bg-white text-gray-900 font-medium transition-all duration-200" />
                            <p class="mt-2 text-xs font-medium text-gray-600">How many days until the upload link expires? (Default: 30 days, Max: 90 days)</p>
                            <x-input-error :messages="$errors->get('expires_in_days')" class="mt-2" />
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
                                <span class="text-indigo-600 mr-2 font-bold">•</span>
                                <span>Provide a clear, descriptive title for your request</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-purple-600 mr-2 font-bold">•</span>
                                <span>Add a description to help clients understand what files you need</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-pink-600 mr-2 font-bold">•</span>
                                <span>Select a category and financial year to help organize uploaded files</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-violet-600 mr-2 font-bold">•</span>
                                <span>The upload link will expire after the specified number of days</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-4 px-8 py-6 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-t-2 border-indigo-200">
                    <a href="{{ route('file-requests.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                            x-bind:disabled="submitting"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                        <span x-show="!submitting" class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Send Request
                        </span>
                        <span x-show="submitting" style="display: none;" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Sending...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
