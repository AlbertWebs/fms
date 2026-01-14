<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-bold text-white">Edit Client</h1>
            <p class="mt-1 text-sm text-gray-300">Update client information</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <form method="POST" action="{{ route('clients.update', $client) }}" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf
                @method('PATCH')

                <div class="p-8 space-y-8">
                    <!-- Basic Information Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Basic Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Client Name -->
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Name
                                    </span>
                                </label>
                                <input id="name" 
                                       type="text" 
                                       name="name" 
                                       value="{{ old('name', $client->name) }}" 
                                       required 
                                       autofocus
                                       class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="Enter client name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Status Selection -->
                            <div>
                                <label for="status" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Status
                                    </span>
                                </label>
                                <select id="status" 
                                        name="status" 
                                        required
                                        class="block w-full px-4 py-3 border-2 border-emerald-200 rounded-xl shadow-sm focus:border-emerald-400 focus:ring-2 focus:ring-emerald-300 bg-white text-gray-900 font-medium transition-all duration-200">
                                    <option value="">Select Status</option>
                                    <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="dormant" {{ old('status', $client->status) == 'dormant' ? 'selected' : '' }}>Dormant</option>
                                    <option value="archived" {{ old('status', $client->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Company Details Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Company Details
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Company Name -->
                            <div>
                                <label for="company_name" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Company Name
                                    </span>
                                </label>
                                <input id="company_name" 
                                       type="text" 
                                       name="company_name" 
                                       value="{{ old('company_name', $client->company_name) }}"
                                       class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="Enter company name" />
                                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                            </div>

                            <!-- Company Registration Number -->
                            <div>
                                <label for="company_registration_number" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Registration Number
                                    </span>
                                </label>
                                <input id="company_registration_number" 
                                       type="text" 
                                       name="company_registration_number" 
                                       value="{{ old('company_registration_number', $client->company_registration_number) }}"
                                       class="block w-full px-4 py-3 border-2 border-violet-200 rounded-xl shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="C.123456" />
                                <x-input-error :messages="$errors->get('company_registration_number')" class="mt-2" />
                            </div>

                            <!-- Company Website -->
                            <div>
                                <label for="company_website" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                        Website
                                    </span>
                                </label>
                                <input id="company_website" 
                                       type="url" 
                                       name="company_website" 
                                       value="{{ old('company_website', $client->company_website) }}"
                                       class="block w-full px-4 py-3 border-2 border-pink-200 rounded-xl shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="https://www.example.com" />
                                <x-input-error :messages="$errors->get('company_website')" class="mt-2" />
                            </div>

                            <!-- KRA PIN -->
                            <div>
                                <label for="kra_pin" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        KRA PIN
                                    </span>
                                </label>
                                <input id="kra_pin" 
                                       type="text" 
                                       name="kra_pin" 
                                       value="{{ old('kra_pin', $client->kra_pin) }}"
                                       class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="A123456789B" />
                                <x-input-error :messages="$errors->get('kra_pin')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Company Address -->
                        <div class="mt-6">
                            <label for="company_address" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Company Address
                                </span>
                            </label>
                            <textarea id="company_address" 
                                      name="company_address" 
                                      rows="3"
                                      class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                      placeholder="Enter company physical address">{{ old('company_address', $client->company_address) }}</textarea>
                            <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Contact Person Section -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Contact Person
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Contact Name -->
                            <div>
                                <label for="contact_name" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Contact Name
                                    </span>
                                </label>
                                <input id="contact_name" 
                                       type="text" 
                                       name="contact_name" 
                                       value="{{ old('contact_name', $client->contact_name) }}"
                                       class="block w-full px-4 py-3 border-2 border-pink-200 rounded-xl shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="Enter contact person name" />
                                <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                            </div>

                            <!-- Contact Position -->
                            <div>
                                <label for="contact_position" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Position
                                    </span>
                                </label>
                                <input id="contact_position" 
                                       type="text" 
                                       name="contact_position" 
                                       value="{{ old('contact_position', $client->contact_position) }}"
                                       class="block w-full px-4 py-3 border-2 border-violet-200 rounded-xl shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="e.g., Finance Manager" />
                                <x-input-error :messages="$errors->get('contact_position')" class="mt-2" />
                            </div>

                            <!-- Contact Email -->
                            <div>
                                <label for="contact_email" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Contact Email
                                    </span>
                                </label>
                                <input id="contact_email" 
                                       type="email" 
                                       name="contact_email" 
                                       value="{{ old('contact_email', $client->contact_email) }}"
                                       class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="contact@example.com" />
                                <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                            </div>

                            <!-- Contact Phone -->
                            <div>
                                <label for="contact_phone" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Contact Phone
                                    </span>
                                </label>
                                <input id="contact_phone" 
                                       type="text" 
                                       name="contact_phone" 
                                       value="{{ old('contact_phone', $client->contact_phone) }}"
                                       class="block w-full px-4 py-3 border-2 border-pink-200 rounded-xl shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="+254 700 000 000" />
                                <x-input-error :messages="$errors->get('contact_phone')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Company Contact Information -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Company Contact Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Company Email
                                    </span>
                                </label>
                                <input id="email" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email', $client->email) }}"
                                       class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="info@company.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Company Phone
                                    </span>
                                </label>
                                <input id="phone" 
                                       type="text" 
                                       name="phone" 
                                       value="{{ old('phone', $client->phone) }}"
                                       class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 bg-white text-gray-900 font-medium transition-all duration-200" 
                                       placeholder="+254 700 000 000" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
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
                                <span>Client name and status are required fields</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-purple-600 mr-2 font-bold">•</span>
                                <span>Company details help identify the business entity</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-pink-600 mr-2 font-bold">•</span>
                                <span>Contact person is the primary point of contact</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-violet-600 mr-2 font-bold">•</span>
                                <span>KRA PIN format: A123456789B (11 characters)</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-4 px-8 py-6 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-t-2 border-indigo-200">
                    <a href="{{ route('clients.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Client
                        </span>
                        <span x-show="submitting" style="display: none;" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Updating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
