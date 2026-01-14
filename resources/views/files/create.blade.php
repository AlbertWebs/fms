<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-bold text-white">Upload File</h1>
            <p class="mt-1 text-sm text-gray-300">Upload a new file to the system</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data" 
                  x-data="{
                      file: null,
                      dragOver: false,
                      uploading: false,
                      uploadProgress: 0,
                      handleFileSelect(event) {
                          const input = event.target;
                          const files = input.files || event.dataTransfer?.files;
                          if (files && files.length > 0) {
                              this.file = files[0];
                              if (event.dataTransfer && event.dataTransfer.files.length > 0) {
                                  const fileInput = document.getElementById('file_input');
                                  const dataTransfer = new DataTransfer();
                                  dataTransfer.items.add(files[0]);
                                  fileInput.files = dataTransfer.files;
                              }
                          }
                      },
                      removeFile() {
                          this.file = null;
                          document.getElementById('file_input').value = '';
                      },
                      formatFileSize(bytes) {
                          if (bytes === 0) return '0 Bytes';
                          const k = 1024;
                          const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                          const i = Math.floor(Math.log(bytes) / Math.log(k));
                          return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
                      },
                      getFileIcon(type) {
                          if (!type) return 'document';
                          if (type.includes('pdf')) return 'pdf';
                          if (type.includes('word') || type.includes('document')) return 'word';
                          if (type.includes('excel') || type.includes('spreadsheet')) return 'excel';
                          if (type.includes('image')) return 'image';
                          return 'document';
                      }
                  }"
                  @dragover.prevent="dragOver = true"
                  @dragleave.prevent="dragOver = false"
                  @drop.prevent="dragOver = false; handleFileSelect($event)"
                  @submit="uploading = true">
                @csrf

                <div class="p-8 space-y-8">
                    <!-- Form Fields Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <select id="client_id" name="client_id" class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 bg-white text-gray-900 font-medium transition-all duration-200" required>
                                <option value="">Select a Client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ (old('client_id', request('client_id')) == $client->id) ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                        </div>

                        <!-- Category Selection -->
                        <div>
                            <label for="category_id" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    Category
                                </span>
                            </label>
                            <select id="category_id" name="category_id" class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl shadow-sm focus:border-purple-400 focus:ring-2 focus:ring-purple-300 bg-white text-gray-900 font-medium transition-all duration-200" required>
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Financial Year Selection -->
                    <div>
                        <label for="financial_year" class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Financial Year
                            </span>
                        </label>
                        <select id="financial_year" name="financial_year" class="block w-full px-4 py-3 border-2 border-pink-200 rounded-xl shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 bg-white text-gray-900 font-medium transition-all duration-200" required>
                            <option value="">Select Financial Year</option>
                            @foreach($financialYears as $year)
                                <option value="{{ $year }}" {{ old('financial_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('financial_year')" class="mt-2" />
                    </div>

                    <!-- File Dropzone -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                File
                            </span>
                        </label>
                        
                        <!-- Dropzone Area -->
                        <div 
                            @click="$refs.fileInput.click()"
                            :class="dragOver ? 'border-indigo-500 bg-gradient-to-br from-indigo-50 to-purple-50 scale-[1.02]' : 'border-indigo-300'"
                            class="relative border-2 border-dashed rounded-2xl p-12 text-center cursor-pointer transition-all duration-300 hover:border-indigo-400 hover:bg-gradient-to-br hover:from-indigo-50/50 hover:to-purple-50/50 transform hover:scale-[1.01] shadow-lg hover:shadow-xl"
                        >
                            <input 
                                type="file" 
                                id="file_input"
                                name="file"
                                x-ref="fileInput"
                                @change="handleFileSelect($event)"
                                class="hidden"
                                required
                            />
                            
                            <!-- Empty State -->
                            <div x-show="!file" class="space-y-4">
                                <div class="flex justify-center">
                                    <div class="p-6 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full">
                                        <svg class="h-16 w-16 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-gray-900 mb-2">
                                        Drop your file here or click to browse
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Supports all file types • Maximum size: 10MB
                                    </p>
                                    <div class="mt-4 flex items-center justify-center gap-4 text-xs text-gray-500">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            PDF, DOC, DOCX
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            XLS, XLSX
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Images
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- File Preview -->
                            <div x-show="file" class="space-y-4" style="display: none;">
                                <div class="flex items-center justify-between p-6 bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-xl border-2 border-indigo-200 shadow-lg">
                                    <div class="flex items-center space-x-4 flex-1 min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="p-4 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl shadow-md">
                                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-bold text-gray-900 truncate" x-text="file?.name"></p>
                                            <div class="flex items-center gap-3 mt-1">
                                                <p class="text-sm font-medium text-indigo-600" x-text="file ? formatFileSize(file.size) : ''"></p>
                                                <span class="px-2 py-0.5 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full">
                                                    Ready to upload
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button 
                                        type="button"
                                        @click.stop="removeFile()"
                                        class="ml-4 flex-shrink-0 p-2.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200"
                                    >
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>

                    <!-- Upload Progress -->
                    <div x-show="uploading" class="space-y-3" style="display: none;">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-800 font-bold flex items-center">
                                <svg class="animate-spin h-4 w-4 mr-2 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Uploading file...
                            </span>
                            <span class="text-indigo-600 font-bold" x-text="uploadProgress + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 shadow-inner">
                            <div 
                                class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 h-3 rounded-full transition-all duration-300 shadow-lg"
                                :style="'width: ' + uploadProgress + '%'"
                            ></div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between gap-4 px-8 py-6 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-t-2 border-indigo-200">
                    <a href="{{ route('files.index') }}" class="px-6 py-3 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                        Cancel
                    </a>
                    <button 
                        type="submit"
                        x-bind:disabled="uploading || !file"
                        class="px-8 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:transform-none"
                    >
                        <span x-show="!uploading" class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            Upload File
                        </span>
                        <span x-show="uploading" class="flex items-center" style="display: none;">
                            <svg class="animate-spin -ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Uploading...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-6 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 rounded-xl border-2 border-blue-200 p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-bold text-gray-900 mb-2">Upload Tips</h3>
                    <ul class="text-sm text-gray-700 space-y-1">
                        <li class="flex items-start">
                            <span class="text-indigo-600 mr-2">•</span>
                            <span>Ensure the file name clearly describes its contents</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-600 mr-2">•</span>
                            <span>Select the correct client and category for easy organization</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-pink-600 mr-2">•</span>
                            <span>Files are automatically versioned if a file with the same name exists</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
