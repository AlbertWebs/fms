<aside x-show="$store.sidebar?.open !== false || window.innerWidth >= 1024"
       x-init="$watch('$store.sidebar.open', value => { if (window.innerWidth >= 1024 && value === false) $store.sidebar.open = true; })"
       @click.away="if (window.innerWidth < 1024) $store.sidebar.open = false"
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-300 transform"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 border-r border-gray-700/50 flex flex-col shadow-xl lg:translate-x-0"
       style="display: none;">
    <!-- Logo -->
    @php
        $logoPath = \App\Models\Setting::get('logo_path');
        $companyName = \App\Models\Setting::get('company_name', 'Ngunzi & Associates');
    @endphp
    <div class="relative flex items-center justify-center h-20 px-6 border-b border-gray-700/50 bg-gray-900/50">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center group">
            @if($logoPath)
                <img src="{{ asset('storage/' . $logoPath) }}" alt="{{ $companyName }}" class="h-12 w-auto max-w-full object-contain">
            @else
                <div class="flex items-center space-x-2">
                    <div class="p-1.5 rounded-xl bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 group-hover:from-indigo-700 group-hover:via-purple-700 group-hover:to-pink-700 transition-all duration-200 shadow-lg group-hover:shadow-xl group-hover:scale-105">
                        <x-application-logo class="h-5 w-5 text-white" />
                    </div>
                    <span class="text-lg font-bold text-white">{{ $companyName }}</span>
                </div>
            @endif
        </a>
        <button @click="$store.sidebar.open = false" class="lg:hidden absolute top-4 right-4 p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700/50 transition-all duration-200">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: rgb(75 85 99) rgb(17 24 39);">
        <x-sidebar-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Dashboard</span>
        </x-sidebar-nav-link>

        @can('clients.view')
            <x-sidebar-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Clients</span>
            </x-sidebar-nav-link>
        @endcan

        @can('files.view')
            <x-sidebar-nav-link :href="route('files.index')" :active="request()->routeIs('files.*')">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Files</span>
            </x-sidebar-nav-link>
        @endcan

        @can('files.upload')
            <x-sidebar-nav-link :href="route('file-requests.index')" :active="request()->routeIs('file-requests.*')">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>File Requests</span>
            </x-sidebar-nav-link>
        @endcan

        @can('categories.manage')
            <x-sidebar-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                <span>Categories</span>
            </x-sidebar-nav-link>
        @endcan

        @can('audit.view')
            <x-sidebar-nav-link :href="route('audit-logs.index')" :active="request()->routeIs('audit-logs.*')">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Audit Logs</span>
            </x-sidebar-nav-link>
        @endcan

        @can('users.manage')
            <div class="pt-4 mt-4 border-t border-indigo-200/60">
                <p class="px-4 text-xs font-bold text-indigo-600 uppercase tracking-wider mb-3 flex items-center">
                    <svg class="w-3 h-3 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Administration
                </p>
                <x-sidebar-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.*')">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Roles & Permissions</span>
                </x-sidebar-nav-link>
                <x-sidebar-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>User Management</span>
                </x-sidebar-nav-link>
                <x-sidebar-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>System Settings</span>
                </x-sidebar-nav-link>
                <x-sidebar-nav-link :href="route('admin.email-logs.index')" :active="request()->routeIs('admin.email-logs.*')">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Email Logs</span>
                </x-sidebar-nav-link>
                <x-sidebar-nav-link :href="route('admin.test-mail.index')" :active="request()->routeIs('admin.test-mail.*')">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Test Mail</span>
                </x-sidebar-nav-link>
            </div>
        @endcan

            <div class="pt-5 mt-5 border-t border-gray-700/50">
            <x-sidebar-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>My Settings</span>
            </x-sidebar-nav-link>
        </div>
    </nav>
</aside>
