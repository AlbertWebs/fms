<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}@isset($header) - {{ strip_tags($header) }}@endisset</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col lg:ml-64">
                <!-- Top Header -->
                <header class="sticky top-0 z-40 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 backdrop-blur-md border-b border-gray-700/50 shadow-lg">
                    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                        <!-- Mobile menu button -->
                        <button @click="$store.sidebar.open = !$store.sidebar.open" class="lg:hidden p-2 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500 transition-all duration-200 border border-transparent hover:border-gray-600/50">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <!-- Page Title & Breadcrumbs -->
                        <div class="flex-1 min-w-0">
                            @isset($header)
                                <div class="flex items-center space-x-2">
                                    {{ $header }}
                                </div>
                            @else
                                <h1 class="text-lg font-bold text-white">Dashboard</h1>
                            @endisset
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center">
                            <x-dropdown align="right" width="48" contentClasses="py-1 bg-gray-800 border border-gray-700">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-semibold text-gray-300 hover:text-white hover:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-lg px-4 py-2 transition-all duration-200 border border-transparent hover:border-gray-600/50">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-md mr-2">
                                            <span class="text-xs font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                        </div>
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="ml-2 h-4 w-4 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-300 hover:bg-gray-700 hover:text-white focus:outline-none focus:bg-gray-700 transition duration-150 ease-in-out">
                                        {{ __('Profile') }}
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-300 hover:bg-gray-700 hover:text-white focus:outline-none focus:bg-gray-700 transition duration-150 ease-in-out">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <!-- Toast Notifications -->
                            <div x-data="{ show: false, message: '', type: 'success' }" 
                                 x-init="
                                    @if(session('success'))
                                        show = true; message = '{{ session('success') }}'; type = 'success';
                                        setTimeout(() => show = false, 5000);
                                    @endif
                                    @if(session('error') || $errors->any())
                                        show = true; message = '{{ session('error') ?? $errors->first() }}'; type = 'error';
                                        setTimeout(() => show = false, 5000);
                                    @endif
                                 "
                                 x-show="show"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="fixed top-20 right-4 z-50 max-w-sm w-full"
                                 style="display: none;">
                                <div :class="type === 'success' ? 'bg-emerald-50 border-emerald-200 text-emerald-800' : 'bg-red-50 border-red-200 text-red-800'" 
                                     class="border rounded-lg shadow-lg p-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg v-if="type === 'success'" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <svg v-else class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        <span x-text="message" class="text-sm font-medium"></span>
                                    </div>
                                    <button @click="show = false" class="ml-4 text-gray-400 hover:text-gray-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>

            <!-- Mobile Sidebar Overlay -->
            <div x-show="$store.sidebar.open" 
                 @click="$store.sidebar.open = false"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-600 bg-opacity-75 z-30 lg:hidden"
                 style="display: none;"></div>
        </div>
    </body>
</html>
