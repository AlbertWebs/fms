<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Welcome Back</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Sign in to continue to your account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-5 p-4 bg-blue-50/80 dark:bg-blue-900/20 border border-blue-200/50 dark:border-blue-800/50 text-blue-700 dark:text-blue-300 rounded-xl backdrop-blur-sm" :status="session('status')" />

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-50/80 dark:bg-red-900/20 border border-red-200/50 dark:border-red-800/50 rounded-xl backdrop-blur-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-semibold text-red-800 dark:text-red-200">
                        {{ __('Authentication Error') }}
                    </h3>
                    <div class="mt-1.5 text-sm text-red-700 dark:text-red-300">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" x-data="{ showPassword: false, loading: false }" @submit="loading = true" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="mb-2.5 font-semibold text-gray-700 dark:text-gray-300" />
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <x-text-input 
                    id="email" 
                    class="block w-full pl-12 pr-4 py-3.5 bg-white/50 dark:bg-gray-900/50 border-gray-300/50 dark:border-gray-700/50 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-200 rounded-xl" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                    placeholder="name@example.com" 
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="mb-2.5 font-semibold text-gray-700 dark:text-gray-300" />
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input 
                    id="password" 
                    class="block w-full pl-12 pr-12 py-3.5 bg-white/50 dark:bg-gray-900/50 border-gray-300/50 dark:border-gray-700/50 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-200 rounded-xl" 
                    x-bind:type="showPassword ? 'text' : 'password'"
                    name="password" 
                    required 
                    autocomplete="current-password" 
                    placeholder="Enter your password" 
                />
                <button 
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200 focus:outline-none"
                    tabindex="-1"
                >
                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 dark:bg-gray-900 transition-all duration-200 cursor-pointer" 
                    name="remember"
                />
                <span class="ml-2.5 text-sm text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-gray-200 transition-colors duration-200">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button 
                class="w-full justify-center py-3.5 text-base font-semibold bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white shadow-lg hover:shadow-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed rounded-xl"
                x-bind:disabled="loading"
            >
                <span x-show="!loading" class="flex items-center justify-center">
                    <span>{{ __('Sign In') }}</span>
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
                <span x-show="loading" class="flex items-center justify-center" style="display: none;">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Signing in...
                </span>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>